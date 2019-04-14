<?php

if(count($argv)>1){

	$html = file_get_contents("https://shopping.yahoo.co.jp/search?p=". ($argv[1]));
	// 文字コードを揃える
	$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8');
	// 解析するためのオブジェクトの準備
	$doc = new DOMDocument();
	@$doc->loadHTML($html);

	// ここから解析　spanタグなので
	$spans = $doc->getElementsByTagName('h1');

	//classがcount _mediumなので
	foreach ($spans as $span) {
		if($span->getAttribute('class') == 'elTitle'){
		preg_match('/（(.*)）/', $span->nodeValue, $array_result);
		$dmmy = str_replace('件', '', $array_result[1]);
		echo  str_replace(',', '', $dmmy);

		}

	}
}
?>