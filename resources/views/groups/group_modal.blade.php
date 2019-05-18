<div class="modal fade" id="groupModal-{{ $group->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ url('refs/') }}">
                    @method('PATCH')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Gruppenmitglieder ({{count($group->users)}})</h5>
                        <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <ul class="list-group">
                                @foreach($group->users as $user)
                                <li class="list-group-item">
                                <img src="/uploads/avatars/{{$user->avatar}}" width="32px" height="32px">
                                    {{$user->name}}
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
  