@extends('canevas')
@section('title','Création d un utilisateur')
@section('subheading', 'Création d un utilisateur')
@section('content')

    <div id="create_user">

        <h1>Créer un nouvel utilisateur</h1>

        <form action="{{route('add.role')}}" method="post">
            {{ csrf_field() }}
            {{method_field("POST")}}
            <div class="form-group">
                <label for="name">Nom:</label>
                <input type="text" required class='form-control' placeholder="Entrez un nom" name="nom" id="nom">
            </div>
            <div class="form-group">
                <label for="email">Prénom:</label>
                <input type ="text" required class='form-control' placeholder="Entrez un prénom" name="prenom"id="prenom">
            </div>

            <div class="form-group">
                <label for="email">Role:</label>
                <div class="radio">
                    <label>  <input type="radio" value="Utilisateur/trice" name='role'id="role">Utilisateur/trice</label>
                </div>
                <div class="radio">
                    <label> <input type='radio'  value='directeur/trice' name='role'id="role">Directeur/trice</label>
                </div>
                <div class="radio">
                    <label> <input type='radio' value='Administrateur/trice' name='role'id="role">Administrateur/trice</label>
                </div>
                <div class="radio">
                    <label> <input type='radio' value='administratif' name='role'id="role">Administratif</label>
                </div>
            </div>
            <div class="form-group">
                <label for="email">Adresse email:</label>
                <input type="email" required class='form-control' placeholder="Entrez votre mail" name="email" id="email">
            </div>
            <div class="form-group">
                <label for="email">Numéro d'etudiant:</label>
                <input type ="text" required class='form-control' placeholder="Entrez un numéro d'étudiant" name="num"id="num">
            </div>
            <div class="form-group">
                <label for="email">Mot de passe:</label>
                <input type="password" class='form-control'placeholder="Entrez un mot de passe" name="mdp" id="mdp">
            </div>
            <div class="form-group">
                <input type="submit" value="Créer" class="btn btn-success">
                <input type="reset" class="btn btn-secondary">
            </div>
        </form>
    </div>
@endsection
