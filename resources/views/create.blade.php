@php
use App\Models\Category;
use App\Models\Subcategory;
$categories = Category::get(); 
@endphp
<html lang="en">
<head>
  <title>Dodaj proizvod | Grizli</title>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
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
</div>
  <div class="container">
      @if (count($errors) > 0)
      <div class="alert alert-danger">
        <strong>Whoops!</strong> Unos nije dobar!<br><br>
        <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
        </ul>
      </div>
      @endif
        @if(session('success'))
        <div class="alert alert-success">
          Uspesno ste dodali proizvod!
        </div> 
        @endif
    <h3 class="jumbotron">Unos podataka</h3>
<form method="post" action="{{url('form')}}" enctype="multipart/form-data">
  {{csrf_field()}}
        <div class="form-group">
        <label>Naziv: </label>
        <input name="name" class="form-control"/>
        </div>
        <div class="form-group">
        <label>Kategorija: </label>
        <select class="form-control dropdown" onchange="toggleForm()" name="category" id="select_id">
            <option disabled selected>Izaberi kategoriju: </option>
            @foreach ($categories as $category)
              <option>{{$category->name}}</option>
            @endforeach
          </select>
        </div>

        <div  id="form" style="display: none;">
          <select id="subcats" class="form-control dropdown">
          </select>
       </div>

        <div class="form-group">
        <label>Opis: </label>
        <input name="description" class="form-control"/>
        </div>

        <div class="input-group control-group increment" >
          <input type="file" name="filename[]" class="form-control" onchange="preview()">
            <input type="hidden" id="delete-image-input" name="remove_image" value="0">
            <img id="frame" src="" class="img-fluid mt-3" />
            <p><button onclick="clearImage()" type="button" id="remove-img-btn" class="btn btn-danger mt-3 d-none">Remove image</button></p>
        </div>
        <div class="input-group-btn"> 
            <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
<div class="clone hide">
<div class="control-group input-group" style="margin-top:10px">
<input type="file" name="filename[]" class="form-control" onchange="preview()">

<div class="input-group-btn"> 
<button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
</div>
</div>
</div>

<button type="submit" class="btn-submit" style="margin-top:10px">Potvrdi</button>

  </form>   
  </div>


<script type="text/javascript">

    $(document).ready(function() {

      $(".btn").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

    });

    function preview(e) {
        frame.src = URL.createObjectURL(event.target.files[0]);
        document.getElementById('remove-img-btn').classList.remove('d-none');
    }

    function clearImage(e) {
    document.getElementById('image').value = null;
    document.getElementById('remove-img-btn').classList.add('d-none');
    document.getElementById('frame').value = null;
    frame.src = "";
    }

    window.addEventListener( "pageshow", function ( event ) {
    let historyTraversal = event.persisted || ( typeof window.performance != "undefined" && window.performance.navigation.type === 2 );
    if ( historyTraversal ) {
    // Handle page restore.
    window.location.reload();
    }
    });

    $(document).ready(function(){
    $(".alert").delay(5000).slideUp(500);
    });


    function toggleForm() {
        console.log("ee");
        const type = document.getElementById("select_id").value;
        document.getElementById("subcats").innerHTML='';
        const form = document.getElementById('form');

        if (type == "Izaberi") {
                form.style.display = 'block'
        }
        else {
            form.style.display = ''
        }

      var e = document.getElementById("select_id");
      var strUser = e.options[e.selectedIndex].value;


      $.ajax({
        type: 'GET',
        url: '/archive',
        data: {
        name: strUser,
        },
        success: function(data) {
        $.each(data.subcats, function(key, value) {
        $('#subcats')
        .append($("<option></option>")
        .attr("value",key)
        .text(value));
        });

      }
      });
    }


</script>


</body>
</html>