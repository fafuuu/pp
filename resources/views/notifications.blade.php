@extends('layouts.app')


@section('content')


@include('layouts.sidebar')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-1">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 id="heading" class="h2">Benachrichtigungen</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                    <form class="mr-2" method="POST" action="/notifications">
    
                        @method('PATCH')
                        @csrf
                                     
                        <input value="read_all" type="hidden">
                        <button type="submit" class="btn btn-sm btn-outline-success">Alle als gelesen markieren</button>
                        
                    </form>
                    <form  name="notification" method="POST" action="/notifications">
        
                        @method('DELETE')
                        @csrf
                                     
                        <input value="delete" id="delete" name="delete" type="hidden">
                        <button type="input" class="btn btn-sm btn-outline-danger">Alle löschen</button>
                    </form>
            </div>
          </div>
        </div>

        <ul class="list-group">

            @foreach($notifications as $n)
  
                @if ($n->type == "App\Notifications\CreativeNotification")
                <li class="list-group-item"><img src="/uploads/avatars/{{$n->data['user_avatar']}}" width="32px" height="32px"><a href="/profile/{{$n->data['user_name']}}"> {{$n->data['user_name']}}</a> hat deinen <a href="/books/{{$n->data['book_id']}}#card{{$n->data['ref_id']}}">Verweis</a>
                    in dem Buch <a href="/books/{{$n->data['book_id']}}">{{$n->data['book_title']}}</a> als kreativ bewertet
                @elseif($n->type == "App\Notifications\NewRefNotification")
                <li class="list-group-item"><img src="/uploads/avatars/{{$n->data['user_avatar']}}" width="32px" height="32px"><a href="/profile/{{$n->data['user_name']}}"> {{$n->data['user_name']}}</a> hat einen neuen <a href="/books/{{$n->data['book_id']}}#card{{$n->data['ref_id']}}">Verweis</a>
                    in dem Buch <a href="/books/{{$n->data['book_id']}}">{{$n->data['book_title']}}</a> veröffentlicht
            
                @endif
                        @if($n->read_at == NULL)
                        <form class="float-right" name="notification" method="POST" action="/notifications/{{$n->id}}">
                            
                        @method('PATCH')
                        @csrf
                                     
                        <input value="read" id="read" name="read" type="hidden">
                        <button type="submit" class="btn btn-outline-danger float-right">
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
        </ul>
        @if (count($notifications) == 0)
        <div class="d-flex justify-content-center">
            <div class="alert alert-info mt-2 w-75" role="alert">
                <h4 class="alert-heading">Keine neuen Benachrichtigungen</h4>
                    <p>Du hast aktuell keine Benachrichtigungen ¯\_(ツ)_/¯</p>
            </div>
        </div>
        @endif  
      </main>
    </div>
  </div>
@endsection