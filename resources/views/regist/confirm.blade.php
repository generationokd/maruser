<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>会員登録</title>
</head>
<body>
<div class="container">
	<form action="/maruser/public/regist/complete" method="post">
		{{ csrf_field() }}
		<div class="form-group">
			<label>ID</label>
			<label class="form-control">{{$id}}</label><br>
		</div>
		<div class="form-group">	
			<label>パスワード</label>
			<label class="form-control">*********</label><br>
		</div>
		<div class="form-group">	
			<label>ニックネーム</label>
			<label class="form-control">{{$name}}</label><br>
		</div>
		<div class="form-group">	
			<label>メールアドレス</label>
			<label class="form-control">{{$mail}}</label><br>
		</div>
		<input type="hidden" name="id" value="{{$id}}">
		<input type="hidden" name="pass" value="{{$pass}}">
		<input type="hidden" name="name" value="{{$name}}">
		<input type="hidden" name="mail" value="{{$mail}}">

		<input type="submit" class="btn btn-success" value="登録">
	</form>

	<form action="/maruser/public/regist/input" method="post">
		{{ csrf_field() }}
		<!-- 修正時、入力内容を保持 -->
		<input type="hidden" name="id" value="{{$id}}">
		<input type="hidden" name="pass" value="{{$pass}}">
		<input type="hidden" name="name" value="{{$name}}">
		<input type="hidden" name="mail" value="{{$mail}}">

		<input type="submit" class="btn btn-success mt-2" value="修正">
	</form>
</div>
</body>