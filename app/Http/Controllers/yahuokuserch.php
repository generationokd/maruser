<?php

if(count($argv)>1){

	$html = file_get_contents("https://auctions.yahoo.co.jp/search/search?p=". ($argv[1]));
	// 文字コードを揃える
	$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8');
	// 解析するためのオブジェクトの準備
	$doc = new DOMDocument();
	@$doc->loadHTML($html);

	// ここから解析　spanタグなので
	$spans = $doc->getElementsByTagName('p');

	//classがtotal
	//件数は数値で「,」有のため数値のみを受け取る
	foreach ($spans as $span) {
		if($span->getAttribute('class') == 'total'){
		preg_match('/[0-9,]+/u', $span->nodeValue, $array_result);
		echo  str_replace(',', '', $array_result[0]);
		}

	}
}
?>