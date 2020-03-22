@extends('layouts.main')

@section('content')
  @php
  if(!isset($param)){$param = 'から';}else{echo $param;}
  @endphp
  <main-component memo-param='{{$param}}'></main-component>
@endsection
