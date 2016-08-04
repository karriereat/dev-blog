<?php

$dir = scandir("../legacy");
$posts = [];
$authorList = [
		0   =>  'Fichtl',
		1   =>  'Alex',
		2   =>  'Mori',
		3   =>  'Fred',
		4   =>  'Markus',
		5   =>  'Lenzi',
		6   =>  'Günther',
		7   =>  'Gustl',
		8   =>  'Paul',
		9   =>  'Wolfgang',
		10  =>  'Jürgen',
		11  =>  "Manu",
		13  =>  "Eva",
		15  =>  "Anita",
		16  =>  "Michael",
		17  =>  "Sharon",
		18  =>  "Klemens 🚬",
		19  =>  "Jakob",
		20  =>  "Markus V."
];
$statusList = [
		0   =>  "draft",
		1   =>  "public",
		2   =>  "inactive",
];

foreach($dir as $file) {
	if(pathinfo($file, PATHINFO_EXTENSION) == "json") {
		$string = file_get_contents($file);
		$array = json_decode($string, true);

		// var_dump($array);

		$out = "";

		$out .= "---\n";
		$out .= "layout: post\n";
		$out .= "title: \"".$array["title"]."\"\n";
		$out .= "date: ".date("Y-m-d H:i:s", $array["createDate"])."\n";
		$out .= "author: ".@$authorList[@$array["author"]]."\n";
		$out .= "---\n";
		$out .= $array["content"];

		echo "<br>" . $array["status"] . " - " . $array["title"];

		// die($out);
		// file_put_contents(date("Y-m-d", $array["createDate"])."-".$array["slug"].".md", $out);
	}
}

?>
