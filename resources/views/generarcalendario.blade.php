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
                
                <!-- Festiu form container -->
        <div id="festiuFormsContainer"></div>

<!-- Button to generate Festiu form -->
<button id="addFestiuFormBtn" type="button" class="btn btn-success">Add Festiu Form</button>

<button type="submit" class="btn btn-primary">Create Curs with Trimestres</button>
</form>
</div>

<script>
// JavaScript to handle dynamic form generation for Festiu
document.getElementById('addFestiuFormBtn').addEventListener('click', function() {
// Create a new form for Festiu
var festiuForm = document.createElement('form');
festiuForm.action = "{{ route('festius.store') }}";
festiuForm.method = "post";

// CSRF Token
var csrfInput = document.createElement('input');
csrfInput.type = 'hidden';
csrfInput.name = '_token';
csrfInput.value = "{{ csrf_token() }}";
festiuForm.appendChild(csrfInput);

// Checkbox for Festiu
var checkboxInput = document.createElement('input');
checkboxInput.type = 'checkbox';
checkboxInput.name = 'checkbox_name';
checkboxInput.value = '1';  // You can adjust the value as needed
festiuForm.appendChild(checkboxInput);

// Fecha Inicio Festiu field
var fechaInicioInput = document.createElement('input');
fechaInicioInput.type = 'date';
fechaInicioInput.name = 'fecha_inicio_festiu';
festiuForm.appendChild(fechaInicioInput);

// Fecha Fin Festiu field
var fechaFinInput = document.createElement('input');
fechaFinInput.type = 'date';
fechaFinInput.name = 'fecha_fin_festiu';
festiuForm.appendChild(fechaFinInput);

// Append the Festiu form to the container
document.getElementById('festiuFormsContainer').appendChild(festiuForm);
});
</script>

</body>
</html>