<!DOCTYPE html>
<html>
 <head>
  <title>Dodaj Kategorije | Grizli</title>
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
  <div class="nav">
    <div class="nav-left">
     <a href="{{ url('/home') }}">Početna strana</a>
    </div>
    <div class="nav-right">
     <a href="{{ url('/home/logout') }}" class="right">Odjavi se</a>
    </div>
  </div>
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
<div class="content">
  <form method="POST" action="/addcategories" class="form">
  {{ csrf_field() }}
  <h3>Unos podataka</h3><br>
    <div class="form-group">
     <label>Kategorija: </label>
     <input name="category" class="form-control"/>
    </div>
    <label>Podkategorija: </label>
    <div class="input-group control-group increment" >
      <input type="text" name="subcategory[]" class="form-control">
          <div class="input-group-btn"> 
              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
    </div>
    <div class="clone hide">
        <div class="control-group input-group" style="margin-top:10px">
            <input type="text" name="subcategory[]" class="form-control">
              <div class="input-group-btn"> 
                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
              </div> 
        </div> 
    </div>
    <div class="form-group center">
      <input type="submit" name="login" class="btn-submit" value="Potvrdi" onclick="return confirm('Da li ste sigurni?')"/>
    </div>
</form>

</div>
</body>
</html>


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
</script>