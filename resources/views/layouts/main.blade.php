<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>{{Config('const.QUICKQ.name')}}</title>
<meta name="viewport" content="width=device-width">
<link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

<link rel="stylesheet" href="{{asset('css/app.css')}}">
</head>
<body>
<div id='app'>
@yield('content')
</div>
</body>
<script src="{{asset('./js/app.js')}}"></script>

</html>
