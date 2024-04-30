@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
    <h2 class="card-header">Modifier employé</h2>
      <div class="card" style="background-color: #e9ecef; border: 1px solid #ced4da; box-shadow: 10px; margin-top: 40px; margin-left: 100px;">

        <div class="card-body">
    <form action="{{ route('employees.update', ['employee' => $employee->id]) }}" method="POST">
    @csrf
    @method('PATCH')
    <div class="form-group mb-3">
        <label for="nom">Nom:</label>
        <input type="text" class="form-control" id="nom" value="{{ $employee->nom}}"  name="nom">
    </div>
    <div class="form-group mb-3">
        <label for="prenom">Prénom:</label>
        <input type="text" class="form-control" id="prenom" value="{{ $employee->prenom }}" name="prenom">
    </div>
    <div class="form-group mb-3">
        <label for="numero">Téléphone:</label>
        <input type="tel" class="form-control" id="numero" value="{{ $employee->numero }}" name="numero">
    </div>
    <div class="form-group mb-3">
        <label for="department">Department:</label>
        <input type="text" class="form-control" id="department" value="{{ $employee->department }}" name="department">
    </div>
    <div class="form-group mb-3">
        <label for="region">Région:</label>
        <select id="region" value="{{$employee->region}}" name="region" required>
            <option value="Tanger-Tétouan-Al Hoceïma">Tanger-Tétouan-Al Hoceïma</option>
            <option value="Oriental">Oriental</option>
            <option value="Fès-Meknès">Fès-Meknès</option>
            <option value="Rabat-Salé-Kénitra">Rabat-Salé-Kénitra</option>
            <option value="Béni Mellal-Khénifra">Béni Mellal-Khénifra</option>
            <option value="Casablanca-Settat">Casablanca-Settat</option>
            <option value="Marrakech-Safi">Marrakech-Safi</option>
            <option value="Drâa-Tafilalet">Drâa-Tafilalet</option>
            <option value="Souss-Massa">Souss-Massa</option>
            <option value="Guelmim-Oued Noun">Guelmim-Oued Noun</option>
            <option value="Laâyoune-Sakia El Hamra">Laâyoune-Sakia El Hamra</option>
            <option value="Dakhla-Oued Ed-Dahab">Dakhla-Oued Ed-Dahab</option>
        </select>
    </div>
    <div class="form-group mb-3">
        <label for="code_matricule">Code matricule:</label>
        <input type="text" class="form-control" id="code_matricule" value="{{ $employee->code_matricule }}" name="code_matricule">
    </div>
    <button type="submit" class="btn btn-primary">Modifier</button>
</form>

        </div>
      </div>
    </div>
  </div>
</div>
@endsection
