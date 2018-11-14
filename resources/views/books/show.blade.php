@extends('layouts.app')

@section('content')

<div class="card">
<div class="card-body">
<div class="media">
    <span class="media-left">
        <img src="{{$book->thumbnail}}" alt="...">
    </span>
    <div class="media-body">
        <h3 class="media-heading">{{$book->title}}</h3>
        
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
        <label for="exampleFormControlTextarea1">Example textarea</label>
        <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="3"></textarea>
     </div>
        <button type="submit" class="btn btn-primary mb-2 float-right">Veröffentlichen</button>
        </form>
    </div>
</div>

@if ($book->refs->count())
<div>
    
    <ul>
        @foreach($book->refs->sortby('page_number') as $ref)
        <div class="card mt-4">
            <h5 class="card-header">Seite: {{$ref->page_number}}</h5>
             <div class="card-body">
                <h5 class="card-title">Quelle: <a href ="{{$ref->link}}">{{parse_url($ref->link, PHP_URL_HOST)}} </a></h5>
                <p class="card-text">{{$ref->description}}</p>
                @if(substr(parse_url($ref->link, PHP_URL_PATH), -3) == "jpg" 
                || (substr(parse_url($ref->link, PHP_URL_PATH), -3) == "png"
                || (substr(parse_url($ref->link, PHP_URL_PATH), -3) == "gif")))
                    <img src="{{$ref->link}}" width="50%" height="50%" />
                @endif

                @if(substr(parse_url($ref->link, PHP_URL_PATH), -3) == "pdf")
                    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.0.943/pdf.min.js"></script>
                    <iframe
                        src="{{$ref->link}}"
                        width="800px"
                        height="600px"
                        style="border: none;" />
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

