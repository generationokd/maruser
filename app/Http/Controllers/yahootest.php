<?php

if(count($argv)>1){

	$html = file_get_contents("https://shopping.yahoo.co.jp/search?p=".urlencode ($argv[1]));
	// 文字コードを揃える
	$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8');
	// 解析するためのオブジェクトの準備
	$doc = new DOMDocument();
	@$doc->loadHTML($html);

	// ここから解析　spanタグなので
	$spans = $doc->getElementsByTagName('dd');

	//classがcount _mediumなので
	foreach ($spans as $span) {
		//ヤフーショッピングで金額部分のみを切り取る
		if($span->getAttribute('class') == 'elPrice'){
		preg_match('/[0-9,]+/u', $span->nodeValue, $array_result);
			echo $array_result[0];
			echo "/";
		}

	}
}
?>