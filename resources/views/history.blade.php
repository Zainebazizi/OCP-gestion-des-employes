@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Historique des affectations</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Action</th>
                    <th>Utilisateur</th>
                    <th>Nom de l'employé</th>
                    <th>Téléphone</th>
                    <th>Département</th>
                    <th>Applications</th>
                    <th>Date de début</th>
                    <th>Date de fin</th>
                    
                </tr>
            </thead>
            <tbody>
                @foreach ($history as $item)
                    <tr>
                        <td>{{ $item->action }}</td>
                        <td>{{ $item->user }}</td>
                        <td>{{ $item->nom_employee }}</td>
                        <td>{{ $item->telephone_N }}</td>
                        <td>{{ $item->department_name }}</td>
                        <td>{{ $item->application1 }}, {{ $item->application2 }}, {{ $item->application3 }}, {{ $item->application4 }}</td>
                        <td>{{ $item->date_debut }}</td>
                        <td>{{ $item->date_fin }}</td>
                    
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
