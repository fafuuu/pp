@extends('layouts.app')

@section('content')

@include('layouts.sidebar')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-1">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 id="heading" class="h2">Watchlist</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
          </div>
        </div>
  
        <h2>Section title</h2>

            <ul class="list-group">
                @foreach ($watchlist->entries as $entry)
                    <li class="list-group-item"><a class="float-left" href="/books/{{$entry->book_id}}">{{$entry->book_info}}</a>
                        <form  name="delete" method="POST" action="/watchlist/{{$entry->id}}">
        
                            @method('DELETE')
                            @csrf
                                         
                            <input value="{{$entry->id}}" id="delete" name="delete" type="hidden">
                            <button type="input" class="btn btn-sm btn-outline-danger float-right" type="submit"><i class="far fa-eye-slash"></i></button>
                        </form>
                        
                    </li>
                    
                @endforeach
            </ul>
      </main>
    </div>
  </div>
    
@endsection