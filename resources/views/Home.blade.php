<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eco-Challenges Tracker</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="/Home">Eco-Challenges Tracker</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="/Home">Accueil</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Challenges">Défis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/Classement">Classement</a>
                    </li>
                </ul>

                <div class="d-flex align-items-center me-3">
                    <span class="me-2 fw-bold">Points :</span>
                    <span class="badge bg-success fs-6">{{ $points }}</span>
                </div>


                <form method="post" action="/Login" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-outline-danger">Logout</button>
                </form>
            </div>
        </div>
    </nav>


    <div class="container text-center mt-5">
        <h1 class="display-4 fw-bold">Bienvenue sur Eco-Challenges Tracker</h1>
        <p class="lead mt-3">
            Agissez pour protéger l'environnement ! Participez à des défis éco-responsables, suivez vos progrès et faites la différence.
        </p>
    </div>


    <div class="container mt-5">
        <div class="row text-center">
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Explorez les Défis</h5>
                        <p class="card-text">Découvrez des tâches simples mais impactantes pour protéger l'environnement.</p>
                        <a href="/Challenges" class="btn btn-success">Voir les Défis</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Suivez vos Progrès</h5>
                        <p class="card-text">Marquez les défis comme terminés et voyez comment vous contribuez à un avenir durable.</p>
                        <a href="/Progres" class="btn btn-primary">Commencez à Suivre</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="card-title">Classement</h5>
                        <p class="card-text">Découvrez votre position parmi les autres éco-acteurs et visez la première place !</p>
                        <a href="/Classement" class="btn btn-warning">Voir le Classement</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>