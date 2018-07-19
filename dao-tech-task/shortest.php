<?php 
 include 'helpers.php';

$start_point = $_POST['start_point'] ?? '';	
$end_point   = $_POST['end_point'] ?? '';

$graph = jsonToArray("graph.json");
$graph = array_map(function($val) {
      eval('$ret = '.rtrim($val,',').';');
      return($ret);
   }, $graph);

function Dijkstra(array $graph, string $source, string $target)
{
	$dist = []; // store the distance - vertex(node)
	$pred = []; // store predecessors - what comes before
	$Queue = new SplPriorityQueue();

	foreach ($graph as $v => $adj) {
		$dist[$v] = PHP_INT_MAX;
		$pred[$v] = null;
		$Queue->insert($v, min(explode(",",$adj)));// get the node and its value -> A-3, B-3, C-2..
	}
	// dd($Queue);
	$dist[$source]  = 0; // set the source node distance as 0

	while (!$Queue->isEmpty()) {
		$u = $Queue->extract(); // return A, B, C...
		if (!empty($graph[$u])) {
			foreach ($graph[$u] as $v => $cost) {
				if ($dist[$u] + $cost < $dist[$v]) { // if max-int + cost < max-int
					$dist[$v] = $dist[$u] + $cost;
					$pred[$v] = $u;
				}
			}
		}
	}

	$S = new SplStack(); // store the path 
	$u = $target; // start from the target vertice
	$distance = 0;

	while (isset($pred[$u]) && $pred[$u]) {
		$S->push($u);
		$distance += $graph[$u][$pred[$u]];
		$u = $pred[$u];
	}

	if ($S->isEmpty()) {
		return ["distance" => 0, "$path" => $S];
	} else {
		$S->push($source);
		return ["distance" => $distance, "path" => $S];
	}
}

// $source = $start_point;
// $target = $end_point;
// $result = Dijkstra($graph, $source, $target);
// extract($result);
// echo "Distance from $source to $target is $distance \n";
// echo "Path to follow : ";
// while (!$path->isEmpty()) {
// echo $path->pop() . "\t";
// }


?>