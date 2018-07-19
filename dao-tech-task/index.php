<?php 
$route_points = ['A', 'B', 'C', 'D', 'E', 'F'];	

?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Dijkstra's Algorithm</title>
	<style type="text/css">
		form { width: 500px; height: 200px;}
		legend {text-align: center;}
		.center {margin-left: 70px;}
	</style>
</head>
<body>
		<h1>Find the shortest path</h1>
		<form action="shortest.php" method="POST">
			<!-- <fieldset> -->
				<legend>Find The Shortest Path - Traveling Salesman Problem</legend>
				<br><br>
				<select name="start_point" id="" class="center">
					<?php foreach ($route_points as $r_point) : ?>
					<option value="<?php echo $r_point; ?>"><?php echo $r_point; ?></option>
					<?php endforeach; ?>	
				</select>
				<select class="center" name="end_point">
					<?php foreach ($route_points as $r_point) : ?>
					<option value="<?php echo $r_point; ?>"><?php echo $r_point; ?></option>
					<?php endforeach; ?>
				</select>
				<br><br>

			<!-- </fieldset> -->
			<input class="center" type="submit" value="Find">
		</form>
</body>
</html>