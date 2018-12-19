<div class="modal fade" id="mathjaxModal" tabindex="-1" role="dialog" aria-labelledby="mathjaxModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="mathjaxModalLabel">MathJax Hilfe</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Im Gegensatz zur Standard MathJax Syntax müssen hier \\ statt \ benutzt werden, da es sonst Probleme mit dem Markdown Parser gibt.
      <table class="table table-bordered w-100">
        <thead>
          <tr>
            <th scope="col">Text</th>
            <th scope="col">MathJax</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <td scope="row">\\(a \\ne 0\\)</td>
            <td>\(a \ne 0\)</td>
          </tr>
          <tr>
            <td scope="row">\\(ax^2 + bx + c = 0\\)</td>
            <td>\(ax^2 + bx + c = 0\)</td>
          </tr>
          <tr>
            <td scope="row">\\(x_1+x_2\\)</td>
            <td>\(x_1+x_2\)</td>
          </tr>
          </tbody>
      </table> 

      Bei aufwendigeren Gleichungen sind doppelte Backslashes nicht nötig, diese müssen aber von vier Dollarzeichen     <span>$$</span>...<span>$$</span> umgeben werden.

      <table class="table table-bordered w-100">
        <thead>
        <tr>
            <th scope="col">Text</th>
            <th scope="col">MathJax</th>
        </tr>
        </thead>
          <tbody>
            <tr>
                <td scope="row">\sqrt{b^2-4ac}</td>
                <td>$$\sqrt{b^2-4ac}$$</td>
            </tr>
            <tr>
                <td scope="row">x = {-b \pm \sqrt{b^2-4ac} \over 2a}</td>
                <td>$$x = {-b \pm \sqrt{b^2-4ac} \over 2a}.$$</td>
            </tr>
            <tr>
                <td scope="row">\sigma = \sqrt{ \frac{1}{N} \sum_{i=1}^N (x_i -\mu)^2}</td>
                <td>$$\sigma = \sqrt{ \frac{1}{N} \sum_{i=1}^N (x_i -\mu)^2}$$</td>
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

