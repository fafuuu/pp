<div class="media">
    <a class="pull-left" href="#">
    <img src="/uploads/avatars/{{$message->user->avatar}}" width="64px" height="64px"
             alt="{{ $message->user->name }}" class="img-circle">
    </a>
    <div class="media-body ml-2">
    <h5 class="media-heading"><a href="/profile/{{$message->user->name}}"> {{$message->user->name }} </a></h5>
        <p>{!! $message->body !!}</p>
        <div class="text-muted">
            <small>Posted {{ $message->created_at->diffForHumans() }}</small>
            <hr>
        </div>
    </div>
</div>