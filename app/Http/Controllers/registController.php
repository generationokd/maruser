<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;

class registController extends Controller
{
    public function input(Request $request){
    //修正時、入力内容を保持するためid,pass,nameを持っとく
        $id = $request->session()->get('id');
        $pass = $request->session()->get('pass');
        $passcheck = $request->session()->get('passcheck');
        $name = $request->session()->get('name');
        $mail = $request->session()->get('mail');

    	return view('regist.input',['msg'=>'','id'=>$id,'pass'=>$pass,'passcheck'=>$passcheck,'name'=>$name,'mail'=>$mail,]);
    }

    //getでconfirmを呼ぶときは異常処理の時なので、inputと同じ処理をする
    public function confirm(Request $request){
        $id = $request->session()->get('id');
        $pass = $request->session()->get('pass');
        $passcheck = $request->session()->get('passcheck');
        $name = $request->session()->get('name');
        $mail = $request->session()->get('mail');

        return view('regist.input',['msg'=>'','id'=>$id,'pass'=>$pass,'passcheck'=>$passcheck,'name'=>$name,'mail'=>$mail,]);
    }
    public function complete(){
    	return view('regist.complete');
    }
    public function registcheck(Request $request){
    $id = $request->id;
    $pass = $request->pass;
    $passcheck = $request->passcheck;
    $name = $request->name;
    $mail = $request->mail;

    echo $pass;
    echo Hash::make($pass);

    //セッションの保存
    $request->session()->put('id',$id);
    $request->session()->put('pass',$pass);
    $request->session()->put('passcheck',$passcheck);
    $request->session()->put('name',$name);
    $request->session()->put('mail',$mail);

    //値の妥当性チェック
    $rule = [
        //省略不可、英数字、8桁以上16桁以下
        'id' => 'required|alpha_num|min:8|max:16',
        'pass' => 'required|alpha_num|min:8|max:16',
        'name' => 'required|max:40',
        'mail' => 'nullable|email|max:255',
    ];

    $this->validate($request, $rule);

    if($pass != $passcheck){
         $data = [
            'msg' => 'パスワードが一致しません。', 
            'id'=>$id,
            'pass'=>$pass,
            'passcheck'=>$passcheck,
            'name'=>$name,
            'mail'=>$mail,
             ];
      return view('regist.input', $data);
        
    }

    $items = DB::select('SELECT * FROM member WHERE id=:id', [
      'id' => $id,
      ]
    );

    if(count($items) > 0){
      // 登録データ有
      $data = [
            'msg' => '既にIDが登録されています。', 
            'id'=>$id,
            'pass'=>$pass,
            'passcheck'=>$passcheck,
            'name'=>$name,
            'mail'=>$mail,
             ];
      return view('regist.input', $data);
    }
    else{
      // エラー無時、登録確認画面へ遷移
      return view('regist.confirm',['id'=>$id,'pass'=>$pass,'passcheck'=>$passcheck,'name'=>$name,'mail'=>$mail,]);
    }

    }

    public function regist(Request $request){
    $rule = [
    //省略不可、英数字、8桁以上16桁以下
    'id' => 'required|alpha_num|min:8|max:16',
    'pass' => 'required|alpha_num|min:8|max:16',
    'name' => 'required',
    'mail' => 'email',
    ];

    $this->validate($request, $rule);

    $param = [
        'id' => $request->id,
        'pass' => $request->pass,
        'name' => $request->name,
        'mail' => $request->mail,
    ];    
    DB::insert('insert into member (id,pass,name,mail) values(:id,:pass,:name,:mail)',$param);
    Mail::to($request->mail)
        ->send(new TestMail());
    return view('regist.complete');

    }
}