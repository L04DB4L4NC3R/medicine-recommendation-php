<html>
				<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<title> Doctor medicine listing </title>
				</head>

				<body>

    <nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="admin.php">Add a doctor recommendation</a></li>
        <li><a href="dashboard.php">View Dashboard</a></li>
        <li><a href="../index.php">User side</a></li>
      </ul>
    </div>
  </nav>

<h2 align="center">
	Enter your medicine recommendation for helping patients
</h2>

  <div class="h-100 row align-items-center">
    <div class="input-field col s6">
					<form  method="post">
      <input placeholder="Enter your full name" id="fullname" name="fullname" type="text" class="validate">
			<br>

      <input placeholder="Disease type" id="disease-type" name="disease" type="text" class="validate">
      <input placeholder="Medicine recommendation" id="recommendation" name="recommendation" type="text" class="validate">

      <input placeholder="Drop image url" id="img" name="img" type="text" class="validate">
			<br>

			<button class="waves-effect waves-light btn">Submit</button>
			<a class="waves-effect waves-light btn" href="views/dashboard.php">View Dashboard</a>
			<form>
    </div>
  </div>

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
echo "Connected successfully";

$sql = "CREATE TABLE doctor_recommendations (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
disease VARCHAR(100) NOT NULL,
fullname VARCHAR(100) NOT NULL,
recommendation VARCHAR(100),
img VARCHAR(8000),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$conn->query($sql);

if (isset($_POST["fullname"])) {
				$name = $_POST["fullname"];
				$disease = $_POST["disease"];
				$recommendation = $_POST["recommendation"];
				$img = $_POST["img"];

				if ($disease == "" || $recommendation == "") {
								echo "Please try again";
								exit();
				}

				$sql = "INSERT INTO doctor_recommendations(fullname, disease, recommendation, img) 
								VALUES(?, ?, ?, ?)";
				$stmt = $conn->prepare($sql);
				$stmt->bind_param("ssss", $name, $disease, $recommendation, $img);
				$stmt->execute();
				if ($stmt->error == null) {
					header('Location: dashboard.php');
				} else {
								echo $stmt->error;
				}
}	

?>
</html>
