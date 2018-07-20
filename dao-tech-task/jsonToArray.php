<?php 
include 'helpers.php';

// Parse graph.json file
$json = json_decode(file_get_contents('graph.json'), true);

function parseJson($json) 
{
	foreach ($json as $key => $value) {
	    foreach ($value as $k => $val) {
	        $str = str_replace(['[', ']'], '', $val);
	        $str = str_replace(' => ', ',', $str);
	        $str = str_replace("'", "", $str);
	        $str = explode(',', $str);

	        for ($x = 0; $x < count($str); $x = $x + 2) {
	            $graph[$k][trim($str[$x])] = $str[$x+1];
	        }
	    }
	}
	return $graph;
}

dd(parseJson($json));


?>