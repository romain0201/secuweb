@extends('layouts.app')


@section('content')
  <h1> Connexion </h1>
      <form method="POST" action="{{ route('login.validation') }}">
          <!-- Il faut rajouter un CSRF -->
          <!-- Exemple de code : -->
          @csrf

          <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Adresse email</label>
              <input type="text" class="form-control" name="email" placeholder="admin@example.com">
          </div>
          <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Mot de passe</label>
              <!-- Il faut modifier le type -->
              <input type="text" class="form-control" name="password" placeholder="Mot de passe">
              <!-- Exemple de code : -->
              <input type="password" class="form-control" name="password" placeholder="Mot de passe">
          </div>
          <div class="mb-3">
              <label for="exampleFormControlInput1" class="form-label">Nom d'utilisateur</label>
              <input type="password" class="form-control" name="confirm_password" placeholder="toto24012">
          </div>

          <!-- On peut supprimer ce code -->
          <input type="hidden" name="createAdmin" value="false" />

          <button type="submit" class="btn btn-primary">Submit</button>
      </form>
@endsection
