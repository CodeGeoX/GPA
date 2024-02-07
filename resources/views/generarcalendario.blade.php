<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Course with Trimesters</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Create Course with Trimesters</h2>
    <form action="{{ route('curs.store') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="fecha_inicio_curs">Start Date of the Course:</label>
            <input type="date" name="fecha_inicio_curs" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_curs">End Date of the Course:</label>
            <input type="date" name="fecha_fin_curs" class="form-control" required>
        </div>
        <h3>Trimesters</h3>
        <div class="form-group">
            <label for="fecha_inicio_trimestre1">Start Date of Trimester 1:</label>
            <input type="date" name="fecha_inicio_trimestre1" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_trimestre1">End Date of Trimester 1:</label>
            <input type="date" name="fecha_fin_trimestre1" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio_trimestre2">Start Date of Trimester 2:</label>
            <input type="date" name="fecha_inicio_trimestre2" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_trimestre2">End Date of Trimester 2:</label>
            <input type="date" name="fecha_fin_trimestre2" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio_trimestre3">Start Date of Trimester 3:</label>
            <input type="date" name="fecha_inicio_trimestre3" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_trimestre3">End Date of Trimester 3:</label>
            <input type="date" name="fecha_fin_trimestre3" class="form-control" required>
        </div>
        
        <h3>Festiu</h3>
        <div class="form-group">
            <label for="fecha_inicio_festiu">Start Date of Festiu:</label>
            <input type="date" name="fecha_inicio_festiu" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_festiu">End Date of Festiu:</label>
            <input type="date" name="fecha_fin_festiu" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Create Course with Trimesters</button>
    </form>
</div>

<!-- Bootstrap JS (Optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
