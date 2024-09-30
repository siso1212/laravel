@extends('layouts.admin')
@section('body')
<div class="table-responsive">
<form action="/admin/updateProduct/{{$product->id}}" method="post">
{{csrf_field()}}

<div class="form-group">
<lable for="name">Name</lable>
<input type="text" class="form-control" name="name"id="name" placeholder="Product Name" value="{{$product->name}}"requried>
</div>
<div class="form-group">
<lable for="description">Description</lable>
<input type="text"class="form-control" name="description" id="description"placeholder="description"value="{{$product->description}}"required>
</div>

<div class="form-group">
<lable for="type">Type</lable>
<input type="text"class="form-control" name="type" id="type"placeholder="type"value="{{$product->type}}" required>
</div>
<div class="form-group">
<lable for="Price">Price</lable>
<input type="text"class="form-control" name="price" id="price"placeholder="price"value="{{$product->price}}"required>
</div>
<button type="submit"name="submit"class="btn btn-defalut">Submit</button>
</form>
</div>
@endsection
