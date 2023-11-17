@extends('canevas')
@section('title', 'PROJ5 - PAE - Bulletins')
@section('subheading', 'Bulletins')
@section('content')

    <div id="students">
        <h2> Bulletins {{$id}} </h2>


        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">UE</th>
                <th scope="col">Acquis</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($reports as $report)
                <tr>
                    <td>{{$report->UE}}</td>
                    @if($report->acquired==0)
                    <td>Non acquis</td>
                    @else
                    <td>Acquis</td>
                    @endif
                </tr>
            @endforeach

            </tbody>
        </table>
    </div>
    <a href="{{ url()->previous() }}" class="btn btn-default">Retour</a>

@endsection
