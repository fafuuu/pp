@inject('markdown', 'Parsedown')
<div class="modal fade" id="editModal-{{ $ref->id }}" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form method="POST" action="{{ url('refs/' . $ref->id . '/edit') }}">
                    @method('PATCH')
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Verweis bearbeiten</h5>
                        <button type="button" class="close" data-dismiss="modal">
                        <span>&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <textarea required class="form-control" name="edit" rows="3">{{ $ref->description }}</textarea>
                            <small class="form-text text-muted"><a target="_blank" href="https://help.github.com/articles/basic-writing-and-formatting-syntax">Markdown</a> cheatsheet.</small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-outline-secondary text-uppercase" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-sm btn-outline-success text-uppercase">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
  
  