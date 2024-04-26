<?php
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection details
    $servername = "localhost";
    $username = "hamzah";
    $password = "hamzah";
    $dbname = "savoir";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get the submitted username and password
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM customers WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // User exists, store user information in session variables
        $row = $result->fetch_assoc();
        $_SESSION["customer_id"] = $row["customer_id"];
        $_SESSION["username"] = $row["username"];
        $_SESSION["first_name"] = $row["first_name"];
        $_SESSION["surname"] = $row["surname"];

        // Set a session variable for the success message
        $_SESSION["login_success"] = true;

        // Redirect to index.php
        header("Location: index.php");
        exit();
    } else {
        // Username or password is incorrect
        $error = "Invalid username or password";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/savoir/style.css">
  <title>Login</title>
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background-color: #2c3e50;
      margin: 0;
      padding: 0;
    }

    .navbar {
      background-color: #2c3e50;
      overflow: hidden;
      padding: 20px;
    }

    .navbar img {
      width: 125px;
    }

    nav ul {
      list-style-type: none;
      margin: 0;
      padding: 0;
      overflow: hidden;
    }

    nav ul li {
      float: left;
      margin-right: 20px;
    }

    nav ul li a {
      display: block;
      color: white;
      text-align: center;
      padding: 14px 16px;
      text-decoration: none;
    }

    nav ul li a img {
      width: 30px;
      height: auto;
    }

    nav ul li a:hover {
      background-color: #1a242f;
    }

    .container {
      background-color: white;
      padding: 20px;
      border-radius: 10px;
      margin-top: 50px;
      width: 400px;
      margin-left: auto;
      margin-right: auto;
    }

    input[type=text], input[type=password] {
      width: calc(100% - 30px);
      padding: 15px;
      margin: 5px 0 22px 0;
      display: inline-block;
      border: none;
      background: #f1f1f1;
      border-radius: 5px;
    }

    input[type=text]:focus, input[type=password]:focus {
      background-color: #ddd;
      outline: none;
    }

    hr {
      border: 1px solid #f1f1f1;
      margin-bottom: 25px;
    }

    .registerbtn {
      background-color: #3498db;
      color: white;
      padding: 16px 20px;
      margin: 8px 0;
      border: none;
      cursor: pointer;
      width: calc(100% - 30px);
      border-radius: 5px;
      opacity: 0.9;
      font-weight: bold;
      font-family: Arial, sans-serif;
    }

    .registerbtn:hover {
      opacity: 1;
    }

    a {
      color: dodgerblue;
    }

    .signin {
      text-align: center;
    }
  </style>
</head>
<body>

<div class="navbar">
  <div class="logo">
    <img src="img/Screenshot_20240110_104753_WhatsApp.jpg" width="125px">
  </div>
  <nav>
    <ul>
      <li><a href="index.php">Home</a></li>
      <li><a href="product.php">Products</a></li>
      <li><a href="about.php">About</a></li>
      <li><a href="contact.php">Contact</a></li>
      <li><a href="login.php">Account</a></li>
      <li><a href="admin-login.php">Admin</a></li>
    </ul>
  </nav>
</div>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="container">
    <h1 style="text-align: center;">Sign In</h1>
    <p>Please enter your details to sign in to your account.</p>
    <hr>
    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>
    <small style="color:red"><?php echo $error ?? NULL ?></small> <br>
    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>
    <small style="color:red"><?php echo $error ?? NULL ?></small>
    <hr>
    <p>By signing in, you agree to our <a href="#">Terms and Privacy</a>.</p>
    <button type="submit" class="registerbtn">Sign In</button>
    <input type="button" value="Cancel" onclick="window.location='bluefit_mainpage.html'"/>
  </div>
  <div class="container signin">
    <p>Don't have an account? <a href="register.php">Register</a>.</p>
  </div>
</form>

</body>
</html>