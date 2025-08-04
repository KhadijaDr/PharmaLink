<?php
// namespace App\Http\Controllers;

// use Illuminate\Http\Request;
// use App\Models\Order;
// use App\Models\Medication;

// class OrderController extends Controller
// {
//     public function index()
//     {
//         $orders = Order::all();
//         return view('orders.index', compact('orders'));
//     }

//     public function validateOrder($id)
//     {
//         $order = Order::findOrFail($id);
//         $order->status = 'validé';
//         $order->save();

//         return redirect()->route('orders.index')->with('success', '✅ تمت الموافقة على الطلب بنجاح');
//     }

//     public function rejectOrder($id)
//     {
//         $order = Order::findOrFail($id);
//         $order->status = 'refusé';
//         $order->save();

//         return redirect()->route('orders.index')->with('error', '❌ تم رفض الطلب');
//     }

//     public function store(Request $request)
// {
//     $request->validate([
//         'customer_name' => 'required|string|max:255',
//         'customer_phone' => 'required|string|max:20',
//         'address' => 'required|string',
//         'prescription' => 'nullable|file|mimes:jpg,png,pdf|max:2048',
//         'cart_data' => 'required', // ✅ إضافة التحقق من السلة
//     ]);

//     $filePath = $request->hasFile('prescription') 
//                 ? $request->file('prescription')->store('prescriptions', 'public') 
//                 : null;

//     $cart = json_decode($request->cart_data, true);

//     foreach ($cart as $id => $details) {
//         Order::create([
//             'customer_name' => $request->customer_name,
//             'customer_phone' => $request->customer_phone,
//             'address' => $request->address,
//             'medication_id' => $id,
//             'quantity' => $details['quantity'],
//             'total_price' => $details['price'] * $details['quantity'],
//             'prescription' => $filePath,
//             'status' => 'en attente',
//         ]);
//     }

//     session()->forget('cart');

//     return redirect()->route('medications.purchase')->with('success', '✅ تم إرسال الطلب بنجاح.');
// }
//     public function checkout()
//     {
//     $medications = Medication::all(); // ✅ جلب جميع الأدوية
//     return view('cart.checkout', compact('medications')); // ✅ إرسالها إلى العرض
// }

// }



// namespace App\Http\Controllers;

// use App\Models\Cmd;
// use Illuminate\Http\Request;

// class OrderController extends Controller
// {
//     public function store(Request $request)
//     {
//         $validated = $request->validate([
//             'customer_name' => 'required|string|max:255',
//             'address' => 'required|string',
//             'phone' => 'required|string|max:20',
//             'prescription' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
//             'medications' => 'required|array',
//             'total_price' => 'required|numeric',
//         ]);

//         $imagePath = $request->file('prescription')->store('prescriptions', 'public');

//         Cmd::create([
//             'customer_name' => $validated['customer_name'],
//             'address' => $validated['address'],
//             'phone' => $validated['phone'],
//             'prescription' => $imagePath,
//             'medications' => json_encode($validated['medications']),
//             'total_price' => $validated['total_price'],
//             'status' => 'En attente',
//         ]);

//         return redirect()->back()->with('success', 'تم تسجيل طلبك بنجاح!');
//     }
// }

namespace App\Http\Controllers;

use App\Models\Cmd;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Medication;

