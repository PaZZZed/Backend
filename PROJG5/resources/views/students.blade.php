@extends('canevas')
@section('title', 'PROJ5 - PAE - Liste des étudiants')
@section('subheading', 'Liste des étudiants')
@section('content')

<div id="students">

  <h2> Liste des étudiants </h2>

    @if (Auth::user()->status == "Administrateur/trice")

        <!-- Formulaires !-->

            <form id="import_report" action="{{route("import.student")}}" method="post" enctype="multipart/form-data">
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
                        <button type="submit" class="btn btn-secondary" value="Envoyer les bulletins">Envoyer les étudiants</button>
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
    @endif


  @if(session()->has('success'))
  <div class="alert alert-success">{{ session()->get('success') }}</div>
  @endif

  @if(session()->has('error'))
  <div class="alert alert-danger">{{ session()->get('error') }}</div>
  @endif
  <table class="table table-striped">

    <form action="/search" method="POST" role="search">
      {{ csrf_field() }}
      <div class="input-group">
        <input type="text" class="form-control" name="q" placeholder="Rechercher"> <span class="input-group-btn">
          <button type="submit" class="btn btn-secondary" value="Envoyer les bulletins">Rechercher</button>
          <span class="glyphicon glyphicon-search"></span>
          </button>
        </span>
      </div>
    </form>

    <thead>
      <tr>
        <th scope="col">Matricule</th>
        <th scope="col">Prénom</th>
        <th scope="col">Nom</th>
      </tr>
    </thead>

    <tbody>

      @foreach ($student_list as $student)
      <tr>
        <td>{{$student->numbers}}</td>
        <td>{{$student->first_name}}</td>
        <td>{{$student->last_name}}</td>
      </tr>
      @endforeach
    </tbody>
  </table>

  <span hidden>JSON INVALIDE</span>
</div>
<div class="pagination text-center"> {{$student_list->links()}} </div>


@endsection
