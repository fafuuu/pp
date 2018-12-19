@extends('layouts.app')

@section('content')

<h1>Gruppen</h1>


<form method="POST" action="/groups">

{{csrf_field()}}

<div class="form-group">
    <input id="test1" type="text" name="group" placeholder="Gruppenname">
</div>
<div>
    <button type="submit" class="btn btn-primary">Submit</button>
</div>

</form>




<ul class="list-group">

    @foreach($groups as $group)

        <li class="list-group-item mb-2"> {{$group->group_name}}

        @if($group->id == Auth::user()->group_id)

        <form class="float-right" method="POST" action="/groups/{{$group->id}}">

            @csrf
            @method('PATCH')

            <button name="join" value="{{Auth::user()->id}}" type="submit" class="btn btn-danger float-right">Leave</button>
       
        </form>

        @else
        

            <form class="float-right" method="POST" action="/groups/{{$group->id}}">

            @csrf
            @method('PATCH')

                <button name="join" value="{{$group->id}}" type="submit" class="btn btn-success float-right">Join</button>
            </form>
        @endif
        </li>
    @endforeach

</ul>
@endsection