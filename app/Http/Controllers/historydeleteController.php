<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class historydeleteController extends Controller
{
    public function index(Request $request){
        $seq = $request->session()->get('seq');
        $word = $request->word;
        $login = $request->session()->get('login');
        if(empty($request->page)){
            $offset = 0;
            $page =1;
            }else{
            $offset = ($request->page)*10-10;
            $page = $request->page;
        }
    //削除
    DB::delete('delete from history where seq = :seq and word = :word',['seq' => $seq,'word' => $word,]);

    $words = DB::select('SELECT * FROM history WHERE seq=:seq ORDER BY timestamp DESC LIMIT 10 OFFSET :offset', ['seq' => $seq,'offset' => $offset,]);
    //何件持ってるか
    $wordscount = DB::select('SELECT count(*) FROM history WHERE seq=:seq', ['seq' => $seq,]);
    //最大ページ数
    $count = (((int)$wordscount{0}->{"count(*)"}-1)/10)+1;
    $count = intval($count);


    	return view('history.index',['words'=>$words,'count'=>$count,'page'=>$page]);
    }
}