@extends('layouts.app') 
@section('content')

@include('layouts.sidebar')

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4 pt-1">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 id="heading" class="h2">Einstellungen</h1>
      <div class="btn-toolbar mb-2 mb-md-0">
      </div>
    </div>

    @if (!empty($success))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ $success }}
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    </div>
@endif

    <h2>Profilbild</h2>

    <form enctype="multipart/form-data" action="/profile/{{$user->name}}" method="POST">

      @method('PATCH')
      @csrf
  
      <label for="">Update Image</label>
      <input class="float-right" type="file" name="avatar" id="avatar">
      <img class="float-left mb-2" src="/uploads/avatars/{{$user->avatar}}" width="150px" height="150px">
      @if ($user->avatar == "default.png")
          <p>Ändere dein Profilbild, damit andere dich kennenlernen können. Nimm ein Bild von dir, oder dein liebstes Internet Meme </p>
      @endif
      <br>
     
      <label for="code_pref">Syntax Highlighting</label>
      
      <select name="code_preference" id="code_preference"  class="form-control">
      <option value="" selected disabled hidden>{{$user->code_preference}}</option>
        <option value="Default">Default</option>
        <option value="Dark">Dark</option>
        <option value="Solarized">Solarized</option>
      </select>

      <label for="bio">Bio</label>
      <textarea class="form-control mb-2" placeholder="Wir würden gerne mehr über dich erfahren. Erzähle uns von dir">
        
      </textarea>

        <button type="submit" class="btn btn-primary">Speichern</button>
      </form>
        <br>
        <pre class="language-php"><code>public function settings(User $user) {

          $user = \Auth::user();
      
          return view('profile.index', ['user' =&gt; $user]);
      
      }</code>
  </main>
</div>
</div>

@endsection