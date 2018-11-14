@extends('layouts.app')

@section('content')
    <h1> Create a new Project</h1>

    <form method="POST" action="/projects">

        {{csrf_field()}}

        <div class="form-group">>
            <input type="text" name="title" placeholder="Link">
        </div>

        <div>
            <textarea name="description" placeholder="Anmerkung"></textarea>
        </div>

        <div>
            <button type="submit">Submit</button>
        </div>
@endsection