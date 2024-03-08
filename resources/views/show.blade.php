<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calendario del Curso</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .weekend-day { background-color: #f8d7da; font-weight: bold; }
        .trimester-day { background-color: #d1ecf1; }
        .festiu-day { background-color: #fff3cd; }
        th, td { text-align: center; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Calendario del Curso</h2>
        <a href="/" class="btn btn-secondary mb-3">Volver al inicio</a>
        <table class="table table-bordered">
        <thead class="thead-dark">
    <tr>
        <th>Fecha</th>
        <th>Día de la Semana</th>
        <th>Información del Trimestre</th>
        <th>Módulo</th>
        <th>Ciclo</th>
        <th>UF y Horas</th> <!-- Nueva columna para UF y Horas -->
        <th>¿Es Festivo?</th>
    </tr>
        </thead>
        <tbody>
        @foreach ($days as $day)
        <tr class="{{ $day['isFestiu'] ? 'festiu-day' : '' }}">
            <td>{{ $day['date'] }}</td>
            <td>{{ $day['dayOfWeek'] }}</td>
            <td>{{ $day['trimesterInfo'] ?? 'Ninguno' }}</td>
            <td>{{ $day['modulInfo'] ?? 'N/A' }}</td>
            <td>{{ $day['cicleInfo'] ?? 'N/A' }}</td>
            <td>{{ $day['ufInfo'] ?? 'N/A' }}</td> <!-- Datos de UF y Horas -->
            <td>{{ $day['isFestiu'] ? 'Sí' : 'No' }}</td>
        </tr>
        @endforeach
        </tbody>

        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
