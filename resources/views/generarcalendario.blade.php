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
            
                <div class="form-group">
                    <label for="fecha_inicio_trimestre1">Fecha de Inicio Trimestre 1:</label>
                    <input type="date" name="fecha_inicio_trimestre1" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin_trimestre1">Fecha de Fin Trimestre 1:</label>
                    <input type="date" name="fecha_fin_trimestre1" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio_trimestre2">Fecha de Inicio Trimestre 2:</label>
                    <input type="date" name="fecha_inicio_trimestre2" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin_trimestre2">Fecha de Fin Trimestre 2:</label>
                    <input type="date" name="fecha_fin_trimestre2" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio_trimestre3">Fecha de Inicio Trimestre 3:</label>
                    <input type="date" name="fecha_inicio_trimestre3" class="form-control" required>
                </div>

                <div class="form-group">
                    <label for="fecha_fin_trimestre3">Fecha de Fin Trimestre 3:</label>
                    <input type="date" name="fecha_fin_trimestre3" class="form-control" required>
                </div>
            <button type="submit" class="btn btn-primary">Create Curs with Trimestres</button>
        </form>
    </div>
</body>
</html>