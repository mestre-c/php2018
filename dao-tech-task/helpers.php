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
         $res[$key] = explode(",", $value . ",");

      }
   }

   // dd($res);
   // $res = array_map(function($val) {
   //    eval('$ret = '.rtrim($val,',').';');
   //    return($ret);
   // }, $res);

   return $res;
}

// function reduce($array)
// {
//    foreach ($array as $value) {
//       $res[] = $value;
//    }

//    return $res;
// }

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