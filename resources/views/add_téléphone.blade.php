@extends('layouts.apphome')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-10 mx-auto">
    <h2 class="card-header">Modifier Téléphone</h2>
      <div class="card" style="background-color: #e9ecef; border: 1px solid #ced4da; box-shadow: 10px; margin-top: 40px; margin-left: 100px;">

        <div class="card-body">
        <form action="{{ route('phones.update', ['phone' => $telephone->id]) }}" method="POST">
    @csrf
    @method('PATCH')
          <div class="form-group mb-3">
              <label for="marque">Marque:</label>
              <input type="text" class="form-control" id="marque" value="{{$telephone->marque}}" name="marque">
            </div>
            <div class="form-group mb-3">
              <label for="modele">Modele:</label>
              <input type="text" class="form-control" id="modele" value="{{$telephone->modele}}" name="modele">
            </div>
            <div class="form-group mb-3">
              <label for="status">Status:</label>
              <input type="text" class="form-control" id="status" value="{{$telephone->status}}" name="status">
            </div>
            <div class="form-group mb-3">
              <label for="num_série">Num série:</label>
              <input type="text" class="form-control" id="num_série" value="{{$telephone->num_série}}" name="num_série">
            </div>
            <button type="submit" class="btn btn-primary">Modifier</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
