<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>@yield('title')</title>
<meta name="viewport" content="width=divice-width, initial-scale=1.0">
<meta name="description" content="">
<link href="{{asset('css/bootstrap.css')}}" rel="stylesheet">
<script src="{{asset('js/jqurey.min.js')}}"></script>
<link href="{{asset('css/dashborad..css')}}" rel="stylesheet">
<link href="{{asset('css/nav.css')}}"rel="stylesheet">
</head>
<body>

</div>
<div class="topnav">
<a class="navbar-brand"href="#">Admin Panel</a>

  <a class="active" href="/">Home</a>
  <a href="/admin/products">Dashborad</a>
  <a href="#">Settings</a>
  <a href="#">Profile</a>
  <a href="#">Help</a>

</div>
<div class="container-fluid">
<div class="row">
<div class="col-sm-3 col-md-2 sidebar">
<ul class="nav-bar nav-sidebar">
<li class="active"><a href="/admin/index">Overview<span class="sr-only">(Current)</span></a></li>
<li><a href="createProductForm">Insert</a></li>
<li><a href="#">Edit</a></li>
<li><a href="/admin/users">Users</a></li>
<li><a href="#">Analiytics</a></li>
</ul>
<ul class="nav-bar nav-sidebar">
</ul>
<ul class="nav-bar nav-sidebar">
</ul>
</div>
<div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
<h1 class="page-header">Dashborad</h1>
@yield('body')
</div>
</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="{{asset('dashborad.js')}}"></script>
</body>
</html> 