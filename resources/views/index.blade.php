@extends('layouts.main')

@section('content')
  @php
  if(!isset($param)){$param = 'から';}else{echo $param;}
  @endphp
  @isset($memos)
    {{$memos}}
  @endisset
  <create-memo-component></create-memo-component>
@endsection
