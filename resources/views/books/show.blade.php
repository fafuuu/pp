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
            @if(!$book->subtitle == '')
                <li> {{$book->subtitle}} </li>
            @endif
            <li> ISBN: {{$book->isbn}} </li>
            <li> Autor: {{$book->author}} </li>
            <li> Publisher: {{$book->publisher}} </li>
            <li> {{$book->pageCount}} Seiten </li>
            
        </ul>
        
    </div>
</div>

 <form class="float-right" method="POST" action="/books/{{$book->id}}/archived">
        
        @csrf
            <input type="hidden">
                <button type="submit" class="btn btn-success float-right">
                    Exportieren
                </button>
</form>


</div>
</div>

 @if(Auth::user())

<div class="card">
    <div class="card-body">
<form method="POST" action="/books/{{$book->id}}/refs">

    @csrf
  <div class="form-row">
    <div class="col">
      <input id="link" type="text" class="form-control {{$errors->has('link') ? 'is-invalid' : ''}}" name="link" placeholder="Link" value="{{old('link')}}">
    </div>
    <div class="form-group col-md-2">
      <input type="text" class="form-control {{$errors->has('page_number') ? 'is-invalid' : ''}}" name="page_number" placeholder="Seite" value="{{old('page_number')}}">
    </div>
  </div>

    <div class="form-group">
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3" placeholder="Anmerkungen" value="{{old('description')}}"></textarea>
     </div>

     @if($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach($errors->all() as $error)

                    <li> {{$error}} </li>
                
                @endforeach
            </ul>
        </div>
     @endif
     
        <span id="lock"> Sichtbar für: <i class="fas fa-lock"></i> </span>
        <select name="visibility">

                <option value="1">Alle</option>

            @foreach($groups->where('id', Auth::user()->group_id) as $group)
                <option value="{{$group->id}}">{{$group->group_name}} ID {{$group->id}}</option>
            @endforeach
         
        </select>


        
        <button type="submit" class="btn btn-primary mb-2 float-right">Veröffentlichen</button>

       <a href="#modal" class="float-right mr-4" data-toggle="modal" data-target="#markdownModal">Markdown</a>
       
       @include('books.markdown_modal')

       <a href="#modal" class="float-right mr-4" data-toggle="modal" data-target="#mathjaxModal">MathJax</a>

       @include('books.mathjax_modal')

        </form>
    </div>
</div>

        @endif

@if ($book->refs->count())
<div>
    

        @foreach($refs->sortby('page_number') as $ref)
     
    
        <div id="refcard" class="card mt-4">
            <h5 class="card-header">Seite: {{$ref->page_number}}

            @if($ref->votes <  0)
                
                <button class="btn btn-link" data-toggle="collapse" data-target="#demo{{$ref->id}}">
                <i class="fas fa-angle-down"></i> Ausklappen
                </button>
            
            @endif
           
           @if(Auth::user())
            <form class="float-right" method="POST" action="/refs/{{$ref->id}}">
                

                @method('PATCH')
                @csrf
                             
                <input value="downvote" id="downvote" name="downvote" type="hidden">
                <button type="submit" class="btn btn-danger float-right">
                    <i class="far fa-thumbs-down float-right"></i>
                </button>
                </form>

                <form class="float-right" method="POST" action="/refs/{{$ref->id}}">
            
                @method('PATCH')
                @csrf


                  <input value="upvote" name="upvote" type="hidden">
                <button type="submit" class="btn btn-primary float-right mr-2">
                    <i class="far fa-thumbs-up float-right"></i>
                </button>

              
                    
                </form>
            @endif
                <span class="float-right mr-2">Bewertung: {{$ref->votes}}</span>
            </h5>

            @if($ref->votes <  0)
            
                <div class="card-body collapse" id="demo{{ $ref->id }}" >
            
            @endif

             <div class="card-body">
                <h5 class="card-title">Quelle: <a href ="{{$ref->link}}">{{parse_url($ref->link, PHP_URL_HOST)}} </a> </h5>
               
                <ul>
                    <li><strong>Von:</strong> {{$ref->user->name}} </li>
                    <li><strong>Role:</strong> {{$ref->user->role}} </li>
                </ul>   
                <br>

                <p class="card-text"> {!! Parsedown::instance()->text($ref->description) !!} </p>
                
                @if(pathinfo($ref->link, PATHINFO_EXTENSION) == "jpg" 
                || (pathinfo($ref->link, PATHINFO_EXTENSION) == "png"
                || (pathinfo($ref->link, PATHINFO_EXTENSION) == "gif")))
                    <hr>
                    <img id="card_img" src="{{$ref->link}}" width="50%" height="auto" />
                @endif

                @if(pathinfo($ref->link, PATHINFO_EXTENSION) == "pdf")
                    <hr>
                    <iframe id="pdf"
                        src="https://drive.google.com/viewerng/viewer?embedded=true&url={{$ref->link}}"
                        width="800px"
                        height="600px"
                        style="border: none;"></iframe>
                @endif

                @if(pathinfo($ref->link, PATHINFO_EXTENSION) == "webm")
                <hr>
                <video width="480" height="auto" controls>
                    <source src="{{$ref->link}}" type="video/webm">
                    Your browser does not support the video tag.
                </video> 
                @endif

                @if(pathinfo($ref->link, PATHINFO_EXTENSION) == "mp3")
                <hr>
                 <audio controls>
                    <source src="{{$ref->link}}" type="audio/mpeg">
                        Your browser does not support the audio element.
                </audio> 

                @endif

                @if(parse_url($ref->link, PHP_URL_HOST) == "www.youtube.com")
              
                <hr>
                <iframe id="ytplayer" type="text/html" width="640" height="360"
                src="https://www.youtube.com/embed/{{substr(parse_url($ref->link, PHP_URL_QUERY), 2)}}"
                frameborder="0"></iframe>
                @endif

            </div>
        </div>

        @endforeach

</div>
    
@else

<div class="d-flex justify-content-center">
    <div class="alert alert-info mt-2 w-75" role="alert">
        <h4 class="alert-heading">Hier scheint noch nichts zu sein</h4>
            <p>Sei der erste der einen Verweis veröffentlicht und helfe anderen nützliche Information zu finden.</p>
    </div>
</div>

@endif


@endsection

<script src="{{ secure_asset('js/tinymce/tinymce.min.js') }}" ></script>
<script>tinymce.init({ selector:'textarea', branding: false });</script>
