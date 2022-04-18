<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta name="keywords"    content="HTML, CSS, JavaScript" />
	<meta name="author"    content="Que Hong Vo" />
	<link href ="style.css" rel= "stylesheet"/>
	
</head>

</title>
</head>
<body class="bground">
<header>
	<?php include 'menu.inc'; ?>
</header>

<div class="outer">	
<?php 
require_once ("settings.php");

$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
	echo "<p>Database connection failure</p>";
} else {
		$name = trim($_POST["Firstname"]);
		$num = trim($_POST["Phonenumber"]);
		$status = trim($_POST["OrderStatus"]);
		
		$query = "UPDATE orders SET OrderStatus = '$status' WHERE Firstname = '$name' and Phonenumber ='$num'";
		$result = mysqli_query($conn, $query);
	if (!$result) {   
		echo "<p> Something is wrong with ", $query, "</p>";
	} else {
		$query = "SELECT * FROM orders WHERE Firstname = '$name' and Phonenumber ='$num'";
		$result = mysqli_query($conn, $query);
		echo "<table border='1' id='enchancetable'>";
		echo "<tr>";
		echo "<th scope='col'>Order ID</th>";
		echo "<th scope='col'>Order Date</th>";
		echo "<th scope='col'>First Name</th>";
        echo "<th scope='col'>Last Name</th>";
		echo "<th scope='col'>Order Cost</th>";
        echo "<th scope='col'>Order Status </th>";
		echo "</tr>";

		while ($row = mysqli_fetch_assoc($result)) {
			echo 
			"<tr>"
			."<td>", $row["OrderID"], "</td>"
			."<td>", $row["OrderTime"], "</td>"
			."<td>", $row["Firstname"], "</td>"
            ."<td>", $row["Lastname"], "</td>"
			."<td>", $row["OrderCost"], "</td>"
			."<td>", $row["OrderStatus"], "</td>";
		}
		echo "</table>";

    }

		mysqli_free_result($result);
		
		mysqli_close ($conn);
	}


?>
</div>


<footer>
	<?php include 'footer.inc'; ?>
</body>
</html>