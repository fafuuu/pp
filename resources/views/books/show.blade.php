@extends('layouts.app')

@section('content')

@guest 
@include('books.missingout_modal')
@endguest

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
        <form class="float-right" name="watchlist1"  method="POST" action="/watchlist/1">
                
            @method('PATCH')
            @csrf
                         
            <input name="watchlist" value="{{$book->id}}" type="hidden">
            @if (\Session::has('success'))
                <p>{!! \Session::get('success') !!}</p>
            @endif
            @if (\Session::has('err'))
                <p>{!! \Session::get('err') !!}</p>
            @endif
            <button type="submit" class="btn btn-danger float-right">
                Zur Watchlist hinzufügen
            </button>
            </form>

    </div>
</div>

</div>

</div>
</div>

 @if(Auth::user())

<div class="card">
    <div class="card-body">
<form method="POST" action="/books/{{$book->id}}/refs">

    @csrf
  <div class="form-row">
    <div class="form-group col-md-2">
        <label for="">Bezieht sich auf Seite:</label>
      <input type="text" class="form-control {{$errors->has('page_number') ? 'is-invalid' : ''}}" name="page_number" placeholder="Seitenzahl" value="{{old('page_number')}}">
    </div>
  </div>

    <div class="form-group">
        <textarea class="form-control" name="description" id="description_textarea" rows="3" placeholder="Anmerkungen" value="{{old('description')}}"></textarea>
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
                
                <button class="btn btn-link" data-toggle="collapse" data-target="#card{{$ref->id}}">
                <i class="fas fa-angle-down"></i> Ausklappen
                </button>
            
            @endif
           
           @if(Auth::user())
            <form class="float-right" method="POST" action="/refs/{{$ref->id}}">
                

                @method('PATCH')
                @csrf
                             
                <input value="downvote" id="downvote" name="downvote" type="hidden">
                <button type="submit" {{\Auth::user()->id == $ref->user_id ? 'disabled' : '' }} class="btn btn-danger float-right">
                    <i class="far fa-thumbs-down float-right"></i>
                </button>
                </form>

                <form class="float-right" method="POST" action="/refs/{{$ref->id}}">
            
                @method('PATCH')
                @csrf


                  <input value="upvote" name="upvote" type="hidden">
                <button type="submit" {{\Auth::user()->id == $ref->user_id ? 'disabled' : '' }} class="btn btn-primary float-right mr-2">
                    <i class="far fa-thumbs-up float-right"></i>
                </button>

              
                    
                </form>
            @endif
                <span class="float-right mr-2">Bewertung: {{$ref->votes}}</span>
            </h5>

            @if($ref->votes <  0)
            
                <div class="card-body collapse" id="card{{ $ref->id }}" >
            
            @endif

             <div class="card-body" id="card{{ $ref->id }}">
                <h5 class="card-title">Quelle: <a href ="{{$ref->link}}">{{parse_url($ref->link, PHP_URL_HOST)}} </a>
                     

                    @if(Auth::check() && Auth::user()->id == $ref->user_id)
                    <a href="#modal" class="float-right mr-4" data-toggle="modal" data-target="#editModal-{{$ref->id}}"> <i class="fas fa-pencil-alt float left"></i> Bearbeiten</a>
                    
                    @include('books.edit_modal')
                    @endif
                </h5>
               
                @if (Session::has('created'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('created') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
                </div>
                @endif
                <ul>
                    <li><strong>Von:</strong> <a href="/profile/{{$ref->user->name}}">{{$ref->user->name}} </a></li>
                    <li><strong>Role:</strong> {{$ref->user->role}} </li>
                </ul>   
                <br>

                <p class="card-text"> {!! $ref->description !!} </p>

                @if(Auth::check())
                <br>
                <form class="float-left" method="POST" action="/refs/{{$ref->id}}">
                
                    @method('PATCH')
                    @csrf
                                 
                    <input value="creative" id="creative" name="creative" type="hidden">
                    <button type="submit" {{\Auth::user()->id == $ref->user_id ? 'disabled' : '' }} onClick="this.disabled=true" class="btn btn-success mr-2" title=" {{$ref->creative}} fanden diesen Verweis kreativ">
                        <i class="far fa-lightbulb fa-3x"></i>
                    </button>
                </form>
    
                <form class="float-left" method="POST" action="/refs/{{$ref->id}}">
                
                    @method('PATCH')
                    @csrf
    
                    <input value="costly" name="costly" type="hidden">
                    <button type="submit" {{\Auth::user()->id == $ref->user_id ? 'disabled' : '' }} class="btn btn-danger mr-2" title="{{$ref->costly}} fanden diesen Verweis aufwendig">
                        <i class="fas fa-award fa-3x"></i>
                    </button>
                </form>

                    <form class="float-left" method="POST" action="/refs/{{$ref->id}}">
                
                        @method('PATCH')
                        @csrf

                        <input value="confusing" name="confusing" type="hidden">
                        <button type="submit" {{\Auth::user()->id == $ref->user_id ? 'disabled' : '' }} class="btn btn-warning mr-2" title="{{$ref->confusing}} fanden diesen Verweis verwirrend">
                            <i class="far fa-meh fa-3x"></i> 
                        </button>
                    </form>
                @endif
            </div>
           
    
                @comments(['model' => $ref])
                @endcomments
            
            
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