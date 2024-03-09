<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/savoir/style.css">
  <title>Document</title>
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
                    <li><a href="basket.php"><img src="img/bag.png" width="30px" height="30px"></a></li>
                </ul>
            </nav>
        </div>
</body>

</html>
<?php
session_start();
require_once 'config.php';

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Debugging: Echo the submitted values
    echo "Submitted Username: " . $username . "<br>";
    echo "Submitted Password: " . $password . "<br>";

    // Use prepared statements to prevent SQL injection
    $sql = "SELECT * FROM customers WHERE username = '$username' AND password = '$password'";

    $query = mysqli_query($conn,$sql);

    $rows = mysqli_num_rows($query);

    if($rows > 0){
      $fetch = mysqli_fetch_assoc($query);
      
      $_SESSION['id'] = $fetch['customer_id'];

      header("location: index.html");
    } 
    else{
      $error = "Invalid username or password";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}

* {
  box-sizing: border-box;
}

/* Add padding to containers */
.container {
  padding: 16px;
  background-color: white;
}

/* Full-width input fields */
input[type=text], input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}

input[type=text]:focus, input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}

/* Overwrite default styles of hr */
hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}

/* Set a style for the submit button */
.registerbtn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}

.registerbtn:hover {
  opacity: 1;
}

/* Add a blue text color to links */
a {
  color: dodgerblue;
}

/* Set a grey background color and center the text of the "sign in" section */
.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
</head>
<body>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
  <div class="container">
    <h1>Sign In</h1>
    <p>Please enter your details to sign in to your account.</p>
    <hr>
        
      <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>
    <small style="color:red"><?php echo $error ?? NULL ?> </small> <br>
        
    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" id="password" required>
    <small style="color:red"><?php echo $error ?? NULL ?> </small>

    <hr>
    <p>By signing in, you agree to our <a href="#">Terms and Privacy</a>.</p>

    <button type="submit" class="registerbtn">Sign In</button>
      <input type="button" value="Cancel" onclick="window.location='bluefit_mainpage.html'"/>
  </div>
  <div class="container signin">
    <p>Don't have an account? <a href="register.php">Register</a>.</p>
        
      
  </div>
</form>

