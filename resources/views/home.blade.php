@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard Rolle: {{Auth::user()->role}}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h5>Aktivitäten</h5>

                    <ul class="list-group">
                        
                        @foreach($refs as $ref)
                        
                            <li class="list-group-item">
                                <a href="{{$ref->link}}"> {{parse_url($ref->link, PHP_URL_HOST)}}</a>
                            @foreach($books as $book)

                            @endforeach
                                 in 
                                 <a href="/books/{{$ref->book_id}}">
                                    {{ trim($book->where("id", $ref->book_id)->pluck('title'), '[""]') }}
                                </a>
                                 @endforeach
                            </li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
