@php
use App\Models\Product;
$paginator = Product::paginate(20); 

@endphp

<!DOCTYPE html>
<html>
 <head>
  <title>Početna strana | Grizli</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
 </head>
 <body>
 <div class="alert nav">
    @if(isset(Auth::user()->email))
        <div class="right">
            <p>Welcome {{ Auth::user()->email }}</p>
        </div>
        
    @else
        <script>window.location = "/main";</script>
    @endif
    <div class="nav-right">
        <a href="{{ url('/home/logout') }}" class="right">Odjavi se</a>
    </div>
  </div>
  
<div class="container">
   <br />
    <div class="nav">
        <a href="{{ url('/addproduct') }}" class="btn">Dodaj nov proizvod</a>
    </div>
    <br><br>
    <div class="nav">
        <a href="{{ url('/search') }}" class="btn">Pretraži proizvode</a>
    </div>
    <br><br>
    <div class="nav">
        <a href="{{ url('/addcategory') }}" class="btn">Dodaj kategorije</a>
    </div>
    <br />
    
    @if ($paginator->hasPages())
        <div class="pagination">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <div class="disabled"><span>&laquo;</span></div>
            @else
                <div><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></div>
            @endif
        <div class="grid-container">
            {{-- Pagination Elements --}}
            @foreach ($paginator as $element)
                {{-- "Three Dots" Separator --}}
                <div><a href="{{ url('products') }}/{{ $element->linkToProduct}}">{{ $element->name}}</a></div>
            @endforeach
       </div>
        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <div><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></div>
        @else
            <div class="disabled"><span>&raquo;</span></div>
        @endif
    </div>
    @else
    @foreach ($paginator as $element)
        {{-- "Three Dots" Separator --}}
        @if ($element->status == 1)
            <div><a href="{{ url('products') }}/{{ $element->linkToProduct}}">{{ $element->name}}</a></div>
        @endif
    @endforeach
@endif
</div>

 </body>
</html>

