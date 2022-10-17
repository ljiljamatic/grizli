@php
use App\Models\Form;
use App\Models\Category;
use App\Models\Subcategory;
$images = Form::where('product_id', $data->id)->orderBy('order','asc')->get(); 
@endphp

<html>
<head>
  <title>Stranica proizvoda | Grizli</title>
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

    <div class="product-data">
        <h4> {{$data->name}} </h4>
        <p> Opis: {{$data->description}} </p>
        <p> Kategorija: {{$data->category}} </p>
        <div class="row">
            <div class='list-group gallery'>
                @if($images->count())
                    @foreach($images as $image)
                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3'>
                        <img alt="" src="{{ url('/images/'.$image->product_id.'/'.$image->filename) }}" width="500" height="500"/>
                    </div> <!-- col-6 / end -->
                    @endforeach
                @else
                <img class="img-center" alt="" src="{{ url('/images/'.'blank.jpg') }}" width="500" height="500"/>
                @endif
            </div> <!-- list-group / end -->
    </div>
        <div class="buttons">
            <a href="{{url('products/delete/'.$data->id)}}" onclick="return confirm('Da li ste sigurni da želite da izbrišete ovaj proizvod?')" class="btn-delete"> Izbriši</a>
            <a href="{{url('updateproduct/'.$data->id)}}" class="btn-submit"> Ažuriraj proizvod</a>
        </div>
    </div>
    @if($previous != null)
        <a href="{{route('show', $previous->linkToProduct)}}" class="nav-left"> Prethodni</a>
    @endif
    @if($next != null)
        <a href="{{route('show', $next->linkToProduct)}}" class="nav-right"> Sledeći</a> 
    @endif
 </body>
</html>