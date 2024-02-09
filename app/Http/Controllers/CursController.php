<?php

namespace App\Http\Controllers;

use App\Models\Curs;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;



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
        $this->createFestiu($curs, $request);

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
    private function createFestiu(Curs $curs, Request $request)
    {
        // Validate Festiu data
        $request->validate([
            'fecha_inicio_festiu' => 'required|date',
            'fecha_fin_festiu' => 'required|date|after_or_equal:fecha_inicio_festiu',
        ]);

        // Create and save Festiu associated with the Curs
        $curs->festius()->create([
            'fecha_inicio_festiu' => $request->input('fecha_inicio_festiu'),
            'fecha_fin_festiu' => $request->input('fecha_fin_festiu'),
        ]);
    }

    public function showDays(Curs $curs)
{
    // Get the start and end dates of the Curs
    $startDate = Carbon::parse($curs->fecha_inicio_curs);
    $endDate = Carbon::parse($curs->fecha_fin_curs);

    // Generate an array of dates and corresponding days of the week
    $days = [];
    while ($startDate->lte($endDate)) {
        $days[] = [
            'date' => $startDate->format('d.M'),
            'day' => $startDate->shortDayName,
        ];
        $startDate->addDay();
    }

    // Pass the data to the view
    return view('show', compact('curs', 'days'));
}

public function export(Curs $curs)
    {
        // Retrieve the days or calendar data for the given Curs
        $days = $this->getCalendarData($curs);

        // Convert the data to JSON
        $json = json_encode($days, JSON_PRETTY_PRINT);

        // Create a download response
        $headers = [
            'Content-Type' => 'application/json',
            'Content-Disposition' => 'attachment; filename="calendar_export.json"',
        ];

        return new Response($json, 200, $headers);
    }

    private function getCalendarData(Curs $curs)
{
    $calendarData = [];

    // Retrieve Trimestres and associated data
    $trimestres = $curs->trimestres;

    foreach ($trimestres as $trimestre) {
        // Include Trimestre data
        $calendarData[] = [
            'type' => 'trimestre',
            'start_date' => $trimestre->fecha_inicio_trimestre,
            'end_date' => $trimestre->fecha_fin_trimestre,
        ];
    }

    return $calendarData;
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
