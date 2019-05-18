@extends('layouts.app')

@section('content')
<div class="container">


    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="progress mb-2">
                <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="0"
                        aria-valuemin="0" aria-valuemax="100" style="width:{{Auth::user()->score}}%">
                        20% Complete (success)
                </div>
            </div>

            <div class="card">
                <div class="card-header">Dashboard Rolle: {{Auth::user()->role}} Score: {{Auth::user()->score}}</div>

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

                    <h5>Watchlist</h5>
                    <ul>
                        @foreach ($watchlist->entries as $entry)
                            <li> {{$entry->book_id}} </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        <p>{{count($creative_notifications)}}</p>
        <ul class="list-group">
            @foreach($creative_notifications as $n)
        <li class="list-group-item"><a href="/user/{{$n->data['user_id']}}"> {{$n->data['user_name']}}</a> hat deinen <a href="#" data-toggle="popover" title='<a href="/books/{{$n->data['book_id']}}#card{{$n->data['ref_id']}}">Gehe zum Verweis </a>' data-content='
            <div class="card">
                    <div class="card-body">
                      {{$n->data['ref_description']}}
                    </div>
                  </div>
            '>Verweis</a> als kreativ in <a href="/books/{{$n->data['book_id']}}">{{$n->data['book_title']}}</a> bewertet
     
            @if($n->read_at == NULL)
            <form class="float-right" name="notification" method="POST" action="/notifications/{{$n->id}}">
                
            @method('PATCH')
            @csrf
                         
            <input value="read" id="read" name="read" type="hidden">
            <button type="submit" class="btn btn-danger float-right">
                Als gelesen Markieren
            </button>
            </form>
            @else
            <span class="badge badge-success">Gelesen</span>

            <form class="float-right" name="notification" method="POST" action="/notifications/{{$n->id}}">
                
                @method('DELETE')
                @csrf
                             
                <input value="delete" id="delete" name="delete" type="hidden">
                <button type="submit" class="btn btn-danger float-right">
                    Löschen
                </button>
                </form>

            @endif
        </li>
        @endforeach

        @foreach ($new_ref_notifications as $ref_notification)
            <p> Neuer verweis {{$ref_notification->id}} in {{$ref_notification->data['book_title']}} </p>
        @endforeach
        </ul>
            <p> Kreativ bewertet: {{Auth::user()->badge_creative}} </p>
            <p> Aufwendig bewertet: {{Auth::user()->badge_costly}} </p>

            <form class="float-right" name="notification" method="POST" action="/watchlist">
                
                @method('POST')
                @csrf
                             
                <input value="read" id="read" name="read" type="hidden">
                <button type="submit" class="btn btn-danger float-right">
                    Watchlist erstellen
                </button>
                </form>
        </div>
    </div>
</div>

@endsection
