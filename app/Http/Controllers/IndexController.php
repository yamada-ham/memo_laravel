<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
  public function get(){
    $memos = DB::table('memo')->get();
    // $memos = json_encode($memos);
    // \Debugbar::info(['db'=>$memos]);
    return view('index',['memos'=>$memos]);
  }

  public function post(Request $request){
    switch($request->mode){
      case 'select':
        $selectAll = DB::table('memo')->where('isArchive',false)->orderBy('id','desc')->get();
        header('content-type: application/json; charset=utf-8');
        echo json_encode($selectAll);
        break;
      case 'create':
        $param = [
          // 'mode' => $request->mode,
          'title' => $request->title,
          'memo' => $request->memo,
          'backgroundColor'=>$request->backgroundColor,
          'label'=>$request->label,
          'isArchive' => false
        ];
        DB::beginTransaction();
        try{
          DB::table('memo')->insert($param);
          $lastInsertId = DB::table('memo')->max('id');
          $lastInsertMemo = DB::table('memo')->where('id',$lastInsertId)->first();
          header('content-type: application/json; charset=utf-8');
          echo json_encode($lastInsertMemo);
          DB::commit();
        }catch(\Exception $e){
          DB::rollback();
          \Debugbar::error($e);
        }

        break;
      case 'update':
        $param = [
          'title' => $request->title,
          'memo' => $request->memo,
          'backgroundColor'=>$request->backgroundColor,
          'isArchive'=>$request->isArchive,
        ];
        DB::table('memo')->where('id',$request->id)->update($param);
        header('content-type: application/json; charset=utf-8');
        echo json_encode('Successfully updated!!');
        break;
      case 'delete':
        DB::table('memo')->where('id',$request->id)->delete();
        header('content-type: application/json; charset=utf-8');
        echo json_encode('Successfully deleted!!');
        break;
      case 'createLabel':
        DB::table('labels')->insert(['label'=>$request->label]);
        header('content-type: application/json; charset=utf-8');
        echo json_encode('Successfully Create Label!!');
        break;
      case 'selectLabel':
        $selectAll = DB::table('labels')->get();
        header('content-type: application/json; charset=utf-8');
        echo json_encode($selectAll);
        break;
      case 'download':
        echo json_encode('ダウンロード機能作成中');
        break;
    }

    // return view('index',['param','ぱらめーただよ']);
    // return redirect()->route('');
  }
}
