<!-- resources/views/days/show.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Days of Curs</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .weekend-day {
            background-color: #d9d9d9; /* Light gray background for weekend days */
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2>Days of Curs</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Day</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($days as $day)
                    <tr class="{{ in_array($day['day'], ['Sat', 'Sun']) ? 'weekend-day' : '' }}">
                        <td>{{ $day['date'] }}</td>
                        <td>{{ $day['day'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Button to trigger the export -->
        <a href="{{ route('curs.export', $curs) }}" class="btn btn-primary">Export Calendar (JSON)</a>
        
    </div>

    <!-- Bootstrap JS (Optional) -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>