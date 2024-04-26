@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
    <h2 class="card-header">Modifier affectation</h2>
      <div class="card" style="background-color: #e9ecef; border: 1px solid #ced4da; box-shadow: 10px; margin-top: 40px; margin-left: 100px;">

        <div class="card-body">
        <form action="{{ route('affectations.update', ['affectation' =>$affectation->id]) }}" method="POST">
    @csrf
    @method('PATCH')
            <div class="form-group mb-3">
              <label for="employeeSelect">Sélectionnez l'employé :</label>
              <select class="form-control" id="employeeSelect" value={{$affectation->nom_employee}} name="nom_employee">
                @foreach ($employees as $em)
                <option value={{$em->cin}}>{{$em->cin}}</option>
                @endforeach
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="telephoneSelect">Sélectionnez le téléphone :</label>
              <select id="num_série" name="num_série" value={{$affectation->telephone_N}} required>
                                    @foreach($telephones as $tl)
    <option value={{$tl->num_série}}>{{$tl->num_série}}</option>
    @endforeach
</select>
            </div>
            <div>
            <label for="Applications">Applications :</label>
            <select id="Application1" name="Application1" value={{$affectation->application1}} required>
            @foreach($Applications as $app)
            <option value={{$app->nom}}>{{$app->nom}}</option>
            @endforeach
        </select>
        <select id="Application2" name="Application2" value={{$affectation->application2}}>
            @foreach($Applications as $app)
            <option value={{$app->nom}}>{{$app->nom}}</option>
            @endforeach
        </select>
        <select id="Application3" name="Application3" value={{$affectation->application3}} >
            @foreach($Applications as $app)
            <option value={{$app->nom}}>{{$app->nom}}</option>
            @endforeach
        </select>
        <select id="Application4" name="Application4" value={{$affectation->application4}} >
            @foreach($Applications as $app)
            <option value={{$app->nom}}>{{$app->nom}}</option>
            @endforeach
        </select>
            </div>
            <div class="form-group mb-3">
              <label for="dateDebut">Date de début :</label>
              <input type="date" class="form-control" id="dateDebut" value="{{$affectation->date_debut}}" name="date_debut">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
