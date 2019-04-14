<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <title>メイン画面</title>
</head>
<body>

<div class="container">
	<div class="row float-right">
		@if($loginname!='')
		<p>ようこそ{{$loginname}}さん</p>
		@endif
		@if($login)
		<p class="text-secondary px-3">ログイン中</p>
		@endif
		@if($login == false)
		<a href="/maruser/public/login" class="btn btn-info">
			ログイン
		</a>
		@endif
		@if($login == false)

		<a href="/maruser/public/regist/input" class="btn btn-info float-right">
			会員登録
		</a>
		@endif
		@if($login)
		<a href="/maruser/public/logout" class="btn btn-info pull-right">
			ログアウト
		</a>
		@endif
	</div>

	<form action="/maruser/public/main/serch" method="post">
	{{ csrf_field() }}
	<div class="input-group">
	<input type="text" class="form-control" name="word">
	<!-- ボタン -->
<button type="button" class="btn btn-outline-success" data-toggle="modal" data-target="#demoNormalModal">
    詳細
</button>
	</div>
	<input type="submit" class="btn btn-success" value="検索">
	</form>
<!--	<a href="/maruser/public/favorite">
		お気に入り
	</a>
-->	
	@if($login)
	<a href="/maruser/public/history" class="btn btn-primary">
		履歴
	</a>
	@endif
	<br>
	<table class="table table-bordered">
		<tr>
			<th width="50%">サイト</th>
			<th width="50%">検索結果</th>
		</tr>	
		<tr>
			<th><a href={{$rakutenURL}} target="_blank">楽天市場</a></th>
			<td> {{$resultRakuten}}</td>
		</tr>
		<tr>
			<th><a href={{$yahooURL}} target="_blank">Yahoo!ショッピング</a></th>
			<td> {{$resultYahoo}}</td>
		</tr>
		<tr>
			<th><a href={{$yahuokuURL}} target="_blank">ヤフオク</a></th>
			<td> {{$resultYahuoku}}</td>
		</tr>
		<tr>
			<th><a href={{$yodobashiURL}} target="_blank">ヨドバシ</a></th>
			<td> {{$resultYodobashi}}</td>
		</tr>
		<tr>
			<th><a href={{$amazonURL}} target="_blank">amazon</a></th>
			<td> {{$resultAmazon}}</td>
		</tr>
	</table>

<!--
	<form action="/maruser/public/favorite" method="get">
	<input type="submit" value="お気に入り">
	</form>

	<form action="/maruser/public/history" method="get">
	<input type="submit" value="履歴">
	</form>

	<form action="/maruser/public/login" method="get">
		<input type="hidden" name="type" value="login">
	<input type="submit" value="ログイン">
	</form>

	<form action="/maruser/public/regist/input" method="get">
	<input type="submit" value="会員登録">
	</form>

	<form action="/maruser/public/login" method="get">
		<input type="hidden" name="type" value="logout">
	<input type="submit" value="ログアウト">
	</form>
-->

</div>
<!-- モーダルダイアログ -->
<div class="modal fade" id="demoNormalModal" tabindex="-1" role="dialog" aria-labelledby="modal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="demoModalTitle">詳細検索</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            	<div class="row">
	            <div class="m-1">金額範囲  
                <input type="text" name="pricemin">円
                ～
                <input type="text" name="pricemax">円
            	</div>
            	</div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
                <button type="button" class="btn btn-primary">決定</button>
            </div>
        </div>
    </div>
</div>

</body>