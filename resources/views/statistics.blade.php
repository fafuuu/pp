@extends('layouts.app')

@section('content')

@include('layouts.sidebar')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-1">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
          <h1 id="heading" class="h2">Statistik</h1>
          <div class="btn-toolbar mb-2 mb-md-0">
          </div>
        </div>
  
        <h2>Bewertungen</h2>

        <ul class="list-group">
            <li class="list-group-item">Du wurdest {{Auth::user()->badge_creative}} Mal kreativ bewertet</li>
            <li class="list-group-item">Du wurdest {{Auth::user()->badge_costly}} Mal aufwendig bewertet</li>
            <li class="list-group-item">Du wurdest {{Auth::user()->badge_confusing}} Mal verwirrend bewertet</li>
        </ul>
      </main>
    </div>
  </div>
    
@endsection