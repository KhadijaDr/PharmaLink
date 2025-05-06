<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Medication;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;


class MedicationController extends Controller
{
    public function index(Request $request)
    {
        // استلام قيمة البحث من المستخدم
        $search = $request->get('search');
        
        // استخدام Eloquent للبحث عن الأدوية بناءً على الاسم أو الوصف
        $medications = Medication::query()
            ->when($search, function ($query, $search) {
                return $query->where('name', 'like', "%{$search}%")
                             ->orWhere('description', 'like', "%{$search}%");
            })
            ->paginate(8); // ترقيم الصفحة
    
        return view('medications.index', compact('medications'));
    }

    public function create()
    {
        return view('medications.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'expiry_date' => 'required|date',
            'supplier' => 'nullable|string',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);
    
        $imagePath = null;
    
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('medications', 'public');
        }
    
        Medication::create([
            'name' => $request->name,
            'description' => $request->description,
            'expiry_date' => $request->expiry_date,
            'supplier' => $request->supplier,
            'quantity' => $request->quantity,
            'price' => $request->price,
            'image' => $imagePath,
        ]);
    
        return redirect()->route('medications.index')->with('success', 'Le médicament a été ajouté avec succès !');
    }
    
    public function destroy(Medication $medication)
    {
        $medication->delete();
        return redirect()->route('medications.index')->with('success', 'Le médicament a été supprimé avec succès !');
    }
    public function edit($id)
{
    $medication = Medication::find($id);
    return view('medications.edit', compact('medication'));
}

public function update(Request $request, $id)
{
   
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'expiry_date' => 'required|date|after:today',
        'supplier' => 'required|string|max:255',
        'quantity' => 'required|integer|min:0',
        'price' => 'required|numeric|min:0',
        'description' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', 
        'delete_image' => 'nullable|boolean'
    ]);

    $medication = Medication::findOrFail($id);

    $imageData = [];
    
    if ($request->hasFile('image')) {

        if ($medication->image) {
            Storage::disk('public')->delete($medication->image);
        }
        $imagePath = $request->file('image')->store('medications', 'public');
        $imageData['image'] = $imagePath;
    }
   
    if ($request->input('delete_image')) {
        if ($medication->image) {
            Storage::disk('public')->delete($medication->image);
        }
        $imageData['image'] = null;
    }

    $medication->update(array_merge([
        'name' => $validatedData['name'],
        'expiry_date' => $validatedData['expiry_date'],
        'supplier' => $validatedData['supplier'],
        'quantity' => $validatedData['quantity'],
        'price' => $validatedData['price'],
        'description' => $validatedData['description'] ?? null,
    ], $imageData));

    return redirect()->route('medications.index')
        ->with('success', 'Le médicament a été mis à jour avec succès !');
}
public function showExpiryAlert()
{
    $alertMedications = Medication::where('expiry_date', '<=', Carbon::now()->addDays(30))
                                   ->where('expiry_date', '>=', Carbon::now())
                                   ->get();

    foreach ($alertMedications as $medication) {
        $medication->expiry_date = Carbon::parse($medication->expiry_date); 
    }

    return view('medications.expiry_alert', compact('alertMedications'));
}

public function notifySupplier($id)
{
    $medication = Medication::findOrFail($id);

    // تحقق مما إذا كانت الكمية تساوي 0
    if ($medication->quantity == 0) {
        if (filter_var($medication->supplier, FILTER_VALIDATE_EMAIL)) {
            Mail::raw("Veuillez fournir davantage de {$medication->name}.", function ($message) use ($medication) {
                $message->to($medication->supplier);
                $message->subject("Commande de Médicaments: {$medication->name}");
            });

            return back()->with('success', "Demande envoyée avec succès au fournisseur de {$medication->name}.");
        } else {
            return back()->with('error', "L'email du fournisseur est invalide pour {$medication->name}.");
        }
    } else {
        return back()->with('error', "La quantité de {$medication->name} n'est pas encore épuisée.");
    }
}


// في MedicationController


public function purchase(Request $request)
{
    $search = $request->input('search');

    $medications = Medication::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('description', 'like', "%{$search}%");
    })->orderBy('created_at', 'desc')->paginate(8); 
    

    return view('medications.purchase', compact('medications'));
}

public function addToCart($id)
{

    $medication = Medication::findOrFail($id);


    return redirect()->route('medications.purchase')->with('success', 'Le médicament a été ajouté au panier');
}

public function purchaseShow($id)
{

    $medication = Medication::findOrFail($id);
    return view('purchase.show', compact('medication'));
}

public function purchaseStore(Request $request)
{
    $request->validate([
        'medication_id' => 'required|exists:medications,id',
        'quantity' => 'required|integer|min:1',
        'customer_name' => 'required|string|max:255',
        'customer_phone' => 'required|string|max:20',
        'customer_address' => 'required|string|max:255', 
        'prescription' => 'nullable|file|mimes:jpg,png,pdf|max:2048'
    ]);

    $order = new Order();
    $order->medication_id = $request->medication_id;
    $order->quantity = $request->quantity;
    $order->customer_name = $request->customer_name;
    $order->customer_phone = $request->customer_phone;
    $order->customer_address = $request->customer_address; 
    if ($request->hasFile('prescription')) {
        $filePath = $request->file('prescription')->store('prescriptions', 'public');
        $order->prescription_path = $filePath;
    }

    $order->status = 'en attente';
    $order->save();

    return redirect()->route('medications.purchase')->with('success', 'Votre demande a été envoyée avec succès');
}
public function show($id)
{
    $medication = Medication::findOrFail($id);
    return view('medications.show', compact('medication'));
}
public function showMedications()
{
    $medications = Medication::all(); 
    return view('purchase', compact('medications'));
}
public function displayMedications(Request $request)
{
    $search = $request->input('search');

    $medications = Medication::when($search, function ($query, $search) {
        return $query->where('name', 'like', "%{$search}%")
                     ->orWhere('description', 'like', "%{$search}%");
    })
    ->where('quantity', '>', 0) 
    ->orderBy('created_at', 'desc')
    ->paginate(6);

    return view('purchase', compact('medications'));
}
public function outOfStock()
{
    $outOfStockMedications = Medication::where('quantity', 0)->get();
    return view('medications.out_of_stock', compact('outOfStockMedications'));
}

}
