<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Challenges</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <!-- Formulaire pour ajouter des challenges -->
    <form action="{{ route('addChallenges') }}" method="post">
        @csrf

        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-center mb-0">Challenges</h1>

                <!-- Lien pour retourner à la page d'accueil -->
                <a href="/Home" class="btn btn-outline-primary">Retour à la page d'accueil</a>
            </div>

            <!-- Tableau des challenges -->
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Points</th>
                            <th scope="col">Sélectionner</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Boucle pour parcourir la liste des challenges -->
                        @foreach ($challenges as $challenge)
                        <tr>
                            <!-- Les données du challenge (titre, description, points) sont affichées dans des cellules (td) -->
                            <td>{{ $challenge->title }}</td>
                            <td>{{ $challenge->description }}</td>
                            <td>{{ $challenge->points }}</td>
                            <td>
                                <!-- Checkbox pour sélectionner un challenge -->
                                <input type="checkbox" name="challenges[]" value="{{ $challenge->id }}">
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Bouton pour soumettre les challenges sélectionnés -->
        <div class="container mt-4">
            <button type="submit" class="btn btn-primary">Ajouter les challenges sélectionnés</button>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    </form>

</body>

</html>