<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>会員登録</title>
</head>
<body>
<div class="container">

	@if(count($errors)>0)
	<strong class="text-danger">
	入力に誤りがあります。
	</strong>
	@endif
	<strong class="text-danger">	
	{{$msg}}
	</strong>
	<form action="/maruser/public/regist/confirm" method="post">
		{{ csrf_field() }}
		@if($errors->has('id') or $errors->has('pass'))
		<strong class="text-danger">
		IDまたはパスワードに誤りがあります。<br>
		</strong>
		@endif
		@if($errors->has('mail'))
		<strong class="text-danger">
		メールアドレスに誤りがあります。<br>
		</strong>
		@endif
		<div class="form-group">
			<label>ID（8桁以上16桁以下）</label>
			<input type="text" name="id" class="form-control"  value={{$id}}><br>
		</div>
		<div class="form-group">
			<label>パスワード（8桁以上16桁以下）</label>
			<input type="password" name="pass" class="form-control" value={{$pass}}><br>
		</div>
		<div class="form-group">
			<label>パスワード（確認用）</label>
			<input type="password" name="passcheck" class="form-control" value={{$passcheck}}><br>
		</div>
		<div class="form-group">
			<label>ニックネーム</label>
			<input type="text" name="name" class="form-control" value={{$name}}><br>
		</div>
		<div class="form-group">
			<label>メールアドレス（任意）</label>
			<input type="text" name="mail" class="form-control" value={{$mail}}><br>
		</div>
		<input type="submit" class="btn btn-success" value="登録">
	</form>
	<div class="form-group mt-2">	
		<a href="/maruser/public/main">
			メインページへ
		</a>
	</div>
</div>
</body>