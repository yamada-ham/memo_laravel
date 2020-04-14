@extends('layouts.main')

@section('content')
  @php
  if(!isset($param)){$param = 'から';}else{echo $param;}
  @endphp
  <main-component></main-component>

  {{-- @foreach($memos as $memo)
    <update-memo-component memo-data="{{json_encode($memos)}}"></update-memo-component>
  @endforeach --}}
@endsection
