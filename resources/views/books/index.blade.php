@extends('layouts.app') 
@section('content')

<div id="booksindex" class="container">
    <h1>Alle Bücher</h1>

    <div class="row">
        @foreach($books->sortby('title') as $book)
      
        <div class="col-sm-2">
            <figure class="figure">
                <a href="/books/{{$book->id}}">
                    <img src="{{$book->thumbnail}}" width="128" height="206" alt=" {{$book->title}} Cover">
                </a>
                <figcaption class="figure-caption">{{$book->title}}</br>
                    <span class="badge badge-primary">
                    Verweise: {{count($book->refs)}}
                </span>
                </figcaption>
            </figure>
        </div>
        @endforeach
    </div>
</div>

<div class="d-flex justify-content-center">
    {{ $books->links( "pagination::bootstrap-4") }}
</div>
@endsection