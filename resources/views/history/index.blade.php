<!DOCTYPE html>
<html>
<head>
<?php
use Carbon\Carbon;
?>

  <meta charset="utf-8">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

  <title>履歴</title>
</head>
<body>
<table class="table table-bordered">
	<tr>
		<th width="80%">検索ワード</th>
		<th></th>
		<th width="20%">日時</th>
	</tr>	
@foreach($words as $word)
<tr>
<td>
	<div class="row">
		<div class="col">
		{{$word->word}}	
		</div>
		<form action="/maruser/public/main/serch" method="post">
		{{ csrf_field() }}
		<div class="col">
		<input type="hidden" class="form-control" name="word" value="{{$word->word}}">

		<input type="submit" class="btn btn-success btn-sm" value="再検索">
		</form>
		</div>
	</div>
</td>
<td>
	<form action="/maruser/public/history/delete" method="post">
	{{ csrf_field() }}
	<input type="hidden" class="form-control" name="word" value="{{$word->word}}">
	<input type="submit" class="btn btn-danger btn-sm" value="削除">
	</form>

</td>
<td>{{Carbon::createFromTimestamp($word->timestamp)->format("Y-m-d H:i:s")}}</td>

</tr>
@endforeach
</table>
@if($count>1)
  <ul class="pagination">
  	@if($count>5 and $page>=4)
    <li class="page-item"><a class="page-link" href="/maruser/public/history?page=1">先頭へ</a></li>
  	@endif
  	@if($page>1)
    <li class="page-item"><a class="page-link" href="/maruser/public/history?page={{$page-1}}">前へ</a></li>
    @endif
    @if($count<=5)
	    @for($i = 1; $i < $count; $i++)
	    @if($page == $i)
	    <li class="page-item active" aria-current="page"><a class="page-link" href="/maruser/public/history?page={{$i}}">{{$i}}</a></li>
	    @else
	    <li class="page-item"><a class="page-link" href="/maruser/public/history?page={{$i}}">{{$i}}</a></li>
	    @endif
	    @endfor
	@else
		@if($page==$count or $page==$count-1 or $page==$count-2)
			@for($i=$count-4; $i<=$count; $i++)
		    @if($page == $i)
		    <li class="page-item active" aria-current="page"><a class="page-link" href="/maruser/public/history?page={{$i}}">{{$i}}</a></li>
		    @else
		    <li class="page-item"><a class="page-link" href="/maruser/public/history?page={{$i}}">{{$i}}</a></li>
		    @endif
			@endfor
		@elseif($page==1 or $page==2 or $page==3)
		    @for($i = 1; $i <= 5; $i++)
		    @if($page == $i)
		    <li class="page-item active" aria-current="page"><a class="page-link" href="/maruser/public/history?page={{$i}}">{{$i}}</a></li>
		    @else
		    <li class="page-item"><a class="page-link" href="/maruser/public/history?page={{$i}}">{{$i}}</a></li>
		    @endif
		    @endfor
		@else
		    @for($i = $page-2; $i <= $page+2; $i++)
		    @if($page == $i)
		    <li class="page-item active" aria-current="page"><a class="page-link" href="/maruser/public/history?page={{$i}}">{{$i}}</a></li>
		    @else
		    <li class="page-item"><a class="page-link" href="/maruser/public/history?page={{$i}}">{{$i}}</a></li>
		    @endif
		    @endfor
	    @endif
    @endif
  	@if($page!=$count)
    <li class="page-item"><a class="page-link" href="/maruser/public/history?page={{$page+1}}">次へ</a></li>
    @endif
   	@if($count>5 and $page<$count-2)
    <li class="page-item"><a class="page-link" href="/maruser/public/history?page={{$count}}">最後へ</a></li>
  	@endif

  </ul>
@endif

	<div class="form-group mt-2">		
	<a href="/maruser/public/main">
		戻る
	</a>
	</div>

</body>
