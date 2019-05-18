@extends('layouts.app')

@section('content')

@include('layouts.sidebar')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-1">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 id="heading" class="h2">Collections</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
              <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
              <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
            </div>
            <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
              <span data-feather="calendar"></span>
              This week
            </button>
          </div>
        </div>
  
        <h2>Tanenbaum</h2>

        <ul class="list-group">
            @foreach ($tanenbaum as $item)
                <li class="list-group-item">{{$item->volumeInfo->title}}</li>
            @endforeach
        </ul>
        
        
      </main>
    </div>
  </div>
    
@endsection