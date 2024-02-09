<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Festius</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2>Add Festius</h2>
    <form action="{{ route('curs.storeFestiu', $cursId) }}" method="post">
        @csrf
        <div class="form-group">
            <label for="fecha_inicio_festiu">Start Date of Festiu:</label>
            <input type="date" name="fecha_inicio_festiu" id="fecha_inicio_festiu" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin_festiu">End Date of Festiu:</label>
            <input type="date" name="fecha_fin_festiu" id="fecha_fin_festiu" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Festiu and Finish</button>
        <button type="submit" name="add_another" value="1" class="btn btn-secondary">Add Festiu and Add Another</button>
    </form>
</div>
<!-- Bootstrap JS (Optional) -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
