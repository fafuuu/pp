@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-body">
<div class="media">
    <span class="media-left mr-2">
        <img src="{{$book->thumbnail}}" alt="...">
    </span>
    <div class="media-body">
        <h3 class="media-heading">{{$book->title}}</h3>
        <ul>
            <li> {{$book->subtitle}} </li>
            <li> ISBN: {{$book->isbn}} </li>
            <li> Autor: {{$book->author}} </li>
            <li> Publisher: {{$book->publisher}} </li>
            <li> {{$book->pageCount}} Seiten </li>
            
        </ul>
        
    </div>
</div>

</div>
</div>




<div class="card">
    <div class="card-body">
<form method="POST" action="/books/{{$book->id}}/refs">

    @csrf
  <div class="form-row">
    <div class="col">
      <input type="text" class="form-control" name="link" placeholder="Link">
    </div>
    <div class="form-group col-md-2">
      <input type="text" class="form-control" name="page_number" placeholder="Seite">
    </div>
  </div>

    <div class="form-group">
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Anmerkungen"></textarea>
     </div>

     @if(Auth::guest())
     <button type="button" id="testy" class="btn btn-primary btn-danger mb-2 float-right" data-toggle="popover" title="Popover title" 
     data-content="Bitte logge dich ein, um einen Verweis zu posten">Veröffentlichen</button>
     @endif
        
        @if(Auth::user())
        <button type="submit" class="btn btn-primary mb-2 float-right">Veröffentlichen</button>
        @endif
        </form>
    </div>
</div>

<input  name="seite" type="hidden">
<button type="submit">Seite</button>
<button name="votes">Votes</button>

@if ($book->refs->count())
<div>
    
    <ul>
        
        @foreach($book->refs as $ref)
        
        
        @if (isset($_POST['votes']))
            $book->refs->sortby('votes')
        @endif
        <div class="card mt-4">
            <h5 class="card-header">Seite: {{$ref->page_number}} Angelegt von: {{$ref->user->name}} 
            <span class="float-right">Votes: {{$ref->votes}}</span>
           
                <form method="POST" action="/refs/{{$ref->id}}">
                

                @method('PATCH')
                @csrf
               
                <input value="upvote" id="upvote" name="upvote" type="hidden">
                <button type="submit" class="btn btn-primary float-right">
                    <i class="fas fa-arrow-alt-circle-up float-right"></i>
                </button>
                </form>

                <form method="POST" action="/refs/{{$ref->id}}">

                @method('PATCH')
                @csrf
                <input value="downvote" name="downvote" type="hidden">
                <button type="submit" class="btn btn-danger float-right mr-2">
                    <i class="fas fa-arrow-alt-circle-down float-right"></i>
                </button>
                    
                </form>
            </h5>
            @if($ref->votes <  0)
            
            <button data-toggle="collapse" data-target="#demo{{$ref->id}}">Collapsible</button>
             <div class="card-body collapse" id="demo{{ $ref->id }}" >
            @endif
             <div class="card-body">
                <h5 class="card-title">Quelle: <a href ="{{$ref->link}}">{{parse_url($ref->link, PHP_URL_HOST)}} </a> </h5>
                <p class="card-text">{{$ref->description}}</p>
                @if(pathinfo($ref->link, PATHINFO_EXTENSION) == "jpg" 
                || (pathinfo($ref->link, PATHINFO_EXTENSION) == "png"
                || (pathinfo($ref->link, PATHINFO_EXTENSION) == "gif")))
                    <img src="{{$ref->link}}" width="50%" height="auto" />
                @endif

                @if(pathinfo($ref->link, PATHINFO_EXTENSION) == "pdf")
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
                    <iframe
                        src="{{$ref->link}}"
                        width="800px"
                        height="600px"
                        style="border: none;" />
                @endif

                @if(pathinfo($ref->link, PATHINFO_EXTENSION) == "webm")
                <video width="480" height="auto" controls>
                    <source src="{{$ref->link}}" type="video/webm">
                    Your browser does not support the video tag.
                </video> 
                @endif

                @if(parse_url($ref->link, PHP_URL_HOST) == "www.youtube.com")
                <iframe id="ytplayer" type="text/html" width="640" height="360"
                src="http://www.youtube.com/embed/{{substr(parse_url($ref->link, PHP_URL_QUERY), 2)}}"
                frameborder="0"/>
                @endif
            </div>
        </div>
        @endforeach
    </ul>
</div>
    
@endif

@endsection

