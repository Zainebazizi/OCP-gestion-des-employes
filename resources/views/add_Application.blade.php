@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
    <h2 class="card-header">Modifier Application</h2>
      <div class="card" style="background-color: #e9ecef; border: 1px solid #ced4da; box-shadow: 10px; margin-top: 40px; margin-left: 100px;">
        <div class="card-body">
        <form action="{{ route('applications.update', ['application' => $application->id]) }}" method="POST">
    @csrf
    @method('PATCH')
          <div class="form-group mb-3">
              <label for="nom">Nom:</label>
              <input type="text" class="form-control" id="nom" value="{{$application->nom}}" name="nom">
            </div>
            <div class="form-group mb-3">
              <label for="version">Version:</label>
              <input type="text" class="form-control" value="{{$application->version}}" id="version" name="version">
            </div>

            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
