<!DOCTYPE html>
<html>
 <head>
  <title>Prijava na sajt | Grizli</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <style type="text/css">
   .box{
    width:350px;
    margin:10 auto;
    border:2px solid #ccc;
   }
  </style>
 </head>
 <body>
  @if(isset(Auth::user()->email))
    <script>window.location="/login/home";</script>
   @endif

  @if ($message = Session::get('error'))
   <div class="alert alert-danger alert-block">
    <button type="button" class="close" data-dismiss="alert">×</button>
    <strong>{{ $message }}</strong>
   </div>
   @endif

  @if (count($errors) > 0)
    <div class="alert alert-danger">
     <ul>
     @foreach($errors->all() as $error)
      <li>{{ $error }}</li>
     @endforeach
     </ul>
    </div>
   @endif
  <div class="container">
   <form method="POST" action="{{url('/login/checklogin')}}" class="form">
    {{ csrf_field() }}
    <div class="form-group">
     <label>Email: </label>
     <input type="email" name="email" class="form-control"  placeholder="Unesite vaš email"/>
    </div>
    <div class="form-group">
     <label>Šifra: </label>
     <input type="password" name="password" class="form-control" placeholder="Unesite vašu šifru"/>
    </div>
    <div class="form-group center">
     <input type="submit" name="login" class="btn-submit" value="Prijavi se" />
    </div>
   </form>
  </div>
 </body>
</html>