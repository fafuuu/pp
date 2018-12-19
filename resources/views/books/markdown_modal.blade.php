<div class="modal fade" id="markdownModal" tabindex="-1" role="dialog" aria-labelledby="markdownModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="markdownModalLabel">Markdown Hilfe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <table class="table table-bordered w-100">
        <thead>
          <tr>
            <th scope="col">Text</td>
            <th scope="col">Markdown</td>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td scope="row">#Überschrift</td>
            <td>{!! Parsedown::instance()->text("#Überschrift") !!}</td>
          </tr>
          <tr>
            <td scope="row">##Überschrift</td>
            <td>{!! Parsedown::instance()->text("##Überschift") !!}</td>
          </tr>
          <tr>
            <td scope="row">###Überschrift</td>
            <td>{!! Parsedown::instance()->text("###Überschift") !!}</td>
          </tr>
          <tr>
            <td scope="row">####Überschrift</td>
            <td>{!! Parsedown::instance()->text("####Überschift") !!}</td>
          </tr>
          <tr>
            <td scope="row">*kursiv*</td>
            <td>{!! Parsedown::instance()->text("*kursiv*") !!}</td>
          </tr>
          <tr>
            <td scope="row">**fett**</td>
            <td>{!! Parsedown::instance()->text("**fett**") !!}</td>
          </tr>
          <tr>
            <td scope="row">* Item 1 <br> * Item 2</th>
            <td>{!! Parsedown::instance()->text("* Item 1\n* Item 2") !!}</td>
          </tr>
          <tr>
            <td scope="row">`inline Code`</th>
            <td>{!! Parsedown::instance()->text("`inline Code`") !!}</td>
          </tr>
          <tr>
            <td scope="row">```php <br>echo syntax highlighting <br>```</th>
            <td>{!! Parsedown::instance()->text("```php \necho syntax highlighting\n```") !!}</td>
          </tr>
        </tbody>
      </table>      
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

