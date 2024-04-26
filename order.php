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
    <title>Contact Us - Furniture Order</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 1em;
            text-align: center;
        }

        main {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 8px;
        }

        input, textarea {
            padding: 10px;
            margin-bottom: 16px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            background-color: #333;
            color: #fff;
            padding: 12px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 1em;
            position: fixed;
            bottom: 0;
            width: 100%;
        }
    </style>
    
    <?php
// Include your database connection file
include 'connect.php';
session_start(); // Start session

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission
    if (isset($_POST["placeorder"])) {
        $customerId = $_SESSION['id'];
        $totalPrice = $_POST['totalPrice'];

        // Escape and sanitize user inputs to prevent SQL injection
        $username = mysqli_real_escape_string($conn, $_POST['username']);
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
        $house_number = mysqli_real_escape_string($conn, $_POST['house_number']);

        // Insert customer details into orders table
        $insertSql = "INSERT INTO orders (customer_id, order_date, total_amount)
                      VALUES (?, NOW(), ?)";
        $stmt = mysqli_prepare($conn, $insertSql);
        mysqli_stmt_bind_param($stmt, "id", $customerId, $totalPrice);
        mysqli_stmt_execute($stmt);
        $orderId = mysqli_insert_id($conn); // Get the inserted order ID

        // Fetch basket items along with product details
        $totalPrice = 0;
        $basketSql = "SELECT p.product_name, p.price, b.quantity, b.product_id
                      FROM basket b
                      INNER JOIN products p ON b.product_id = p.product_id
                      WHERE b.customer_id = $customerId";
        $basketResult = mysqli_query($conn, $basketSql);
        if ($basketResult && mysqli_num_rows($basketResult) > 0) {
            while ($row = mysqli_fetch_assoc($basketResult)) {
                $total = $row['price'] * $row['quantity'];
                $totalPrice += $total;

                // Insert order details into orderdetails table
                $insertOrderDetailSql = "INSERT INTO orderdetails (order_id, product_id, quantity, unit_price, total_price)
                                         VALUES ($orderId, {$row['product_id']}, {$row['quantity']}, {$row['price']}, $total)";
                mysqli_query($conn, $insertOrderDetailSql);
            }
            // Update total amount in orders table
            mysqli_query($conn, "UPDATE orders SET total_amount = $totalPrice WHERE order_id = $orderId");
        }

        // Clear basket after placing order
        mysqli_query($conn, "DELETE FROM basket WHERE customer_id = $customerId");

        // Redirect to homepage with success message
        header("Location: index.php?order_success=true");
        exit();
    }
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Order Summary</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <?php
            // Check if order was successfully placed
            if (isset($_GET['order_success']) && $_GET['order_success'] == 'true') {
                $orderId = $_GET['order_id'];
                echo "<h1>Order Placed Successfully!</h1>";
                echo "<p>Your Order ID is: $orderId</p>";
                echo "<p>Thank you for shopping with us.</p>";
            } else {
                echo "<h1>Order Summary</h1>";
                echo "<div class='order-summary'>";

            // Display basket items
            $sql = "SELECT b.product_id, p.product_name, p.description, p.price, b.quantity, p.image_url
            FROM basket b
            INNER JOIN products p ON b.product_id = p.product_id
            WHERE b.customer_id = {$_SESSION['id']}";
            $query = mysqli_query($conn, $sql);

            if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_assoc($query)) {
                    echo "<div class='basket-item'>";
                    echo "<div class='item-details'>";
                    echo "<h3>{$row['product_name']}</h3>";
                    echo "<p>{$row['description']}</p>";
                    echo "<p>Price: £{$row['price']}</p>";
                    echo "<p>Quantity: {$row['quantity']}</p>";
                    echo "</div>";
                    echo "<div class='item-price'>Total: £" . number_format($row['price'] * $row['quantity'], 2) . "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>Your basket is empty.</p>";
            }
            echo "</div>";
        }
        ?>
    </div>
</body>
</html>

    <?php

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}
?>

</body>
</html>

