<html>
<head>
  <title>Pretraga proizvoda | Grizli</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 </head>
<body>
<div class="product-data">
    <div class="nav">
        <div class="nav-left">
        <a href="{{ url('/home') }}">Početna strana</a>
        </div>
        <div class="nav-right">
        <a href="{{ url('/home/logout') }}" class="right">Odjavi se</a>
        </div>
    </div>
    
    <form action="{{ route('search') }}" method="GET">
    <input type="text" name="search" required/>
    <button type="submit" class="btn">Pretraži</button>
    
    </form>

@if($posts->isNotEmpty())
    @foreach ($posts as $post)
        <div class="post-list">
            <div><a href="{{ url('products') }}/{{ $post->linkToProduct}}">{{ $post->name}}</a></div>
        </div>
    @endforeach
@else 
    <div>
        <h5>Nema rezultata</h5>
    </div>
@endif
</div>
 </body>
</html>
