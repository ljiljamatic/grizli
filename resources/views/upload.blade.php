@php
use App\Models\Product;
$paginator = Product::paginate(20);
@endphp

<!DOCTYPE html>
<html>
 <head>
  <title>Dodavanje slika | Grizli</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 </head>
 <body>
 <div class="nav">
    <div class="nav-left">
     <a href="{{ url('/home') }}">Početna strana</a>
    </div>
    <div class="nav-right">
     <a href="{{ url('/home/logout') }}" class="right">Odjavi se</a>
    </div>
  </div>

 <div class="container">
    <form class="form" method="POST" action="/upload/{{$id}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        @if (Session::has('message'))
   <div class="alert alert-info">{{ Session::get('message') }}</div>
@endif

            <div class="image">
            <label>Slika proizvoda: </label>
            <input type="file" class="form-control" required name="image">
            </div><br>  
            <div class="form-group buttons">
            <input type="submit" name="upload" class="btn" value="Dodaj sliku" />
            </div>
    </form>
</div>
 </body>
</html>