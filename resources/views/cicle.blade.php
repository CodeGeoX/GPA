<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create New Cicle</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">

    <!-- Optional: Add your own custom styles here -->
</head>


<div class="container">
        <h1>Create New Cicle</h1>

        <form action="{{ route('cicles.store') }}" method="post">
            @csrf <!-- CSRF protection -->
            
            <div class="form-group">
                <label for="nom_cicle">Nom Cicle:</label>
                <input type="text" name="nom_cicle" id="nom_cicle" class="form-control" required>
            </div>


            <button type="submit" class="btn btn-primary">Create Cicle</button>
        </form>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
