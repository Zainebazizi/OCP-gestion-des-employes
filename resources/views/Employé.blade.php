@extends('layouts.app')

@section('content')

<div class="container">
<div class="row mb-3">


  <h2>Liste des Employés avec Recherche</h2>
  <spam class="col-md-5" id="add">
                <div class="box-header with-border" >
                    <a href="#addSupplyer" role="button" class="btn btn-warning btn-sm  " title="Add new supplyer" data-toggle="modal"><i class="fa fa-user-plus" ></i></a>
                </div>
</spam>

<form action="{{ route('employees.index') }}" method="GET" id="searchForm">
    <input type="text" id="searchInput" class="form-control mb-3" name="search" placeholder="Rechercher...">
</form>
  <table class="table" id="myTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Téléphone</th>
        <th>Department</th>
        <th>Region</th>
        <th>code_matricule</th>
        <th>Actions</th>
      </tr>
    </thead>
    <tbody>
        @foreach($employees as $em)
      <tr>
        <td>{{$em->id}}</td>
        <td>{{$em->nom}}</td>
        <td>{{$em->prenom}}</td>
        <td>{{$em->numero}}</td>
        <td>{{$em->department}}</td>
        <td>{{$em->region}}</td>
        <td>{{$em->code_matricule}}</td>
        <td style="display: flex;">
    <a href="{{ route('employees.edit', ['employee' => $em->id]) }}" class="btn btn-primary btn-sm me-2">Modifier</a>
    <form action="{{ route('employees.destroy', $em) }}" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm me-2">Supprimer</button>
    </form>
    <a href="{{ route('affectation-history.show', ['affectation_history' => $em->code_matricule])}}"> <button id="btnHistorique"  class="btn btn-success btn-sm">Voir l'historique</button></a>
</td>



</td>


</td>

      @endforeach
    </tbody>
    <div class="pagination">
        {{$employees->links ()}}
    </div>
  </table>
  <button id="exportButton"  class="btn btn-primary">Export Excel</button>
</div>
<div class="modal fade" id="addSupplyer">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title">Ajouter Employé</h4>
                    </div>

                    <div class="modal-body">
                        <!-- Formulaire pour ajouter un nouvel employé -->
                <form action="{{ route('employees.store') }}" method="POST">
                    @csrf
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td>Region:</td>
                                    <td><select id="Region" name="region" required>
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
                           </td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Nom</td>
                                    <td><input type="text" id="Nom" name="nom" required/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Prénom</td>


                                    <td><input type="text" id="Prénom" name="prenom"/></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td>Téléphone</td>
                                    <td><input type="number" id="phone" name="numero" /></td>

                                </tr>

                                <tr>
                                    <td></td>
                                    <td>Department</td>
                                    <td><input type="text" id="Department" name="department"/></td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>code_matricule</td>
                                    <td><input type="text" id="code_matricule"  name="code_matricule" /></td>

                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <button type="submit" class="btn btn-success btn-sm">Sauvegarder</button>
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

    var exportUrl = `{{ route('employees.create') }}`;


    // Redirect to the export URL
    window.location.href = exportUrl;
});

</script>
        @endsection
