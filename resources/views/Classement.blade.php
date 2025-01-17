<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Classement</title>

    <!-- Inclusion de la feuille de style Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="text-center mb-0">Classement</h1>

            <!-- Lien pour retourner à la page d'accueil -->
            <a href="/Home" class="btn btn-outline-primary">Retour à la page d'accueil</a>
        </div>

        <!-- Table responsive pour afficher les classements -->
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
                    <!-- Boucle pour parcourir la liste des classements -->
                    @foreach ($classement as $class)
                    <tr>
                        <!-- Les données de l'utilisateur (nom, email, score) sont récupérées via l'objet User -->
                        <td>{{ $class['User']->name }}</td>
                        <td>{{ $class['User']->email }}</td>
                        <td>{{ $class['User']->points }}</td>
                        <td>{{ $class['Nombre'] }}</td> <!-- Le nombre de défis terminés est affiché en utilisant la clé 'Nombre' -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Inclusion du script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>