<?php

namespace App\Http\Controllers;

use App\Models\Uf;
use Illuminate\Http\Request;

class UfController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // You can add logic to display a list of UFs if needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cicleId, $modulId)
    {
        // Pass the cicle ID and modul ID to the view
        return view('uf', ['cicleId' => $cicleId, 'modulId' => $modulId]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $id_modul)
    {
        // Validate the request data
        $request->validate([
            'nom_uf' => 'required|string|max:255',
            'hores_dilluns' => 'required|numeric',
            'hores_dimarts' => 'required|numeric',
            'hores_dimecres' => 'required|numeric',
            'hores_dijous' => 'required|numeric',
            'hores_divendres' => 'required|numeric',
            // Add more validation rules if needed
        ]);

        // Create a new UF
        Uf::create([
            'nom_uf' => $request->nom_uf,
            'hores_dilluns' => $request->hores_dilluns,
            'hores_dimarts' => $request->hores_dimarts,
            'hores_dimecres' => $request->hores_dimecres,
            'hores_dijous' => $request->hores_dijous,
            'hores_divendres' => $request->hores_divendres,            
            'id_modul' => $id_modul, // Assuming id_modul is passed in the form or URL
            // Add more fields if needed
        ]);

        switch ($request->input('action')) {
            case 'finish':
                // Redirigir al dashboard
                return redirect()->route('dashboard')->with('success', 'UF creado exitosamente!');
            
            case 'new_modul':
                // Redirigir a crear un nuevo módulo
                return redirect()->route('moduls.create', ['cursid' => $request->cicle_id]);
            
            case 'new_uf':
                // Redirigir a crear una nueva UF en el mismo módulo
                return redirect()->route('ufs.create', ['cicle_id' => $request->cicle_id, 'modul_id' => $id_modul]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Uf $uf)
    {
        // You can add logic to display a specific UF if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uf $uf)
    {
        // You can add logic to show the edit form if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uf $uf)
    {
        // You can add logic to update the UF if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uf $uf)
    {
        // You can add logic to delete the UF if needed
    }
}
