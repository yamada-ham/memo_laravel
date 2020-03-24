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
    switch($request->mode){
      case 'create':
        $param = [
          // 'mode' => $request->mode,
          'title' => $request->title,
          'memo' => $request->memo,
        ];
        DB::table('memo')->insert($param);
        \Debugbar::info($param);
        header('content-type: application/json; charset=utf-8');
        echo json_encode($param);
        break;
      case 'update':
        $param = [
          'title' => $request->title,
          'memo' => $request->memo,
        ];
        \Debugbar::info($param);
        DB::table('memo')->where('id',$request->id)->update($param);
        break;
    }

    // return view('index',['param','ぱらめーただよ']);
    // return redirect()->route('');
  }
}
