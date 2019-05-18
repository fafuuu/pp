@extends('layouts.app')


@section('content')

@include('layouts.sidebar')
    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-1">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 id="heading" class="h2">Dashboard</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
        </div>
      </div>
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
    </main>
  </div>
</div>
@endsection