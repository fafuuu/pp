@extends('layouts.app')

@section('content')

    <h1> Büchersuche</h1>

    <form method="POST" action="/books">

        {{csrf_field()}}

        <div class="form-group">
            <input id="test1" type="text" name="isbn" placeholder="ISBN oder Titel eingeben">
        </div>
        <div>
            <button id="submit" type="submit" class="btn btn-primary">Suchen</button>
        </div>


<script type="text/javascript">
      
      function changeText(){
          document.getElementById('test1').innerHTML = 'Good Morning';
          document.getElementByID('submit').submit();
      }
    
      function testSync() {
          var string = "default string";
          string = window.MyHandler.testString();
          document.getElementById('test1').innerHTML = string;
          document.getElementByID('submit').submit();
      }
  </script>
@endsection