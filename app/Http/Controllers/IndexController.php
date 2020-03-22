<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IndexController extends Controller
{
  public function get(){
    return view('index');
  }

  public function post(Request $request){
    if($request->mode === 'create'){
      $param = [
        'mode' => $request->mode,
        'title' => $request->title,
        'memo' => $request->memo,
      ];
      \Debugbar::info($param);
      header('content-type: application/json; charset=utf-8');
      echo json_encode($param);
      exit;
    }
    return view('index',['param','ぱらめーただよ']);
  }
}
