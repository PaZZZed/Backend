@extends('canevas')
@section('title', 'PROJ5 - PAE - Liste des bulletins')
@section('subheading', 'Liste des bulletins')
@section('content')

    <div id="students">
        <h2> Liste des bulletins </h2>

        @if(session()->has('success'))
            <div class="alert alert-success">{{ session()->get('success') }}</div>
        @endif

        @if(session()->has('error'))
            <div class="alert alert-danger">{{ session()->get('error') }}</div>
        @endif
    @if (Auth::user()->status != "Utilisateur/trice")
        <!-- Formulaires !-->

        <form id="import_report" action="{{route("import.bulletin")}}" method="post" enctype="multipart/form-data">
        <div class="form-group row">
            <div class="col-md-3">
                <div class="custom-file">
                    {{csrf_field()}}
                    {{method_field("POST")}}
                    <input type="file" class="custom-file-input" id="myFile" multiple lang="fr" dir="rtl" accept="application/JSON" name="filename">
                    <label class="custom-file-label text-left" for="myFile">Choisir le fichier à upload</label>
                </div>
            </div>

            <div class="col-md-3">
                <button type="submit" class="btn btn-secondary" value="Envoyer les bulletins">Envoyer les bulletins</button>
            </div>

            <!-- Affiche nom du fichier uploadé-->
            <script type="text/javascript">
                $('.custom-file input').change(function (e) {
                    var files = [];
                    for (var i = 0; i < $(this)[0].files.length; i++) {
                        files.push($(this)[0].files[i].name);
                    }
                    $(this).next('.custom-file-label').html(files.join(', '));
                });
            </script>
        </div>
        </form>

        <form id="reset_report" class="delete" action="{{route("reset.bulletin")}}" method="POST">
            <input type="hidden" name="_method">
            {{ csrf_field() }}
            <button type="submit" class="btn btn-danger" value="Supprimer les bulletins">Supprimer les bulletins</button>
        </form> </br>
@endif
        <script>
            $(".delete").on("submit", function(){
                return confirm("Êtes-vous sûr de vouloir supprimer le contenu de la table bulletins ?");
            });
        </script>

        <!-- Table des bulletins !-->

        <table class="table table-striped">
        <form action="{{route('search') }}" method="POST" role="search">
            {{ csrf_field() }}
            <div class="input-group">
                <input type="text" class="form-control" name="q"
                    placeholder="Rechercher un étudiant"> <span class="input-group-btn">
                    <input type="submit" value="Rechercher">
                        <span class="glyphicon glyphicon-search"></span>
                </span>
            </div>
        </form>
            <thead>
            <tr>
                <th scope="col">Matricule</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($reports_list as $report)
                <tr>
                 <td><a href="{{route('Recup.id', ['id' => $report->numbers])}}" >{{$report->numbers}}</a></td>
                </tr>
            @endforeach

            </tbody>
        </table>
        <div class="pagination text-center">{{ $reports_list->links() }}</div>
    </div>

@endsection
