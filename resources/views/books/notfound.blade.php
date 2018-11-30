@extends('layouts.app')

@section('content')

<h1>Das gewünschte Buch konnte nicht gefunden werden </h1>

<p>
    Wenn du möchtest, kannst du es hier anlegen, damit andere Benutzer das Buch später finden.
</p>

<form class="w-75" method="POST" action="/books">

@csrf

<div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Titel</label>
      <input type="text" class="form-control" id="title" placeholder="Titel" value="">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">ISBN</label>
      <input type="text" class="form-control" id="isbn" placeholder="ISBN" value="">
    </div>
  </div>
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputCity">Autor</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-4">
    <label for="inputCity">Publisher</label>
      <input type="text" class="form-control" id="inputCity">
    </div>
    <div class="form-group col-md-2">
      <label for="inputZip">Pages</label>
      <input type="text" class="form-control" id="page_number">
    </div>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>



@endsection