<html>
				<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<title> Dashboard </title>
				</head>

				<body>

								  <nav>
    <div class="nav-wrapper">
      <div class="col s12">
      </div>
    </div>
  </nav>

<h2 align="center" >
	View medicine recommendations
</h2>

<form>
  <div class="h-100 row align-items-center">
    <div class="input-field col s6">
      <input placeholder="Search for a medicine" id="query" name="query" type="text" class="validate">
			<button class="waves-effect waves-light btn">Search</button>
</div>
</div>
</form>

				</body>

<?php

$servername = "localhost";
$uname = "root";
$pass = "";
$dbname = "myDB";

// Create connection
$conn = new mysqli($servername, $uname, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
		exit();
}

ob_start();

$sql = "SELECT * FROM doctor_recommendations ORDER BY reg_date";
$result = mysqli_query($conn, $sql);

while($row = $result->fetch_assoc()) {
				$str = "<b>Doctor Name: </b> ".$row["fullname"]."<br>";
				$str = $str."<b>Disease: </b>".$row["disease"]."<br>";
				$str = $str."<b>Recommendation: </b>".$row["recommendation"]."<br>";
				$str = $str."<img src='".$row["img"]."' /> <br>";
				$str = $str."<br><br>";
				echo $str;
}

if (isset($_GET["query"])) {
	ob_end_clean();
	$query = $_GET["query"];
	$sql = "SELECT * FROM doctor_recommendations WHERE disease like '%".$query."%'";
	$result = mysqli_query($conn, $sql);
	while($row = $result->fetch_assoc()) {
				$str = "<b>Doctor Name: </b> ".$row["fullname"]."<br>";
				$str = $str."<b>Disease: </b>".$row["disease"]."<br>";
				$str = $str."<b>Recommendation: </b>".$row["recommendation"]."<br>";
				$str = $str."<img src='".$row["img"]."' /> <br>";
				$str = $str."<br><br>";
				echo $str;
	}
}
?>
</html>
