@extends('layouts.app')

@section('content')
    <h1> new Book</h1>

    <form method="POST" action="/books">

        {{csrf_field()}}

        <div class="form-group">
            <input type="text" name="isbn" placeholder="ISBN oder Titel eingeben">
        </div>
        <div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
@endsection