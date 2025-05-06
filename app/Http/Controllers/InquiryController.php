<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index()
    {
        $inquiries = Inquiry::latest()->paginate(10); 
        return view('inquiries.index', compact('inquiries')); 
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'nullable|string|max:20',
            'message' => 'required|string',
        ]);

        Inquiry::create([
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'phone' => $request->phone,
        ]);

        return redirect()->back()->with('success', 'Votre demande a été envoyée avec succès !');
    }
    
    // Méthode pour marquer une demande comme lue
    public function markAsRead($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->read = true;
        $inquiry->save();
        
        return redirect()->back()->with('success', 'La demande a été marquée comme lue');
    }
    
    // Méthode pour vider/supprimer une demande
    public function destroy($id)
    {
        $inquiry = Inquiry::findOrFail($id);
        $inquiry->delete();
        
        return redirect()->back()->with('success', 'La demande a été supprimée avec succès');
    }
    
    // Méthode pour vider toutes les demandes traitées (lues)
    public function clearRead()
    {
        Inquiry::where('read', true)->delete();
        
        return redirect()->back()->with('success', 'Toutes les demandes lues ont été supprimées');
    }
}
