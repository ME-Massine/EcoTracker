<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Progrès</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <form action="{{ route('progresTermine') }}" method="post">
        @csrf

        <div class="container mt-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1 class="text-center mb-0">Progrès</h1>

                <a href="/Home" class="btn btn-outline-primary">Retour à la page d'accueil</a>
            </div>


            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Titre</th>
                            <th scope="col">Description</th>
                            <th scope="col">Points</th>
                            <th scope="col">Statut</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($User_c as $user_challenge)
                        <tr>
                            <td>{{ $user_challenge['challenge']->title }}</td>
                            <td>{{ $user_challenge['challenge']->description }}</td>
                            <td>{{ $user_challenge['challenge']->points }}</td>
                            <td>{{ $user_challenge['status'] }}</td>
                            @if ($user_challenge['status'] == 'En Progres')
                            <td>
                                <input type="checkbox" name="termine[]" value="{{ $user_challenge['challenge']->id }}">
                            </td>
                            @else
                            <td></td>
                            @endif

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        @if (!empty($User_c))
        <div class="container mt-4">
            <button type="submit" class="btn btn-primary">Marquer comme terminé</button>
        </div>
        @endif


        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </form>
</body>

</html>