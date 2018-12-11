@extends('layouts.app')

@section('content')

<h1>Suchergebnisse </h1>

    @foreach($book as $b)
    
    <div id="search_card" class="card w-75 mb-2">
<div class="card-body">
<div class="media">
    <span class="media-left mr-2">
        <img src="{{$b->thumbnail}}" alt="...">
    </span>
    <div class="media-body">
        <h3 class="media-heading"> <a href="/books/{{$b->id}}"> {{$b->title}} </a> 
        <span class="badge badge-primary float-right">
                    Verweise: {{count($b->refs)}}
        </span>
        </h3>
        <ul>
            @if(!$b->subtitle == '')
                <li> {{$b->subtitle}} </li>
            @endif
            <li> ISBN: {{$b->isbn}} </li>
            <li> Autor: {{$b->author}} </li>
            <li> Publisher: {{$b->publisher}} </li>
            <li> {{$b->pageCount}} Seiten </li>
            
        </ul>
        
    </div>
</div>

</div>
</div>
  @endforeach

@endsection