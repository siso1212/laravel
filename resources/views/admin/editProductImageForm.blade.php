@extends('layouts.admin')
@section('body')
<div class="table-responsive">
@if ($errors->any())
<div class="alert alert-danger">
<ul>
<li>(!!print_r($errors->all())!!)</li>
</ul>
</div>
@endif
<h3>current Image</h3>
<div><img src="{{asset('storage')}}/pimages/{{$product['image']}}"width="100"height="100"style="max-height:220"></div>
<form action="/admin/updateProductImage/{{$product->id}}"method="post" enctype="multipart/form-data">
{{csrf_field()}}
<div class="form-group">
<lable for="description">updateImage</lable>
<input type="file" class=""name="image"id="image" placeholder="image" value="{{$product->image}}"required>
</div>
<button type="submit"name="submit"class="btn btn-defalut">Submit</button>
</form>
</div>
@endsection
