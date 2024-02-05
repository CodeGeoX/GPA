<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div class="container">
        <h2>Create Curs with Trimestres</h2>

        <form action="{{ route('curs.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="fecha_inicio_curs">Fecha de Inicio del Curs:</label>
                <input type="date" name="fecha_inicio_curs" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fecha_fin_curs">Fecha de Fin del Curs:</label>
                <input type="date" name="fecha_fin_curs" class="form-control" required>
            </div>

            <h3>Trimestres</h3>
            @for ($i = 1; $i <= 3; $i++)
                <div class="form-group">
                    <label for="fecha_inicio_trimestre{{ $i }}">Fecha de Inicio Trimestre {{ $i }}:</label>
                    <input type="date" name="fecha_inicio_trimestre[{{ $i }}]" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin_trimestre{{ $i }}">Fecha de Fin Trimestre {{ $i }}:</label>
                    <input type="date" name="fecha_fin_trimestre[{{ $i }}]" class="form-control" required>
                </div>
            @endfor

            <button type="submit" class="btn btn-primary">Create Curs with Trimestres</button>
        </form>
    </div>
</body>
</html>