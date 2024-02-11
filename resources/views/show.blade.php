<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Days of Curs</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
    .weekend-day {
        background-color: #d9d9d9; 
        font-weight: bold;
    }
    .trimester-day {
        background-color: #ffcccb; 
    }
    .festiu-day {
        background-color: #add8e6; 
    }
</style>
</head>
<body>
<a href="/" class="btn btn-secondary mt-3">Crear nuevo formulario</a>
    <div class="container mt-5">
        <h2>Days of Curs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                    <th>Info</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($days as $day)
    <tr class="{{ in_array($day['day'], ['Sat', 'Sun']) ? 'weekend-day' : '' }} {{ $day['trimesterInfo'] ? 'trimester-day' : '' }} {{ $day['isFestiu'] ? 'festiu-day' : '' }}">
        <td>{{ $day['date'] }}</td>
        <td>{{ $day['day'] }}</td>
        <td>
            @if ($day['trimesterInfo'])
                <strong>{{ $day['trimesterInfo'] }}</strong>
            @elseif ($day['isFestiu'])
                <strong>Festiu</strong>
            @endif
        </td>
    </tr>
@endforeach

            </tbody>
        </table>       
        <a href="{{ route('cursos.export', $curs->id) }}" class="btn btn-primary">Exportar Calendario a JSON</a>
 
    </div>

    <!-- Bootstrap JS (Opcional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
