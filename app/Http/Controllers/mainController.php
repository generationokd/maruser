<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class mainController extends Controller
{
    public function index(Request $request){
//        $timestamp = Carbon::now()->timestamp;
//        echo Carbon::createFromTimestamp($timestamp)->format("Y-m-d H:i:s");

        $loginname = $request->session()->get('loginname');
        $seq = $request->session()->get('seq');
        $login = $request->session()->get('login');


        $main = [
            'loginname'=>$loginname,
            'login'=>$login,
            'rakutenURL'=>'https://search.rakuten.co.jp/search/mall/',
            'resultRakuten'=>'',
            'yahooURL'=>'https://shopping.yahoo.co.jp/',
            'resultYahoo'=>'',
            'yahuokuURL'=>'https://auctions.yahoo.co.jp/',
            'resultYahuoku'=>'',
            'yodobashiURL'=>'https://www.yodobashi.com/',
            'resultYodobashi'=>'',
            'amazonURL'=>'https://www.amazon.co.jp/',
            'resultAmazon'=>'',
        ];

    	return view('main.index',$main);
    }
    
    public function serch(Request $request){
    	$loginname = $request->session()->get('loginname');
        $login = $request->session()->get('login');
        $seq = $request->session()->get('seq');
        $word = $request->word;
        //第一引数はコマンドファイル場所、第二引数は検索ワード
        //楽天
        $cmd = "php " . __DIR__ . "\\serch.php ".urlencode($word);
        $resultRakuten = `$cmd`;
        //yahoo
        $cmd = "php " . __DIR__ . "\\yahooserch.php ".urlencode($word);
        $resultYahoo = `$cmd`;        
        //ヤフオク
        $cmd = "php " . __DIR__ . "\\yahuokuserch.php ".urlencode($word);
        $resultYahuoku = `$cmd`;
        //yodobashi
        $cmd = "php " . __DIR__ . "\\yodobashiserch.php ".urlencode($word);
        $resultYodobashi = `$cmd`;
        //amazon
        $cmd = "php " . __DIR__ . "\\amazonserch.php ".urlencode($word);
        $resultAmazon = `$cmd`;

        //ログイン中は履歴ファイルに更新する
        if($login){
            $param = [
                'seq' => $seq,
                'word' => $word,
                'timestamp' => Carbon::now()->timestamp,
            ];


            $items = DB::select('SELECT * FROM history WHERE seq=:seq AND word=:word', [
                'seq' => $seq,
                'word' => $word,
                ]
            );
            //同一seq,wordが存在する場合はtimestampを更新
            //存在しない場合は新規レコードを登録
            if(count($items) > 0){
                DB::update('update history set timestamp = :timestamp where seq = :seq and word = :word',$param);
            }else{
                DB::insert('insert into history (seq,word,timestamp) values(:seq,:word,:timestamp)',$param);
            }
        }

        $main = [
            'loginname'=>$loginname,
            'login'=>$login,
            'rakutenURL'=>'https://search.rakuten.co.jp/search/mall/'.urlencode($word),
            'resultRakuten'=>number_format($resultRakuten).'件',
            'yahooURL'=>'https://shopping.yahoo.co.jp/search?p='.urlencode($word),
            'resultYahoo'=>number_format($resultYahoo).'件',
            'yahuokuURL'=>'https://auctions.yahoo.co.jp/search/search?p='.urlencode($word),
            'resultYahuoku'=>number_format($resultYahuoku).'件',
            'yodobashiURL'=>'https://www.yodobashi.com/?word='.urlencode($word),
            'resultYodobashi'=>number_format($resultYodobashi).'件',
            'amazonURL'=>'https://www.amazon.co.jp/s?k='.urlencode($word),
            'resultAmazon'=>number_format($resultAmazon).'件',
        ];

    	return view('main.index',$main);
    }

}
