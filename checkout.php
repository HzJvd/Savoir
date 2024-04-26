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



<?php
// Include your database connection file
include 'connect.php';

// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php");
    exit(); // Stop further execution
}

// Fetch basket items along with product details
$sql = "SELECT b.product_id, p.product_name, p.description, p.price, b.quantity, p.image_url
        FROM basket b
        INNER JOIN products p ON b.product_id = p.product_id
        WHERE b.customer_id = {$_SESSION['id']}";
$query = mysqli_query($conn, $sql);

// Initialize total price
$totalPrice = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="http://localhost/savoir/style.css">
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

    
    <div class="container">
        <h1>Checkout</h1>
        <div class="basket-items">
            <?php if (mysqli_num_rows($query) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($query)): ?>
                    <div class="basket-item">
                        <div class="item-details">
                            <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['product_name']; ?>" width="100">
                            <h3><?php echo $row['product_name']; ?></h3>
                            <p><?php echo $row['description']; ?></p>
                            <p>Price: £<?php echo $row['price']; ?></p>
                            <p>Quantity: <?php echo $row['quantity']; ?></p>
                        </div>
                        </div>
                    <?php $totalPrice += $row['price'] * $row['quantity']; ?>
                <?php endwhile; 
                // Initialize total price and subtotal
                $subtotalPrice = 0;
                $vatRate = 0.2; // 20% VAT
                
                // Fetch basket items along with product details
                $sql = "SELECT b.product_id, p.product_name, p.description, p.price, b.quantity
                        FROM basket b
                        INNER JOIN products p ON b.product_id = p.product_id
                        WHERE b.customer_id = {$_SESSION['id']}";
                $query = mysqli_query($conn, $sql);
                
                while ($row = mysqli_fetch_assoc($query)) {
                    $lineTotal = $row['price'] * $row['quantity'];
                    $subtotalPrice += $lineTotal;
                }
                
                $totalPrice = $subtotalPrice * (1 + $vatRate);
                ?>
            
            <div class="basket-total">
                    <p>Subtotal: £<?php echo number_format($subtotalPrice, 2); ?></p>
                    <p>VAT (20%): £<?php echo number_format($totalPrice - $subtotalPrice, 2); ?></p>
                    <p>Total (with VAT): £<?php echo number_format($totalPrice, 2); ?></p>
                </div>
                <form action="payment.php" method="post" onsubmit="return confirmPayment()">
                    <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
                    <label for="payment_method">Choose Payment Method:</label>
                    <select id="payment_method" name="payment_method">
                        <option value="credit_card">Credit Card</option>
                        <option value="debit_card">Debit Card</option>
                        <option value="paypal">PayPal</option>
                    </select>
                    <button type="submit">Proceed to Payment</button>
                </form>
            <?php else: ?>
                <p>Your basket is empty.</p>
            <?php endif; ?>
        </div>
    </div>

    <script>
        function confirmPayment() {
            return confirm("Are you sure you want to proceed with the payment?");
        }
    </script>
</body>
</html>