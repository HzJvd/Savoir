<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="http://localhost/savoir/style.css">
  <title>Admin Registration</title>
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
                        <li><a href="basket.php"><img src="img/bag.png" width="30px" height="30px"></a></li>
                    </ul>
                </nav>
            </div>
  </div>

  <?php
  include "connect.php";

  if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "INSERT INTO admins (username, password) VALUES ('$username', '$password')";
    $query = mysqli_query($conn, $sql);

    if ($query) {
      echo "New admin record created successfully";
      header("Location: admin-login.php"); // Redirect to the admin login page
      exit();
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }
  ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }


        header {
            background-color: #333;
            color: #fff;
            padding: 10px;
            text-align: center;
        }


        main {
            margin: 20px;
        }


        .basket-item {
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 10px;
            padding: 10px;
            background-color: #fff;
            display: flex;
            justify-content: space-between;
        }


        .item-details {
            flex: 2;
        }


        .item-details h3 {
            margin: 0;
            color: #333;
        }


        .item-details p {
            margin: 5px 0;
            color: #666;
        }


        .item-price {
            flex: 1;
            text-align: right;
        }


        .basket-total {
            margin-top: 20px;
            text-align: right;
            font-weight: bold;
        }


        button {
            background-color: #333;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }


        button:hover {
            background-color: #555;
        }
    </style>
</head>

  <body>
    <form action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">
      <div class="container">
        <h1>Admin Registration</h1>
        <p>Please fill in this form to create an admin account.</p>
        <hr>

        <label for="username"><b>Username</b></label>
        <input type="text" placeholder="Enter username" name="username" id="username" required>

        <label for="password"><b>Password</b></label>
        <input type="password" placeholder="Enter password" name="password" id="password" required>

        <hr>
        <p>By creating an account you agree to our <a href="#">Terms and Privacy</a>.</p>

        <input type="submit" name="submit" value="Register" class="registerbtn" />
        <input type="button" value="Cancel" onclick="window.location='admin-login.php'" />
      </div>

      <div class="container signin">
        <p>Already have an admin account? <a href="admin-login.php">Login</a>.</p>
      </div>
    </form>
  </body>
</html>