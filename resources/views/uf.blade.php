<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New UF</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Add your own custom styles here -->
</head>

<body>
<div class="container">
        <h1>Create New UF</h1>

        <form action="{{ route('ufs.store', ['id_modul' => $modulId]) }}" method="post">
            @csrf <!-- CSRF protection -->

            <div class="form-group">
                <label for="nom_uf">Nom UF:</label>
                <input type="text" name="nom_uf" id="nom_uf" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hores_dilluns">Hores Dilluns:</label>
                <input type="number" name="hores_dilluns" id="hores_dilluns" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hores_dimarts">Hores Dimarts:</label>
                <input type="number" name="hores_dimarts" id="hores_dimarts" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hores_dimecres">Hores Dimecres:</label>
                <input type="number" name="hores_dimecres" id="hores_dimecres" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="hores_dijous">Hores Dijous:</label>
                <input type="number" name="hores_dijous" id="hores_dijous" class="form-control" required>
            </div>

            <div class="form-group">
                
                <label for="hores_divendres">Hores Divendres:</label>
                <input type="number" name="hores_divendres" id="hores_divendres" class="form-control" required>
            </div>

            <input type="hidden" name="id_modul" value="{{ $modulId }}">
            <input type="hidden" name="cicle_id" value="{{ $cicleId }}">

            <button type="submit" name="action" value="finish" class="btn btn-primary">Aceptar y Terminar</button>
            <button type="submit" name="action" value="new_modul" class="btn btn-secondary">Aceptar y Crear Nuevo Módulo</button>
            <button type="submit" name="action" value="new_uf" class="btn btn-success">Aceptar y Crear Nueva UF</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>