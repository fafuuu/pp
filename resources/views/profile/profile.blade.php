@extends('layouts.app') 
@section('content')
<h1>Profil von {{$user->name}}</h1>

<div class="card w-75 mt-2">

    <div class="card-header">
<img src="/uploads/avatars/{{$user->avatar}}" width="64px" height="64px">
    
    Über mich
    </div>
    
    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p>

</div>


<div class="card w-25 mt-2">

    <div class="card-header">
        Bewertungen
    </div>

    <div class="card-body">
        <ul class="list-group list-group-flush">
            <li class="list-group-item"><i class="far fa-lightbulb fa-3x"></i> {{$user->badge_creative}}x kreativ bewertet
            </li>
            <li class="list-group-item"><i class="fas fa-award fa-3x"></i> {{$user->badge_costly}}x aufwendig bewertet
            </li>
            <li class="list-group-item"><i class="far fa-meh fa-3x"></i> {{$user->badge_confusing}}x verwirrend bewertet
            </li>
        </ul>
    </div>
</div>
@endsection