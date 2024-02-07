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
        // You might implement logic to display a list of courses if needed
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // You might implement logic to display the form for creating a course
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $this->validateCursData($request);

        // Create a new Curs instance
        $curs = Curs::create([
            'fecha_inicio_curs' => $request->input('fecha_inicio_curs'),
            'fecha_fin_curs' => $request->input('fecha_fin_curs'),
        ]);

        // Create and save trimestres associated with the new Curs
        $this->createTrimestres($curs, $request);

        // Create Festiu forms associated with the new Curs
        $this->createFestiuForms($curs, $request);

        // Redirect or return a response as needed
        return redirect()->route('cursos.index')->with('success', 'Curso creado satisfactoriamente con sus trimestres y festius.');
    }

    /**
     * Validate the incoming Curs data.
     */
    private function validateCursData(Request $request)
    {
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
    }

    /**
     * Create and save trimestres associated with the given Curs.
     */
    private function createTrimestres(Curs $curs, Request $request)
    {
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
    }

    /**
     * Create Festiu forms associated with the given Curs.
     */
    private function createFestiuForms(Curs $curs, Request $request)
    {
        // Get the number of Festiu forms to create (you can customize this logic)
        $numberOfFestius = $request->input('number_of_festius', 0);

        // Loop to create Festiu forms
        for ($i = 0; $i < $numberOfFestius; $i++) {
            // Validate Festiu form data
            $request->validate([
                "festius.$i.fecha_inicio_festiu" => 'required|date',
                "festius.$i.fecha_fin_festiu" => "required|date|after_or_equal:festius.$i.fecha_inicio_festiu",
                // Add other validation rules for Festiu if needed
            ]);

            // Create and save Festiu associated with the Curs
            $curs->festius()->create([
                'fecha_inicio_festiu' => $request->input("festius.$i.fecha_inicio_festiu"),
                'fecha_fin_festiu' => $request->input("festius.$i.fecha_fin_festiu"),
                // Add other fields as needed
            ]);
        }
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
