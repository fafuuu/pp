@extends('layouts.app')

@section('content')
    <ul>
        @foreach($books as $book)
        
        <li>
         <a href="/books/{{$book->id}}"> {{$book->title}} </a>
        </li>
        @endforeach
    </ul>
@endsection