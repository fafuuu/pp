@extends('layouts.app')

@section('content')

<h1>Gruppen</h1>


<form method="POST" action="/groups">

{{csrf_field()}}

<div class="form-group">
    <input id="test1" type="text" name="group" placeholder="Gruppenname">
</div>
<div>
    <button type="submit" class="btn btn-primary mb-2">Anlegen</button>
</div>

</form>

    @foreach($groups as $group)

        <div class="card mb-2">
                <div class="card-header">
                    {{$group->group_name}}
                    
                    @if($group->id == Auth::user()->group_id)

        <form class="float-right" method="POST" action="/groups/{{$group->id}}">

            @csrf
            @method('PATCH')

            <button name="leave" value="{{Auth::user()->id}}" type="submit" class="btn btn-danger float-right">Leave</button>
       
        </form>

        @else
        

            <form class="float-right" method="POST" action="/groups/{{$group->id}}">

            @csrf
            @method('PATCH')

                <button name="join" value="{{$group->id}}" type="submit" class="btn btn-success float-right">Join</button>
            </form>
            @endif

            <a href="#modal" class="float-right mr-2" data-toggle="modal" data-target="#groupModal-{{$group->id}}">Und X weitere</a>
            
            @include('groups.group_modal')
                </div>
                <div class="card-body">
                    <p class="card-text">With supporting text below</p>
            
                </div>
            </div>
    @endforeach
@endsection