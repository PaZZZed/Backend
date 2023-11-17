<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="{{ asset('/css/canevas.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <h1>PROJ5 - Programme Annuel des Étudiants</h1>
        <h3>@yield('subheading')</h3>
    </header>

    <nav>
        <ul>
            <li><a href="/">Accueil</a></li>
            <li><a href="/students">Étudiants</a></li>
            <li><a href="/ues">UE</a></li>
            <li><a href="/reports">Bulletins</a></li>
            @if (Auth::user()->status == "Administrateur/trice")


            <li><a href="/newUser">Ajouter un utilisateur</a></li>

            @endif
           <li><a href="{{ url('/logout') }}"> Déconnexion </a> </li>
          </ul>
    </nav>

    <article>
        @yield('content')
    </article>

    <footer>
        HE2B-ESI/PROJ5/JLC/2020-2021 - Groupe 3
    </footer>
</body>

</html>
