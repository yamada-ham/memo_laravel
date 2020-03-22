@extends('layouts.main')

@section('content')
  @isset($title)
    <p>{{$title}}</p>
  @endisset
  @empty($title)
    <p>タイトルない</p>
  @endempty
  <main-component></main-component>
@endsection
