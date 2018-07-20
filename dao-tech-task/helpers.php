<?php 

// print formatted data
function dd($data) 
{
	echo "<pre>"; print_r($data); echo "</pre>";
}

 
function jsonToArray($jsonData) 
{   
   $obj_array = json_decode(file_get_contents($jsonData), true);
   $res = [];
   foreach ($obj_array as $values) {
      foreach ($values as $key => $value) {   
         $res[$key] =  explode(",", $value);
      }
   }

   $res = reduce($res);
   return $res;
}

function parseJson() 
{
   $json = json_decode(file_get_contents('graph.json'), true);
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

function reduce($array)
{
  foreach($array as $k => $v) {
  $v = implode(",", $v);
  preg_match_all("/\'(.)\'/", $v, $key);
  preg_match_all("/=> (\d)/", $v, $val);
  $graph[$k] = array_combine($key[1], $val[1]);
  }
  return $graph;
}

function flatten_array(array $items, array $flattened = []) 
{
   foreach ($items as $item) {
      if (is_array($item)) {
         $flattened = flatten_array($item, $flattened);
      }

      $flattened[] = $item;
   }
   return $flattened;
} 

?>