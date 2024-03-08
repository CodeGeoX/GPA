<?php

namespace App\Http\Controllers;

use App\Models\Modul;
use Illuminate\Http\Request;

class ModulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // You can add logic to display a list of moduls if needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($cursid)
    {
        // Pass the cicle ID to the view
        return view('modul', ['cursid' => $cursid]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_modul' => 'required|string|max:255',
            'id_cicle' => 'required|exists:cicles,id',
        ]);

        $modul = Modul::create([
            'nom_modul' => $request->nom_modul,
            'id_cicle' => $request->id_cicle,
        ]);

        return redirect()->route('ufs.create', ['cicle_id' => $request->id_cicle, 'modul_id' => $modul->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Modul $modul)
    {
        // You can add logic to display a specific modul if needed
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Modul $modul)
    {
        // You can add logic to show the edit form if needed
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Modul $modul)
    {
        // You can add logic to update the modul if needed
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Modul $modul)
    {
        // You can add logic to delete the modul if needed
    }
}
