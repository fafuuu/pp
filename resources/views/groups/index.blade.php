@extends('layouts.app')

@section('content')

<h1>Gruppen</h1>

<ul class="list-group">

    @foreach($groups as $group)

        <li class="list-group-item mb-2"> {{$group->group_name}}

        @if($group->id == Auth::user()->id)

        <form class="float-right" method="POST" action="/groups/{{$group->id}}">

            @csrf
            @method('PATCH')

            <button name="join" value="{{Auth::user()->id}}" type="submit" class="btn btn-danger float-right">Leave</button>
       
        </form>

        @else
        

            <form class="float-right" method="POST" action="/groups/{{$group->id}}">

            @csrf
            @method('PATCH')

                <button name="join" value="{{Auth::user()->id}}" type="submit" class="btn btn-success float-right">Join</button>
            </form>
        @endif
        </li>
    @endforeach

</ul>
@endsection