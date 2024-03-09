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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Order System</title>
    <style>
        .items {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 50vh;
            margin: 0;
        }

        h1 {
            text-align: center;
            display: block;
        }

        .product {
            width: 300px; /* Adjust the width as needed */
            border: 1px solid #ccc;
            padding: 10px;
            margin: 10px;
            text-align: center;
        }
    </style>
</head>
<body>

    <p><h1>Furniture Products</h1></p>
    <!-- <br> -->
    <?php
        // Include your database connection file
        include 'connect.php';

        $sql = "SELECT * FROM products";
        $query = mysqli_query ($conn,$sql);
        $fetch = mysqli_fetch_all($query,MYSQLI_ASSOC);

        // Display products


        // Close database connection
    ?>

    <div class="items">
        <?php foreach ($fetch as $product):?>
            <a href ="http://localhost/savoir/item.php?value=<?php echo $product['product_id'] ?>">
            <div class='product'>
                <h2><?php echo $product['product_name'] ?></h2>
                <p><?php echo $product['description'] ?></p>
                <p>Price: <?php echo $product['price'] ?></p>
                <form action='item.php' method='post'>
                    <input type='hidden' name='product_id' value=" <? $product['product_id'] ?>">
                    <input type="hidden" name="customer_id" value="<? $customer_id ?>">
                    <input type='submit' value='Add to basket'>
                </form>
            </div>
            </a>
        <?php endforeach ?>
    </div>
</body>
</html>
