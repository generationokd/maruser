<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>ログイン</title>
</head>
<body>
	<div class="container">
	@if(count($errors)>0)
	<strong class="text-danger">
	ID、パスワードは半角英数8桁以上16桁未満です。
	</strong>
	@endif
	<strong class="text-danger">
	{{$msg}}
	</strong>
	<form action="/maruser/public/main" method="post">
	{{ csrf_field() }}
	<div class="form-group">
	ID       <input type="text" name="id" class="form-control" value={{$id}}><br>
	</div>
	<div class="form-group">	
	パスワード   <input type="password" name="pass" class="form-control" value={{$pass}}><br>
	</div>
	<input type="submit" class="btn btn-success" value="ログイン">
	</form>
	<div class="form-group mt-2">		
	<a href="/maruser/public/main">
		戻る
	</a>
	</div>
	</div>

</body>