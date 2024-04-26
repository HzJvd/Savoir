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
    <title>Furniture Order Basket</title>
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Furniture Order Basket</title>
</head>
<body>
    <header>
        <h1>Furniture Order Basket</h1>
    </header>

    <main>
    <?php
        include "connect.php";

        // Check if form is submitted for updating basket items
        if(isset($_POST['update'])) {
            foreach($_POST['quantity'] as $key => $value) {
                $product_id = $_POST['product_id'][$key];
                $quantity = $_POST['quantity'][$key];
               
                // Update quantity for the item in the basket
                $update_query = "UPDATE basket SET quantity='$quantity' WHERE product_id='$product_id'";
                mysqli_query($conn, $update_query);
            }
           
            // Redirect to refresh the page
            header("Location: basket.php");
            exit();
        }

        // Check if remove button is clicked
        if(isset($_POST['remove'])) {
            $product_id = $_POST['product_id'];

            // Remove the item from the basket
            $remove_query = "DELETE FROM basket WHERE product_id='$product_id'";
            mysqli_query($conn, $remove_query);

            // Redirect to refresh the page
            header("Location: basket.php");
            exit();
        }

        // Fetch basket items along with product details
        $sql = "SELECT b.product_id, p.product_name, p.description, p.price, b.quantity, p.image_url
        FROM basket b
        INNER JOIN products p ON b.product_id = p.product_id";
        $query = mysqli_query($conn, $sql);

        // Initialize total price
        $totalPrice = 0;
        ?>

        <?php
        // Check if there are items in the basket
        if (mysqli_num_rows($query) > 0) {
            ?>
            <form method="post" action="">
                <?php
                // Loop through each item in the basket
                while ($row = mysqli_fetch_assoc($query)) {
                    // Calculate total price for each item
                    $itemTotal = $row['price'] * $row['quantity'];
                    $totalPrice += $itemTotal; // Update overall total price
                    ?>
                    <div class="basket-item">
                        <div class="item-details">
                            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['product_name']; ?>" width="100">
                            <h3><?php echo $row['product_name']; ?></h3>
                            <p><?php echo $row['description']; ?></p>
                            <input type="hidden" name="product_id[]" value="<?php echo $row['product_id']; ?>">
                            <input type="number" name="quantity[]" value="<?php echo $row['quantity']; ?>" min="1">
                        </div>
                        <div class="item-price">£<?php echo number_format($itemTotal, 2); ?></div>
                        <div>
                            <form method="post" action="">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <button type="submit" name="remove">Remove</button>
                            </form>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <div class="basket-total">
                    <p>Total: £<?php echo number_format($totalPrice, 2); ?></p>
                </div>
                <input type="submit" name="update" value="Update Basket">
            </form>
            <button onclick="window.location.href='checkout.php'">Proceed to Checkout</button>
            <?php
        } else {
            // Display message if basket is empty
            echo "<p>Your basket is empty.</p>";
        }
        ?>
    </main>
</body>
</html>
    </main>
</body>
</html>
