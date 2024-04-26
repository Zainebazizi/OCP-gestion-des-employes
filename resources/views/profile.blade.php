@extends('layouts.app')

@section('content')

                <div class="modal-body">
                    <form action="{{ route('users.update', ['user' => $user->id]) }}" method="POST">
                        @csrf <!-- This is a CSRF protection token -->
                        @method('PUT') <!-- Use PATCH method for updating -->

                        <div class="form-group">
                            <label for="ancienMotDePasse">Ancien mot de passe :</label>
                            <input type="password" class="form-control" id="ancienMotDePasse" name="ancienMotDePasse"
                                value="">
                        </div>

                        <div class="form-group">
                            <label for="nouveauMotDePasse">Nouveau mot de passe :</label>
                            <input type="password" class="form-control" id="nouveauMotDePasse" name="nouveauMotDePasse"
                                value="">
                        </div>

                        <div class="form-group">
                            <label for="confirmerMotDePasse">Confirmer le nouveau mot de passe :</label>
                            <input type="password" class="form-control" id="confirmerMotDePasse"
                                name="confirmerMotDePasse" value="">
                        </div>

                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}">
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="{{ $user->name }}">
                        </div>

                        <a href="{{ route('users.update')"><button type="submit" class="btn btn-success btn-sm" id="button1">Modifier</button></a>
                       
                    </form>
                    <a href="{{ route('users.show')"><button type="submit" class="btn btn-success btn-sm" id="button2">Ajouter</button></a>
                </div>
            </div>
            @endsection