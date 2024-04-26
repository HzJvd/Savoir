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
                    <li><a href="admin-login.php">Admin</a></li>
                    <li><a href="basket.php"><img src="img/bag.png" width="30px" height="30px"></a></li>
                </ul>
            </nav>
        </div>
</body>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Order System</title>
    <style>
/* General Styles */
body {
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
  margin: 0;
  padding: 0;
  background-color: #bedff3;
}

/* Navbar */
.navbar {
  display: flex;
  justify-content: space-between;
  align-items: center;
  background-color: #008080; /* Darker blue color */
  color: #fff;
  padding: 10px 20px;
}

.logo img {
  height: auto;
  max-width: 100%;
}

nav ul {
  display: flex;
  list-style-type: none;
  margin: 0;
  padding: 0;
}

nav li {
  margin-left: 20px;
}

nav a {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}

nav a:hover {
  color: #bed7ff;
}

/* Product Grid */
.items {
  display: flex;
  justify-content: center;
  flex-wrap: wrap;
  padding: 20px;
}

h1 {
  text-align: center;
  margin-top: 40px;
  margin-bottom: 20px;
  color: #0d3d94;
}

.product {
  width: 300px;
  background-color: #fff;
  box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  overflow: hidden;
  margin: 20px;
  transition: transform 0.3s;
}

.product:hover {
  transform: translateY(-5px);
}

.product img {
  max-width: 100%;
  height: auto;
}

.product h2 {
  font-size: 18px;
  margin: 10px;
  color: #0d3d94;
}

.product p {
  margin: 10px;
  color: #666;
}

.product form {
  margin: 10px;
}

.product input[type="submit"] {
  background-color: #0d3d94;
  color: #fff;
  border: none;
  padding: 8px 16px;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s;
}

.product input[type="submit"]:hover {
  background-color: #1b5ee8;
}
    </style>
</head>
<body>
    <p><h1>Furniture Products</h1></p>
    <?php
        include 'connect.php';

        $sql = "SELECT * FROM products";
        $query = mysqli_query($conn, $sql);
        $fetch = mysqli_fetch_all($query, MYSQLI_ASSOC);
    ?>


<div class="items">
        <?php foreach ($fetch as $product): ?>
            <a href="http://localhost/savoir/item.php?value=<?php echo $product['product_id']; ?>">
                <div class='product'>
                    <img src="<?php echo $product['image_url']; ?>" alt="<?php echo $product['product_name']; ?>">
                    <h2><?php echo $product['product_name']; ?></h2>
                    <p><?php echo $product['description']; ?></p>
                    <p>Price: <?php echo $product['price']; ?></p>
                    <form action='item.php' method='post'>
                        <input type='hidden' name='product_id' value="<?php echo $product['product_id']; ?>">
                        <input type="hidden" name="customer_id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : NULL; ?>">
                        <input type='submit' value='Add to basket'>
                    </form>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</body>
</html>




