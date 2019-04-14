<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class historyController extends Controller
{
    public function index(Request $request){
        $seq = $request->session()->get('seq');
        $login = $request->session()->get('login');
        if(empty($request->page)){
            $offset = 0;
            $page =1;
            }else{
            $offset = ($request->page)*10-10;
            $page = $request->page;
        }
//        $offset = 0;
        //ログイン中のみ履歴取得処理を行う。
        if($login){
        //履歴をタイムスタンプ降順で読み込む
    $words = DB::select('SELECT * FROM history WHERE seq=:seq ORDER BY timestamp DESC LIMIT 10 OFFSET :offset', ['seq' => $seq,'offset' => $offset,]);
    //何件持ってるか
    $wordscount = DB::select('SELECT count(*) FROM history WHERE seq=:seq', ['seq' => $seq,]);
    //最大ページ数
    $count = (((int)$wordscount{0}->{"count(*)"}-1)/10)+1;
    $count = intval($count);
    //var_dump($words);

    //var_dump($wordscount);
/*    echo $wordscount{0}->{"count(*)"};

    echo $words{0}->{"word"};
    $time = $words{0}->{"timestamp"};
    echo Carbon::createFromTimestamp($time)->format("Y-m-d H:i:s");    
*/        }

    	return view('history.index',['words'=>$words,'count'=>$count,'page'=>$page]);
    }
}
