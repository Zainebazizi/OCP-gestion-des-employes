@extends('layouts.app')

@section('content')

                <div class="modal-body">
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf <!-- This is a CSRF protection token -->
                        @method('POST') <!-- Use PATCH method for updating -->

                        <div class="form-group">
                            <label for="nouveauMotDePasse">Mot de passe :</label>
                            <input type="password" class="form-control" id="nouveauMotDePasse" name="nouveauMotDePasse"
                                value="">
                        </div>

                        <div class="form-group">
                            <label for="confirmerMotDePasse">Confirmer Mot de passe :</label>
                            <input type="password" class="form-control" id="confirmerMotDePasse"
                                name="confirmerMotDePasse" value="">
                        </div>

                        <div class="form-group">
                            <label for="email">Email :</label>
                            <input type="email" class="form-control" id="email" name="email" value="">
                        </div>

                        <div class="form-group">
                            <label for="nom">Nom :</label>
                            <input type="text" class="form-control" id="nom" name="nom" value="">
                        </div>

                        <button type="submit" class="btn btn-success btn-sm" id="button1">Ajouter</button>
                    </form>

                </div>
            </div>
            @endsection