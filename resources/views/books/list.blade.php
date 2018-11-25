@extends('layouts.app')

@section('content')

<h1>Suchergebnisse </h1>

    <ul class="list-group">
        @foreach($book as $b)
        <li class="list-group-item"> 
            <a href="/books/{{$b->id}}" > {{$b->title}}
                <span class="badge badge-primary">
                    {{count($b->refs)}}
                </span>
            </a> 
        </li>
        @endforeach
    </ul>

    @foreach($book as $b)
    <div id="accordion">
  <div class="card w-75">
    <div class="card-header" id="heading{{$b->id}}">
      <h5 class="mb-0">
        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse{{$b->id}}" aria-expanded="true" aria-controls="collapseOne">
          {{$b->title}}
        </button>
        <span class="badge badge-primary float-right">
                     {{count($b->refs)}}
                </span>
        <span class="float-right mr-2">Verweise: </span>
        
      </h5>
    </div>

    <div id="collapse{{$b->id}}" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
        <img src="{{$b->thumbnail}}" />
      </div>
    </div>
  </div>
  @endforeach

@endsection