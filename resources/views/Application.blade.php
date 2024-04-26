@extends('layouts.app')
@section('content')
<div class="container">
<div class="row mb-3">

  <h2>Liste des Applications avec Recherche</h2>
  <spam class="col-md-5" id="add">
                <div class="box-header with-border" >
                    <a href="#addSupplyer" role="button" class="btn btn-warning btn-sm  " title="Add new supplyer" data-toggle="modal"><i class="fa fa-user-plus" ></i></a>
                </div>
</spam>
<form action="{{ route('applications.index') }}" method="GET" id="searchForm">
    <input type="text" id="searchInput" class="form-control mb-3" name="search" placeholder="Rechercher...">
</form>
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Version</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
       @foreach($applications as $app)
      <tr>

        <td>{{$app->id}}</td>
        <td>{{$app->nom}}</td>
        <td>{{$app->version}}</td>
         <td style="display: flex;">
         <a href="{{ route('applications.edit', ['application' => $app->id]) }}"><button type="button" class="btn btn-primary btn-sm">Modifier</button></a>
         <form action="{{ route('applications.destroy', $app) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm ">Supprimer</button>
        </form>
        </td></tr>
      @endforeach

    </tbody>
    <div class="pagination">
        {{$applications->links ()}}
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
                        <h4 class="modal-title">Ajouter un nouveau Application</h4>
                    </div>
                    <div class="modal-body">
                     <form action="{{ route('applications.store') }}" method="POST">
                        @csrf
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>Nom</td>
                                    <td><input type="text" id="Nom" name="nom" required/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Version</td>
                                    <td><input type="text" id="Version" name="version" /></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit"  class="btn btn-success btn-sm">Sauvegarder</button>
                                    </td>
                                    <td></td>
                                </tr>
                            </tbody>
                        </table>
                     </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fermer</button>
                    </div>
                </div>

        </div>
        <script>
          document.getElementById('exportButton').addEventListener('click', function() {
    var exportUrl = `{{ route('applications.create') }}`;

    window.location.href = exportUrl;
});

        </script>
            @endsection
