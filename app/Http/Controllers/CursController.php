<?php

namespace App\Http\Controllers;

use App\Models\Curs;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\Response;



class CursController extends Controller
{

    public function index()
    {
    }

    public function create()
    {
    }

 
    public function store(Request $request)
    {

        $this->validateCursData($request);

        $curs = Curs::create([
            'nombre_curs' => $request->input('nombre_curs'),
            'fecha_inicio_curs' => $request->input('fecha_inicio_curs'),
            'fecha_fin_curs' => $request->input('fecha_fin_curs'),
        ]);


        $this->createTrimestres($curs, $request);


        return redirect()->route('curs.createFestiu', $curs->id); 
}


public function createFestiuForm($cursId)
{
    return view('festiu', compact('cursId')); 
}


public function storeFestiu(Request $request, $cursId)
{
    $request->validate([
        'fecha_inicio_festiu' => 'required|date',
        'fecha_fin_festiu' => 'required|date|after_or_equal:fecha_inicio_festiu',
    ]);
    
    $curs = Curs::findOrFail($cursId);
    $curs->festius()->create($request->only(['fecha_inicio_festiu', 'fecha_fin_festiu']));
    
    if ($request->has('add_another')) {

        return redirect()->route('curs.createFestiu', $cursId);
    } else {

        return redirect()->route('curs.showDays', $cursId)->with('success', 'Festivos creados satisfactoriamente y calendario actualizado.');
    }
}


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

    private function createFestiu(Curs $curs, Request $request)
    {

        $request->validate([
            'fecha_inicio_festiu' => 'required|date',
            'fecha_fin_festiu' => 'required|date|after_or_equal:fecha_inicio_festiu',
        ]);

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
    $festius = $curs->festius()->get(); 

    $days = [];
    while ($startDate->lte($endDate)) {
        $isFestiu = $festius->contains(function ($festiu) use ($startDate) {
            return $startDate->between($festiu->fecha_inicio_festiu, $festiu->fecha_fin_festiu);
        });

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
            'isFestiu' => $isFestiu, 
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

    while ($startDate->lte($endDate)) {
        $days[] = [
            'fecha' => $startDate->format('Y-m-d'), 
            'dia' => $startDate->translatedFormat('l'),
        ];
        $startDate->addDay();
    }

    $calendarData = [
        'trimestres' => $this->getCalendarData($curs),
        'festius' => $this->getFestiusData($curs), 
        'dias' => $days,
    ];

    $filename = "calendario_curso_" . $curs->id . ".json";
    $headers = [
        'Content-Type' => 'application/json',
        'Content-Disposition' => 'attachment; filename=' . $filename,
    ];

    return response()->json($calendarData, 200, $headers);
}

private function getFestiusData(Curs $curs)
{
    $festiusData = $curs->festius->map(function ($festiu) {

        $fechaInicio = Carbon::parse($festiu->fecha_inicio_festiu);
        $fechaFin = Carbon::parse($festiu->fecha_fin_festiu);

        return [
            'type' => 'festiu',
            'start_date' => $fechaInicio->format('Y-m-d'),
            'end_date' => $fechaFin->format('Y-m-d'),
        ];
    });

    return $festiusData;
}


    

    private function getCalendarData(Curs $curs)
{
    $calendarData = [];

    $trimestres = $curs->trimestres;

    foreach ($trimestres as $trimestre) {
        $calendarData[] = [
            'type' => 'trimestre',
            'start_date' => $trimestre->fecha_inicio_trimestre,
            'end_date' => $trimestre->fecha_fin_trimestre,
        ];
    }

    return $calendarData;
}
 
    public function show(Curs $curs)
    {
        
    }


    public function edit(Curs $curs)
    {
        
    }

    public function update(Request $request, Curs $curs)
    {
        
    }

    public function destroy(Curs $curs)
    {
    
    }
}
