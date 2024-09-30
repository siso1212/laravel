@extends('layouts.admin')
@section('body')
<div class="table-responsive">
    @if($errors->any())
    <div class="alert alert-danger">
        <ul>
            <li>{!! print_r($errors->all())!!}
</ul>
</div>
@endif
<h2>Create New Product Data</h2>
<form action="/admin/sendCreateProductForm" method="post"enctype="multipart/form-data" >
{{csrf_field()}}

<div class="form-group">
<lable for="name">Name</lable>
<input type="text" class="form-control" name="name"id="name" placeholder="Product Name"requried>
</div>
<div class="form-group">
<lable for="description">Description</lable>
<input type="text"class="form-control" name="description" id="description"placeholder="description"required>
</div>
<div class="form-group">
<lable for="image">Image</lable>
<input type="file"class="form-control" name="image" id="image"placeholder="image"required>
</div>

<div class="form-group">
<lable for="type">Type</lable>
<input type="text"class="form-control" name="type" id="type"placeholder="type" required>
</div>
<div class="form-group">
<lable for="Price">Price</lable>
<input type="text"class="form-control" name="price" id="price"placeholder="price"required>
</div>
<button type="submit"name="submit"class="btn btn-defalut">Submit</button>
</form>
</div>
@endsection
