<?php

if(count($argv)>1){

	$html = file_get_contents("https://www.yodobashi.com/?word=". ($argv[1]));
	// 文字コードを揃える
	$html = mb_convert_encoding($html, 'HTML-ENTITIES', 'utf-8');
	// 解析するためのオブジェクトの準備
	$doc = new DOMDocument();
	@$doc->loadHTML($html);

	// ここから解析　h2タグなので
	$spans = $doc->getElementsByTagName('h2');

	//classがnumOfSearchなので
	//件数は数値表記のみなので、数字を取得
	//検索ワードに数値が入っていた場合エラーになるため修正
/*	foreach ($spans as $span) {
		if($span->getAttribute('class') == 'numOfSearch'){
		preg_match('/[0-9]+/u', $span->nodeValue, $array_result);
*/
	foreach ($spans as $span) {
		if($span->getAttribute('class') == 'numOfSearch'){
		preg_match('/で(.*)件/', $span->nodeValue, $array_result);

	//データ件数0件対応(空でない場合出力)
		if(!empty($array_result)){
			$dmmy = str_replace('件', '', $array_result[1]);
			echo $dmmy;
			}
		}	

	}
}
?>