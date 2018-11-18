@extends('layouts.app')

@section('content')

<h1>Gruppen</h1>

<ul class="list-group">

    @foreach($groups as $group)

        <li class="list-group-item">> {{$group->group_name}} </li>
            <ul>
                <li> {{$group->user_id}} </li>
            </ul>

    @endforeach

</ul>
@endsection