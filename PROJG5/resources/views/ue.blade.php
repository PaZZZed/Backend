@extends('canevas')
@section('title','Liste des UES')
@section('subheading', 'Liste des UES')
@section('content')

<div id="ue">
<h1>Liste des UES</h1>
    @if (Auth::user()->status == "Administrateur/trice" || Auth::user()->status == "directeur/trice")

<form method="post" action="{{route('add.ue')}}">
    {{csrf_field()}}
    {{method_field("POST")}}
        <div class="form-group">
            <label for="name">UE</label>
            <input class="form-control" type="text" id="UE" name="UE">
        </div>
        <div class="form-group">
            <label for="id">ECTS</label>
            <input class="form-control" type="number" id="ECTS" name="ECTS">
        </div>
        <div class="form-group">
            <label for="cours">Nombre d'heures</label>
            <input class="form-control" type="number" id="nbHeure" name="heures">
        </div>

        <input class="form-control" type="submit" value="Ajouter/Modifier" class="btn btn-primary">
    </form>
</br>

@endif

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @elseif(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

<table class="table table-striped">
		<tr><th> UE </th>
			<th> ECTS </th>
			<th> HEURES </th>
            <th> ACTION </th>
		</tr>

	@foreach($ues as $ue)
		<tr>
			<td>
				{{$ue->UE}}
			</td>
			<td>
				{{$ue->ECTS}}
			</td>
			<td>
				{{$ue->heures}}
			</td>
            <td>
                <a href="{{route('delete.ue',['id' => $ue->UE])}}"> Supprimer</a>
            </td>
		</tr>
	@endforeach
</table>
    {{$ues->links()}}
</div>
@endsection
