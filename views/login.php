<html>
				<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
		<title> Login </title>
				</head>

				<body>

								  <nav>
    <div class="nav-wrapper">
      <div class="col s12">
      </div>
    </div>
  </nav>


  <div class="h-100 row align-items-center">
    <div class="input-field col s6">
					<form  method="post">
      <input placeholder="Enter your username" id="username" name="username" type="text" class="validate">
			<br>

			<input placeholder="Enter your password" id="password" name="password" type="password" class="validate" pattern="[a-z][A-Z][0-9]{8}*">
			<br>

			<button class="waves-effect waves-light btn">Submit</button>
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


if (isset($_POST["username"])) {
				$username = $_POST["username"];
				$password = $_POST["password"];

				$sql = "SELECT id FROM users WHERE username='". mysqli_real_escape_string($conn, $username) ."' AND password='".mysqli_real_escape_string($conn, $password)."'";
				echo $sql . "<br>";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) > 0) {
    			header('Location: dashboard.php');
				} else {
					echo "Invalid username or password";
				}

}	

?>
</html>
