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

        // Redirect or return a response as needed
        return redirect()->route('curs.createFestiu', $curs->id); // Redirect to the festiu creation form
}

// Method to show Festiu creation form
public function createFestiuForm($cursId)
{
    return view('festiu', compact('cursId')); // Pass the curs ID to the view
}

// Method to store Festiu
public function storeFestiu(Request $request, $cursId)
{
    $request->validate([
        'fecha_inicio_festiu' => 'required|date',
        'fecha_fin_festiu' => 'required|date|after_or_equal:fecha_inicio_festiu',
    ]);
    
    $curs = Curs::findOrFail($cursId);
    $curs->festius()->create($request->only(['fecha_inicio_festiu', 'fecha_fin_festiu']));
    
    if ($request->has('add_another')) {
        return redirect()->route('curs.createFestiu', $cursId); // Stay on the page for more festius
    } else {
        return redirect()->route('cursos.index')->with('success', 'Curso y Festius creados satisfactoriamente.');
    }
}
//test
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
        $startDate = Carbon::parse($curs->fecha_inicio_curs);
        $endDate = Carbon::parse($curs->fecha_fin_curs);
    
        $trimesters = $curs->trimestres()->get()->sortBy('fecha_inicio_trimestre');
    
        // Genera una matriz de fechas con información adicional sobre los trimestres
        $days = [];
        while ($startDate->lte($endDate)) {
            $trimesterInfo = null;
    
            foreach ($trimesters as $index => $trimester) {
                if ($startDate->isSameDay($trimester->fecha_inicio_trimestre)) {
                    $trimesterInfo = 'Inicio del Trimestre ' . ($index + 1);
                    break;
                } elseif ($startDate->isSameDay($trimester->fecha_fin_trimestre)) {
                    $trimesterInfo = 'Fin del Trimestre ' . ($index + 1);
                    break;
                }
            }
    
            $days[] = [
                'date' => $startDate->format('d.M.Y'),
                'day' => $startDate->shortDayName,
                'trimesterInfo' => $trimesterInfo,
            ];
    
            $startDate->addDay();
        }
    
        return view('show', compact('curs', 'days'));
    }
    

    public function exportToJson(Curs $curs)
{
    $startDate = Carbon::parse($curs->fecha_inicio_curs);
    $endDate = Carbon::parse($curs->fecha_fin_curs);
    $days = [];

    // Generar todos los días del curso
    while ($startDate->lte($endDate)) {
        $days[] = [
            'fecha' => $startDate->format('d M'), 
            'dia' => $startDate->translatedFormat('l'), 
        ];
        $startDate->addDay();
    }

    $calendarData = [
        'trimestres' => $this->getCalendarData($curs),
        'dias' => $days,
    ];

    $filename = "calendario_curso_" . $curs->id . ".json";
    $headers = [
        'Content-Type' => 'application/json',
        'Content-Disposition' => 'attachment; filename=' . $filename,
    ];

    return response()->json($calendarData, 200, $headers);
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
