@php
use App\Models\Form;
$images = Form::where('product_id',$select->id)->orderBy('order', 'asc')->get(); 
@endphp


<!DOCTYPE html>
<html>
 <head>
  <title>Ažuriranje | Grizli</title>
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
  <form method="PUT" action="/changeproduct/{{$select->id}}">
  {{ csrf_field() }}
  <h3>Ažuriranje podataka</h3><br>
    <div class="form-group">
     <label>Naziv: </label>
     <input name="name" class="form-control" value="{{$select->name}}"/>
    </div>
    <div class="form-group">
     <label>Kategorija: </label>
     <input name="category" class="form-control" value="{{$select->category}}"/>
    </div>
    <label>Podkategorija: </label>
    <div class="input-group control-group increment" >
    @foreach($subcategories as $subcategory)
      <input type="text" name="subcategory[]" class="form-control" value="{{$subcategory->name}}">
    @endforeach
    </div>
    <div class="input-group-btn"> 
              <button class="btn btn-success" type="button"><i class="glyphicon glyphicon-plus"></i>Add</button>
          </div>
    <div class="clone hide">
        <div class="control-group input-group" style="margin-top:10px">
            <input type="text" name="subcategory[]" class="form-control">
              <div class="input-group-btn"> 
                <button class="btn btn-danger" type="button"><i class="glyphicon glyphicon-remove"></i> Remove</button>
              </div> 
        </div> 
    </div>
    <div class="form-group">
     <label>Opis: </label>
     <input name="description" class="form-control" value="{{$select->description}}"/>
    </div>

    <div class="form-group center">
      <input type="submit" name="login" class="btn-submit" value="Potvrdi" onclick="return confirm('Da li ste sigurni?')"/>
    </div>
</div>

<div class="row">
            <div class='list-group gallery'>
                @if($images->count())
                    @foreach($images as $image)
                    <div class='col-sm-4 col-xs-6 col-md-3 col-lg-3 box' draggable="true" id="{{$image->filename}}">
                        <img alt="" src="{{ url('/images/'.$image->product_id.'/'.$image->filename) }}" width="500" height="500"/>
                        <form action="{{ url('/destroy',$image->id) }}" method="POST">
                            <input type="hidden" name="_method" value="delete">
                            {!! csrf_field() !!}
                            <button type="submit" class="close-icon btn btn-danger" onclick="return confirm('Da li ste sigurni da želite da izbrišete ovu sliku?')"><i class="glyphicon glyphicon-remove"></i></button>
                        </form>
                    </div> <!-- col-6 / end -->
                    @endforeach
                @else
                <img class="img-center" alt="" src="{{ url('/images/'.'blank.jpg') }}" width="500" height="500"/>
                @endif
            </div> <!-- list-group / end -->
    </div>
    </form>
 </body>
</html>

<script type="text/javascript">

document.addEventListener('DOMContentLoaded', (event) => {
this.data = [[], [], [], []];
this.currentDrag = {};

function handleDragStart(e) {
  this.style.opacity = '0.4';
  dragSrcEl = this;

  e.dataTransfer.effectAllowed = 'move';
  e.dataTransfer.setData('text/html', this.innerHTML);
}

function handleDragEnd(e) {
  this.style.opacity = '1';

  items.forEach(function (item) {
    item.classList.remove('over');
  });
}

function handleDragOver(e) {
  e.preventDefault();
  return false;
}

function handleDragEnter(e) {
  this.classList.add('over');
}

function handleDragLeave(e) {
  this.classList.remove('over');
}

function handleDrop(e) {
  e.stopPropagation();
  console.log("menjam mene");
  second = this.getAttribute("id")
  console.log(second);
  console.log("pomeram ovo");
  first = dragSrcEl.getAttribute("id");
  console.log(first);
  if (dragSrcEl !== this) {
    dragSrcEl.innerHTML = this.innerHTML;
    this.innerHTML = e.dataTransfer.getData('text/html');
  }

  $.ajax({
        type: 'GET',
        url: 'http://localhost:8000/login',
        data: {
        first: first,
        second: second,
        },
        success: function(data) {
          console.log(data)
        $.each(data.subcats, function(key, value) {
        $('#subcats')
        .append($("<option></option>")
        .attr("value",key)
        .text(value));
        });

      }
      });
  return false;
    }
let currentDrag = [];
let items = document.querySelectorAll('.row .box');
items.forEach(function(item) {
  currentDrag.push(item.getAttribute("id"));
  item.addEventListener('dragstart', handleDragStart);
  item.addEventListener('dragover', handleDragOver);
  item.addEventListener('dragenter', handleDragEnter);
  item.addEventListener('dragleave', handleDragLeave);
  item.addEventListener('dragend', handleDragEnd);
  item.addEventListener('drop', handleDrop);
});
console.log(currentDrag);

});


    $(document).ready(function() {

      $(".btn").click(function(){ 
          var html = $(".clone").html();
          $(".increment").after(html);
      });

      $("body").on("click",".btn-danger",function(){ 
          $(this).parents(".control-group").remove();
      });

      $(".btn-submit").click(function(){ 
        let newItems = document.querySelectorAll('.row .box');
        console.log(newItems);
      });
    });
</script>