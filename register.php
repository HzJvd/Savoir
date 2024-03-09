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

<?php

include "connect.php";

if(isset($_POST['submit'])){
    $first_name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $house_number = $_POST['house_number'];
    $street = $_POST['street'];
    $county = $_POST['county'];
    $postcode = $_POST['postcode'];

    $sql = "INSERT INTO CUSTOMERS VALUES (NULL,'$first_name', '$surname', '$email', '$username', '$password', '$phone_number', '$house_number', '$street','$county', '$postcode')";

    echo $sql;

    $query = mysqli_query($conn, $sql);

    if ($query) {
        echo "New record created successfully";
    } else {
        echo("2");
    }
}
?>



<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<!--styles-->
</head>
<body>


      <style>
body {
  font-family: Arial, Helvetica, sans-serif;
  background-color: black;
}


* {
  box-sizing: border-box;
}




.container {
  padding: 16px;
  background-color: white;
}




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




hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}




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




a {
  color: dodgerblue;
}




.signin {
  background-color: #f1f1f1;
  text-align: center;
}
</style>
      
<form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
  <div class="container">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>


        
      <label for="first_name"><b>First Name</b></label>
    <input type="text" placeholder="Enter first name" name="first_name" id="first_name" required>
        
      <label for="surname"><b>Surname</b></label>
    <input type="text" placeholder="Enter surname" name="surname" id="surname" required>
        
      <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter e-mail" name="email" id= "email" required>
      
      <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter username" name="username" id="username" required>
      
    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter password" name="password" id="password" required>

    <label for="password-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Re-enter rassword" name="psw-repeat" id="psw-repeat" required>
        
      <label for="phone_number"><b>Phone Number</b></label>
    <input type="text" placeholder="Phone number e.g. '07444444444'" name="phone_number" id="phone_number" required>
        
      <label for="house_number"><b>House Number</b></label>
    <input type="text" placeholder="Enter House number e.g. '4'" name="house_number" id="house_number" required>
        
      <label for="street"><b>Street</b></label>
    <input type="text" placeholder="Enter street e.g. 'Wise Ln'" name="street" id="street" required>
        
      <label for="county"><b>County</b></label>
    <input type="text" placeholder="Enter County e.g. 'Redbridge' " name="county" id="county" required>
        
      <label for="postcode"><b>Postcode</b></label>
    <input type="text" placeholder="Enter Postcode e.g. 'E15 4RZ" name="postcode" id="postcode" required>
        

    <hr>
    <p>By creating an account you agree to our <a href="#">Terms and Privacy</a>.</p>


   <input type="submit" name="submit" value="Register" class="registerbtn"/>
   <input type="button" value="Cancel" onclick="window.location='bluefit_mainpage.html'"/>  


  </div>
 
  <div class="container signin">
    <p>Already have an account? <a href="login.php">Login</a>.</p>
  </div>
</form>


</body>
</html>
