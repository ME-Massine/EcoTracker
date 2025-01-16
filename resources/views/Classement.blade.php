<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center mb-0">Classement</h1>

            <a href="/Home" class="btn btn-outline-primary">Retour à la page d'accueil</a>
        </div>


        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Score</th>
                        <th scope="col">Defis terminé</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($classement as $class)
                    <tr>
                        <td>{{ $class['User']->name }}</td>
                        <td>{{ $class['User']->email }}</td>
                        <td>{{ $class['User']->points }}</td>
                        <td>{{ $class['Nombre'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>