<html>
				<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<title> Signup </title>
				</head>

				<body>

								  <nav>
    <nav>
    <div class="nav-wrapper">
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="views/admin.php">Add a doctor recommendation</a></li>
        <li><a href="views/dashboard.php">View Dashboard</a></li>
      </ul>
    </div>
  </nav>

<h2 align="center">
	Medicine Recommendation System
</h2>

<h3 align="center">
	Signup or Login
</h3>

  <div class="h-100 row align-items-center">
    <div class="input-field col s6">
					<form  method="post">
      <input placeholder="Enter your username" id="username" name="username" type="text" class="validate">
			<br>

			<input placeholder="Enter your password" id="password" name="password" type="password" class="validate" pattern="[a-z][A-Z][0-9]{8}*">
			<br>

      <input placeholder="Confirm password" id="confirm-password" name="confirm" type="password" class="validate" pattern="[a-z][A-Z][0-9]{8}*">
			<br>

			<button class="waves-effect waves-light btn">Submit</button>
			<a class="waves-effect waves-light btn" href="views/login.php">Or login</a>
			<form>
    </div>
  </div>

				</body>

<?php

$servername = "localhost";
$uname = "root";
$pass = "";

// Create connection
$conn = new mysqli($servername, $uname, $pass);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
		exit();
}
echo "Connected successfully";

$sql = "CREATE DATABASE myDB";
$conn->query($sql);
$sql = "USE myDB";
$conn->query($sql); 

$sql = "CREATE TABLE users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
password VARCHAR(30) NOT NULL,
username VARCHAR(50),
reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
)";

$conn->query($sql); 



if (isset($_POST["username"])) {
				$username = $_POST["username"];
				$password = $_POST["password"];
				$confirm = $_POST["confirm"];

				if ($password != $confirm) {
								echo "Please try again";
								exit();
				}

				$sql = "SELECT id FROM users WHERE username=$username";
				$result = $conn->query($sql);

				if ($result->num_rows > 0) {
    			echo "User already exists";
				} else {
					$sql = "INSERT INTO users(username, password) VALUES(?, ?)";
					$stmt = $conn->prepare($sql);
					$stmt->bind_param("ss", $username, $password);
					$stmt->execute();
				}

}	

?>
</html>
