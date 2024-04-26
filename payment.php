<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="http://localhost/savoir/style.css">
</head>
    <style>
body {
    font-family: 'Arial', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.navbar {
    background-color: #333;
    color: #fff;
    padding: 10px;
    text-align: center;
}

.navbar img {
    vertical-align: middle;
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
}

nav ul li {
    display: inline;
    margin-right: 10px;
}

nav ul li a {
    color: #fff;
    text-decoration: none;
}

header {
    text-align: center;
    padding: 20px;
    background-color: #333;
    color: #fff;
}

main {
    margin: 20px auto;
    max-width: 600px;
}

.payment-form {
    background-color: #fff;
    padding: 20px;
    border-radius: 15px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    margin: 0 auto;
}

.payment-form h2 {
    margin-top: 0;
    color: #333;
}

.payment-form label {
    display: block;
    margin-bottom: 8px;
    font-weight: bold;
}

.payment-form input[type="radio"] {
    margin-right: 8px;
}

.payment-form button {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 10px 20px;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
    margin-top: 16px;
}

.payment-form button:hover {
    background-color: #555;
}

.payment-status {
    margin-top: 20px;
    font-weight: bold;
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
            <li><a href="basket.php"><img src="img/bag.png" width="30px" height="30px"></a></li>
            </ul>
        </nav>
    </div>
</body>

<body>
    <h1>Payment</h1>
    <?php if (isset($paymentStatus)) { echo "<p>$paymentStatus</p>"; } ?>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <input type="hidden" name="totalPrice" value="<?php echo isset($_POST['totalPrice']) ? $_POST['totalPrice'] : ''; ?>">
        <label>Choose Payment Method:</label>
        <input type="radio" name="payment_method" value="credit_card" checked> Credit Card
        <input type="radio" name="payment_method" value="debit_card"> Debit Card
        <input type="radio" name="payment_method" value="paypal"> PayPal
        <br><br>
    </form>
</body>
</html>


<?php
include 'connect.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

// Check if the payment method is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $paymentMethod = $_POST['payment_method'];
    $totalPrice = $_POST['totalPrice'];

    // Handle payment based on the selected method
    switch ($paymentMethod) {
        case 'credit_card':
            // Add your credit card payment processing logic here
            $paymentStatus = "Credit card payment processed successfully.";
            break;
        case 'debit_card':
            // Add your debit card payment processing logic here
            $paymentStatus = "Debit card payment processed successfully.";
            break;
        case 'paypal':
            // Add your PayPal payment processing logic here
            $paymentStatus = "PayPal payment processed successfully.";
            break;
        default:
            $paymentStatus = "Invalid payment method selected.";
    }

    // Proceed with order placement if payment is successful
    if (isset($paymentStatus) && strpos($paymentStatus, 'successfully') !== false) {
        $customerId = $_SESSION['id'];

        // Insert order details into orders table
        $insertSql = "INSERT INTO orders (customer_id, order_date, total_amount) VALUES (?, NOW(), ?)";
        $stmt = mysqli_prepare($conn, $insertSql);
        mysqli_stmt_bind_param($stmt, "id", $customerId, $totalPrice);
        mysqli_stmt_execute($stmt);
        $orderId = mysqli_insert_id($conn); // Get the inserted order ID

        // Fetch basket items along with product details
        $basketSql = "SELECT p.product_name, p.price, b.quantity, b.product_id
                      FROM basket b
                      INNER JOIN products p ON b.product_id = p.product_id
                      WHERE b.customer_id = $customerId";
        $basketResult = mysqli_query($conn, $basketSql);
        if ($basketResult && mysqli_num_rows($basketResult) > 0) {
            while ($row = mysqli_fetch_assoc($basketResult)) {
                $total = $row['price'] * $row['quantity'];

                // Insert order details into orderdetails table
                $insertOrderDetailSql = "INSERT INTO orderdetails (order_id, product_id, quantity, unit_price, total_price)
                                         VALUES ($orderId, {$row['product_id']}, {$row['quantity']}, {$row['price']}, $total)";
                mysqli_query($conn, $insertOrderDetailSql);
            }
        }

        // Clear basket after placing order
        mysqli_query($conn, "DELETE FROM basket WHERE customer_id = $customerId");

        // Fetch customer details
        $customerSql = "SELECT first_name, surname, email, phone_number, house_number, street, county, postcode
                        FROM customers
                        WHERE customer_id = $customerId";
        $customerResult = mysqli_query($conn, $customerSql);
        $customerData = mysqli_fetch_assoc($customerResult);

        // Display the receipt
        echo '<div style="background-color: #f4f4f4; padding: 20px; border: 1px solid #ddd; font-family: Arial, sans-serif;">';
        echo '<h2 style="margin-top: 0;">Payment Receipt</h2>';
        echo '<p><strong>Order ID:</strong> ' . $orderId . '</p>';
        echo '<p><strong>Customer Name:</strong> ' . $customerData['first_name'] . ' ' . $customerData['surname'] . '</p>';
        echo '<p><strong>Email:</strong> ' . $customerData['email'] . '</p>';
        echo '<p><strong>Phone Number:</strong> ' . $customerData['phone_number'] . '</p>';
        echo '<p><strong>Address:</strong> ' . $customerData['house_number'] . ', ' . $customerData['street'] . ', ' . $customerData['county'] . ', ' . $customerData['postcode'] . '</p>';
        echo '<p><strong>Payment Method:</strong> ' . ucfirst($paymentMethod) . '</p>';
        echo '<p><strong>Total Amount:</strong> £' . number_format($totalPrice, 2) . '</p>';
        echo '</div>';

        // Save the receipt as a text file
        $receiptContent = "Payment Receipt\n\n";
        $receiptContent .= "Order ID: " . $orderId . "\n";
        $receiptContent .= "Customer Name: " . $customerData['first_name'] . ' ' . $customerData['surname'] . "\n";
        $receiptContent .= "Email: " . $customerData['email'] . "\n";
        $receiptContent .= "Phone Number: " . $customerData['phone_number'] . "\n";
        $receiptContent .= "Address: " . $customerData['house_number'] . ', ' . $customerData['street'] . ', ' . $customerData['county'] . ', ' . $customerData['postcode'] . "\n";
        $receiptContent .= "Payment Method: " . ucfirst($paymentMethod) . "\n";
        $receiptContent .= "Total Amount: £" . number_format($totalPrice, 2) . "\n";

        $receiptFile = 'receipt_' . $orderId . '.txt';
        file_put_contents($receiptFile, $receiptContent);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Back to Home Page</title>
</head>
<body>

<button onclick="window.location.href = 'index.php';">Head back to home page</button>

</body>
</html>
