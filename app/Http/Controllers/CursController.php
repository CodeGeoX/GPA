<?php

namespace App\Http\Controllers;

use App\Models\Curs;
use Illuminate\Http\Request;

class CursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'fecha_inicio_curs' => 'required|date',
            'fecha_fin_curs' => 'required|date|after_or_equal:fecha_inicio_curs',
            'fecha_inicio_trimestre1' => 'required|date',
            'fecha_fin_trimestre1' => 'required|date|after_or_equal:fecha_inicio_trimestre1',
            'fecha_inicio_trimestre2' => 'required|date',
            'fecha_fin_trimestre2' => 'required|date|after_or_equal:fecha_inicio_trimestre2',
            'fecha_inicio_trimestre3' => 'required|date',
            'fecha_fin_trimestre3' => 'required|date|after_or_equal:fecha_inicio_trimestre3',
        ]);

        // Create a new Curs instance
        $curs = Curs::create([
            'fecha_inicio_curs' => $request->input('fecha_inicio_curs'),
            'fecha_fin_curs' => $request->input('fecha_fin_curs'),
        ]);

        // Create and save trimestres associated with the new Curs
        $curs->trimestres()->create([
            'fecha_inicio_trimestre' => $request->input('fecha_inicio_trimestre1'),
            'fecha_fin_trimestre' => $request->input('fecha_fin_trimestre1'),
        ]);

        $curs->trimestres()->create([
            'fecha_inicio_trimestre' => $request->input('fecha_inicio_trimestre2'),
            'fecha_fin_trimestre' => $request->input('fecha_fin_trimestre2'),
        ]);

        $curs->trimestres()->create([
            'fecha_inicio_trimestre' => $request->input('fecha_inicio_trimestre3'),
            'fecha_fin_trimestre' => $request->input('fecha_fin_trimestre3'),
        ]);

        // Redirect or return a response as needed
        return redirect()->route('cursos.index')->with('success', 'Curso creado satisfactoriamente con sus trimestres.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Curs $curs)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Curs $curs)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Curs $curs)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Curs $curs)
    {
        //
    }
}