class OrderController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Debug information
            \Log::info('Reçu une nouvelle commande', [
                'post_data' => $request->all(),
                'has_file' => $request->hasFile('prescription'),
                'cart_data_length' => strlen($request->input('cart_data', '')),
                'form_method' => $request->method(),
                'request_ip' => $request->ip(),
                'headers' => $request->headers->all()
            ]);
            
            // Validation des données de base
            $validatedData = $request->validate([
                'name' => 'required|string|max:255',
                'phone' => 'required|string|max:20',
                'address' => 'required|string',
                'prescription' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'cart_data' => 'required|string'
            ], [
                'prescription.required' => 'L\'ordonnance médicale est requise',
                'prescription.image' => 'Le fichier doit être une image',
                'prescription.mimes' => 'Formats acceptés: jpeg, png, jpg, gif',
                'name.required' => 'Votre nom est requis',
                'phone.required' => 'Votre numéro de téléphone est requis',
                'address.required' => 'Votre adresse est requise',
                'cart_data.required' => 'Le panier est vide ou invalide'
            ]);

            \Log::info('Validation réussie, traitement du panier');
            
            try {

                $totalPrice = $this->calculateTotalPrice($cart);
                \Log::info('Prix total calculé', ['total' => $totalPrice]);
                $commandeData = [
                    'customer_name' => $request->input('name'),
                    'phone' => $request->input('phone'),
                    'address' => $request->input('address'),
                    'prescription' => $imagePath,
                    'medications' => $cartData,
                    'total_price' => $totalPrice,
                    'status' => 'En attente',
                ];

                if (auth()->check()) {
                    $commandeData['pharmacist_id'] = auth()->id();
                    $commandeData['user_id'] = auth()->id();
                } else {
                    $commandeData['pharmacist_id'] = null;
                    $commandeData['user_id'] = null;
                }
                
                $commande = new Cmd();
                foreach ($commandeData as $key => $value) {
                    $commande->{$key} = $value;
                }
                $commande->save();
                
                \Log::info('Commande créée', ['id' => $commande->id]);
                
                // Mise à jour du stock pour chaque médicament
                \Log::info('Transaction DB validée');
                
                // Vider le panier après une commande réussie
                session()->forget('cart');
                
                \Log::info('Commande complétée avec succès', ['commande_id' => $commande->id]);
                
                // Rediriger vers une page de confirmation avec un message de succès
                return redirect()->route('purchase.page')
                    ->with('success', '✅ Votre commande a été soumise avec succès! Nous vous contacterons bientôt.');
                
            } catch (\Exception $e) {
                // En cas d'erreur, annuler la transaction
                \DB::rollBack();
                \Log::error('Erreur lors de la transaction DB', [
                    'message' => $e->getMessage(),
                    'trace' => $e->getTraceAsString()
                ]);
                
                return redirect()->route('purchase.page')
                    ->with('error', 'Une erreur est survenue lors de l\'enregistrement de votre commande: ' . $e->getMessage())
                    ->withInput();
            }
            
        } catch (\Exception $e) {
            // Log de l'erreur pour le débogage
            \Log::error('Erreur lors de la création de la commande', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->route('purchase.page')
                ->with('error', 'Une erreur inattendue s\'est produite: ' . $e->getMessage())
                ->withInput();
        }
    }

    private function calculateTotalPrice($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
    
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Récupération des commandes en fonction de l'utilisateur connecté (pharmacien)
        $orders = Cmd::when($search, function($query, $search) {
            return $query->where('customer_name', 'like', "%{$search}%")
                         ->orWhere('phone', 'like', "%{$search}%") 
                         ->orWhere('status', 'like', "%{$search}%");
        })
        ->where('pharmacist_id', auth()->id()) // N'afficher que les commandes associées au pharmacien connecté
        ->orderBy('created_at', 'desc')
        ->paginate(8); 
    
        return view('orders.index', compact('orders'));
    }
    
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:En attente,Validé,Refusé'
        ]);
        
        $order = Cmd::findOrFail($id);
        $order->status = $request->status;
        $order->save();
        
        return redirect()->route('commandes.liste')
            ->with('success', 'Le statut de la commande a été mis à jour avec succès.');
    }

    public function checkout(Request $request)
    {
        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('purchase')->with('error', 'Le panier est vide');
        }

        return view('cart.checkout', compact('cart'));
    }    
    
    public function updateCart(Request $request)
    {
        $medicationId = $request->input('medication_id');
        $quantity = $request->input('quantity');

        if (is_numeric($medicationId) && is_numeric($quantity)) {
            $cart = session('cart', []);
            if (is_array($cart) && isset($cart[$medicationId])) {
                $cart[$medicationId]['quantity'] = $quantity;
                session(['cart' => $cart]);
                return response()->json(['message' => 'Le panier a été mis à jour.']);
            }
            return response()->json(['message' => 'Le panier n\'est pas adapté.'], 400);
        }
        return response()->json(['message' => 'Les paramètres sont invalides.'], 400);
    }
}
