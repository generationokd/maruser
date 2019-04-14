<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class loginController extends Controller
{
    public function index(Request $request){
/*    ログイン・ログアウトを別処理にしたため不要  
      $type = $request->type;
      
      switch($type){
        case "login":
        return view('login.index',['msg'=>'','id'=>'','pass'=>'',]);        
        break;
        case "logout":
        $request->session()->forget('loginname');
        return view('main.index',['loginname'=>'',]);
        break;
        default:
        return view('main.index',['loginname'=>'',]);
        break;
      }
*/
        return view('login.index',['msg'=>'','id'=>'','pass'=>'',]);      
    }

    public function logincheck(Request $request){
      $id = $request->id;
      $pass = $request->pass;

      //値の妥当性チェック
      $rule = [
        //省略不可、英数字、8桁以上16桁以下
        'id' => 'required|alpha_num|min:8|max:16',
        'pass' => 'required|alpha_num|min:8|max:16',
      ];

      $this->validate($request, $rule);
      //ハッシュ化
      $pass=Hash::make($pass);

      $items = DB::select('SELECT * FROM member WHERE id=:id AND pass=:pass', [
        'id' => $id,
        'pass' => $pass,
        ]
      );

    

      // 登録データ有
    if(count($items) > 0){
      //DBアクセス時の名前をわたす
      $name = $items{0}->{"name"};
      $seq = $items{0}->{"seq"};
      $login = true;
      //loginname,seqをセッションに保存
      $request->session()->put('loginname',$name);
      $request->session()->put('seq',$seq);
      //login成功時、login中をtrueで表す
      $request->session()->put('login',$login);

      $main = [
        'loginname'=>$name,
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
    else{
      // エラー無時、登録確認画面へ遷移
      $data = [
            'msg' => 'IDまたはパスワードに誤りがあります。', 
            'id'=>$id,
            'pass'=>$pass,
             ];
      return view('login.index', $data);
    	}

    }
}