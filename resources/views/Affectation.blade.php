@extends('layouts.app')

@section('content')
<div class="container">
<div class="row mb-3">

  <h2>Liste des Affectations avec Recherche</h2>
  <spam class="col-md-5" id="add">
                <div class="box-header with-border" >
                    <a href="#addSupplyer" role="button" class="btn btn-warning btn-sm  " title="Add new supplyer" data-toggle="modal"><i class="fa fa-user-plus" ></i></a>
                </div>
</spam>
<form action="{{ route('affectations.index') }}" method="GET" id="searchForm">
    <input type="text" id="searchInput" class="form-control mb-3" name="search" placeholder="Rechercher...">
</form>
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>CIN Employee</th>
        <th>Num_série</th>
        <th>Date Début</th>
        <th>Date Fin</th>
        <th>Applications</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
    @foreach($affectations as $aff)
      <tr>
        <td>{{$aff->id}}</td>
        <td>{{$aff->nom_employee}}</td>
        <td>{{$aff->telephone_N}}</td>
        <td>{{$aff->date_debut}}</td>
        <td>{{$aff->date_fin}}</td>
        <td>{{$aff->application1}}--{{$aff->application2}}--{{$aff->application3}}--{{$aff->application4}}</td>
         <td style="display: flex;">
         <a href="{{ route('affectations.edit', ['affectation' => $aff->id]) }}"><button type="button" class="btn btn-primary btn-sm">Modifier</button></a>
         <form action="{{ route('affectations.destroy', $aff) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm ">Supprimer</button>
    </form>
        </td>
      @endforeach
    </tbody>
    <div class="pagination">
        {{$affectations->links ()}}
    </div>
  </table>
  <button id="exportButton" class="btn btn-primary">Export Excel</button>
</div>
<div class="modal fade" id="addSupplyer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter un nouveau Affectation</h4>
                    </div>
                    <div class="modal-body">

                        <table class="table">
                        <form action="{{ route('affectations.store') }}" method="POST">
                      @csrf
                            <tbody>
                            <tr>
    <td></td>
    <td>Applications:</td>
    <td>
        <select id="Application1" name="Application1" required>
        <option value=''> App 1</option>
            @foreach($Applications as $app)
            <option value={{$app->nom}}>{{$app->nom}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select id="Application2" name="Application2">
        <option value=''> App 2</option>
            @foreach($Applications as $app)
            <option value={{$app->nom}}>{{$app->nom}}</option>
            @endforeach
        </select>
    </td>
    <td>
        <select id="Application3" name="Application3">
        <option value=''> App 3</option>
            @foreach($Applications as $app)
            <option value={{$app->nom}}>{{$app->nom}}</option>
            @endforeach
        </select>
    </td>
     <td>
        <select id="Application4" name="Application4">
        <option value=''> App 4</option>
            @foreach($Applications as $app)
            <option value={{$app->nom}}>{{$app->nom}}</option>
            @endforeach
        </select>
    </td>
</tr>

                                <tr>
                                    <td></td>
                                    <td>CIN Employee:</td>
                                    <td><select id="NomEmployee" name="nom_employee" required>
                                    <option value=''> Sélectionnez CIN Employee </option>
                                      @foreach($Employees as $em)
    <option value={{$em->cin}}>{{$em->cin}}</option>
    @endforeach
</select>

                           </td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Num_série:</td>
                                    <td><select id="num_série" name="num_série" required>
                                    <option value=''> Sélectionnez num_série </option>
                                    @foreach($Telephones as $tl)
    <option value={{$tl->num_série}}>{{$tl->num_série}}</option>
    @endforeach
</select>

                           </td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Date Début</td>


                                    <td><input type="date" id="Date Début" name="date_debut" required/></td>

                                </tr>

                                <tr>
                                    <td></td>

                                    <td>
                                        <button type="submit"  class="btn btn-success btn-sm">Sauvegarder</button>
                                    </td>
                                    <td></td>

                                </tr>
                            </tbody>
                          </form>
                        </table>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

        </div>
<script>
document.getElementById('exportButton').addEventListener('click', function() {

     var exportUrl = `{{ route('affectations.create') }}`;

    window.location.href = exportUrl;
});
</script>
            @endsection
