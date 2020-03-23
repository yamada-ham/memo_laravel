<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
  public function get(){
    $memos = DB::table('memo')->get();
    // $memos = json_encode($memos);
    \Debugbar::info(['db'=>$memos]);
    return view('index',['memos'=>$memos]);
  }

  public function post(Request $request){
    if($request->mode === 'create'){
      $param = [
        // 'mode' => $request->mode,
        'title' => $request->title,
        'memo' => $request->memo,
      ];
      DB::table('memo')->insert($param);
      \Debugbar::info($param);
      header('content-type: application/json; charset=utf-8');
      echo json_encode($param);
    }
    // return view('index',['param','ぱらめーただよ']);
    // return redirect()->route('');
  }
}
