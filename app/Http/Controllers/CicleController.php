<?php

namespace App\Http\Controllers;

use App\Models\Cicle;
use Illuminate\Http\Request;
use App\Models\Curs; 
class CicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // You can add logic to display a list of cicles if needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cursos = Curs::all(); 
        return view('cicle', compact('cursos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    // CicleController.php

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nom_cicle' => 'required|string|max:255',
            'id_curs' => 'required|exists:curs,id', // Ensure this validation rule is correct based on your database schema
        ]);
    
        // Create a new cicle
        $cicle = Cicle::create([
            'nom_cicle' => $request->nom_cicle,
            'curs_id' => $request->id_curs, // Use 'id_curs' instead of 'curs_id'
        ]);
    
        // Redirect to the create_modul view with the cicle ID as a parameter
        return redirect()->route('cicles.store', ['curs_id' => $cicle->id])->with('success', 'Cicle created successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(Cicle $cicle)
    {
        // You can add logic to display a specific cicle if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cicle $cicle)
    {
        // You can add logic to show the edit form if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cicle $cicle)
    {
        // You can add logic to update the cicle if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cicle $cicle)
    {
        // You can add logic to delete the cicle if needed
    }
}

