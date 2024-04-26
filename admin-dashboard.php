<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "hamzah"; // Update this with your actual database username
$password = "hamzah"; // Update this with your actual database password
$dbname = "savoir";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the admin is logged in
if (!isset($_SESSION["admin_id"])) {
    // Redirect to the admin login page
    header("Location: admin-login.php");
    exit();
}

// Fetch all admins
$sql_admins = "SELECT * FROM admins";
$result_admins = $conn->query($sql_admins);

// Fetch all customers
$sql_customers = "SELECT * FROM customers";
$result_customers = $conn->query($sql_customers);

// Fetch all orders
$sql = "SELECT o.order_id, o.order_date, o.total_amount, c.first_name, c.surname, c.email
        FROM orders o
        INNER JOIN customers c ON o.customer_id = c.customer_id
        ORDER BY o.order_id DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

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
</body>

    <title>Admin Dashboard</title>
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

                .navbar {
            background-color: #333;
            overflow: hidden;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px;
        }

        .navbar .logo {
            margin-left: 10px;
        }

        .navbar nav {
            margin-right: 10px;
        }

        .navbar ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .navbar li {
            float: left;
        }

        .navbar li a {
            display: block;
            color: white;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }

        .navbar li a:hover {
            background-color: #ddd;
            color: #333;
        }

        main {
            margin: 20px;
        }

        .section-row {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            margin-bottom: 20px;
        }

        .section-box {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 20px;
            padding: 20px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            flex: 1;
            margin-right: 20px;
            min-width: 300px;
        }

        .section-box:last-child {
            margin-right: 0;
        }

    /* styles for admin-box, customer-box, and order-box */

        /* Order Section */
        .order-box {
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-bottom: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .order-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-details h3 {
            margin: 0;
            color: #333;
        }

        .order-details p {
            margin: 5px 0;
            color: #666;
        }

        .order-price {
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

        /* Admin Section */
        .admin-box {
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-bottom: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .admin-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-details h3 {
            margin: 0;
            color: #333;
        }

        .admin-details p {
            margin: 5px 0;
            color: #666;
        }

        /* Customer Section */
        .customer-box {
            border: 1px solid #ddd;
            border-radius: 20px;
            margin-bottom: 10px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .customer-details {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .customer-details h3 {
            margin: 0;
            color: #333;
        }

        .customer-details p {
            margin: 5px 0;
            color: #666;
        }
            </style>
        </head>

<body>
    <header>
        <a href="admin-product.php"><button>Add Product</button></a>
    </header>

    <main>
    <div class="section-row">
        <section class="section-box">
            <h2>Admins</h2>
            <?php
            if ($result_admins->num_rows > 0) {
                while ($row_admin = $result_admins->fetch_assoc()) {
                    echo "<div class='admin-box'>";
                    echo "<div class='admin-details'>";
                    echo "<div>";
                    echo "<h3>Admin #" . $row_admin["admin_id"] . "</h3>";
                    echo "<p>Username: " . $row_admin["username"] . "</p>";
                    if ($row_admin["admin_id"] == 1) {
                        echo "<p>(Owner)</p>";
                    }
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No admins found.</p>";
            }
            ?>
        </section>

        <section class="section-box">
            <h2>Customers</h2>
            <?php
            if ($result_customers->num_rows > 0) {
                while ($row = $result_customers->fetch_assoc()) {
                    echo "<div class='customer-box'>";
                    echo "<div class='customer-details'>";
                    echo "<div>";
                    echo "<h3>Customer #" . $row["customer_id"] . "</h3>";
                    echo "<p>Name: " . $row["first_name"] . " " . $row["surname"] . "</p>";
                    echo "<p>Email: " . $row["email"] . "</p>";
                    echo "<p>Username: " . $row["username"] . "</p>";
                    echo "<p>Phone: " . $row["phone_number"] . "</p>";
                    echo "<p>Address: " . $row["house_number"] . ", " . $row["street"] . ", " . $row["county"] . ", " . $row["postcode"] . "</p>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No customers found.</p>";
            }
            ?>
        </section>
    </div>

    <div class="section-row">
        <section class="section-box">
            <h2>All Orders</h2>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='order-box'>";
                    echo "<div class='order-details'>";
                    echo "<div>";
                    echo "<h3>Order #" . $row["order_id"] . "</h3>";
                    echo "<p>Order Date: " . $row["order_date"] . "</p>";
                    echo "<p>Customer: " . $row["first_name"] . " " . $row["surname"] . "</p>";
                    echo "<p>Email: " . $row["email"] . "</p>";
                    echo "</div>";
                    echo "<p class='order-price'>£" . $row["total_amount"] . "</p>";
                    echo "</div>";
                    echo "</div>";
                }
            } else {
                echo "<p>No orders found.</p>";
            }
            ?>
        </section>
    </div>
</main>

</body>
</html>