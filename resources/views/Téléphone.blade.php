@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row mb-3">

  <h2>Liste des Téléphones avec Recherche</h2>
  <spam class="col-md-5" id="add">
    <div class="box-header with-border">
      <a href="#addSupplyer" role="button" class="btn btn-warning btn-sm" title="Add new supplyer" data-toggle="modal"><i class="fa fa-user-plus"></i></a>
    </div>
  </spam>
  <form action="{{ route('phones.index') }}" method="GET" id="searchForm">
    <input type="text" id="searchInput" class="form-control mb-3" name="search" placeholder="Rechercher...">
</form>
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Marque</th>
        <th>Modele</th>
        <th>Num série</th>
        <th>Status</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
      @foreach($telephones as $tele )
      <tr>
        <td>{{$tele->id}}</td>
        <td>{{$tele->marque}}</td>
        <td>{{$tele->modele}}</td>
        <td>{{$tele->num_série}}</td>
        <td>{{$tele->status}}</td>
        <td style="display: flex;">
        <a href="{{ route('phones.edit', ['phone' => $tele->id]) }}"><button type="button" class="btn btn-primary btn-sm">Modifier</button></a>
        <form action="{{ route('phones.destroy', $tele) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm ">Supprimer</button>
    </form>
        </td>
      </tr>
      @endforeach
    </tbody>
    <div class="pagination">
        {{$telephones->links ()}}
    </div>
  </table>
  <button id="exportButton" class="btn btn-primary">Export Excel</button>
</div>
<div class="modal fade" id="addSupplyer">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title">Ajouter un nouveau Téléphone</h4>
      </div>
      <div class="modal-body">
      <form action="{{ route('phones.store') }}" method="POST">
    @csrf 
    <table class="table">
        <tbody>
           
            <tr>
                <td></td>
                <td>Marque</td>
                <td><input type="text" id="marque" name="marque" required/></td>
            </tr>
            <tr>
                <td></td>
                <td>Modele</td>
                <td><input type="text" name="modele" id="modele" /></td>
            </tr>
            <tr>
                <td></td>
                <td>Num série</td>
                <td><input type="text" name="num_série" id="num_série" /></td>
            </tr>
            <tr>
            <tr>
                <td></td>
                <td>Status:</td>
                <td>
                    <select id="status" name="status" required>
                        <option value="configurée">Configurée</option>
                        <option value="non configurée">Non Configurée</option>
                    </select>
                </td>
            </tr>
                <td></td>
                <td><button type="submit" class="btn btn-success btn-sm">Sauvegarder</button></td>
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
</div>
<script>
  document.getElementById('exportButton').addEventListener('click', function() {

    var exportUrl = `{{ route('phones.create') }}`;

    window.location.href = exportUrl;
});

</script>
@endsection
