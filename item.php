<?php
include "connect.php";
session_start();

if (isset($_GET['value'])) {
    $name = $price = $stock = $description = $image_url = '';
    $c_id = $_SESSION['id'];
    $p_id = $_GET['value'];
    $sql = "SELECT * FROM products WHERE product_id = '$p_id'";
    $query = mysqli_query($conn, $sql);
    if (mysqli_num_rows($query) > 0) {
        $fetch = mysqli_fetch_assoc($query);

        $name = $fetch['product_name'];
        $price = $fetch['price'];
        $stock = $fetch['stock'];
        $description = $fetch['description'];
        $image_url = $fetch['image_url'];
    } else {
        header("location: product.php");
    }
} else {
    header("location: product.php");
}

if (isset($_POST["submit"])) {
    $customer_id = $_POST['customer_id'];
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];
    $query1 = "SELECT * FROM basket WHERE customer_id = '$customer_id' AND product_id = '$product_id'";
    $result = mysqli_query($conn, $query1);
    if ($result) {
        $rows = mysqli_num_rows($result);
        if ($rows > 0) {
            // Item already exists in the basket, update quantity
            $sql2 = "UPDATE basket SET quantity = quantity + $quantity WHERE customer_id = '$customer_id' AND product_id = '$product_id'";
            $query1 = mysqli_query($conn, $sql2);
        } else {
            // Item doesn't exist in the basket, insert new record
            $sql2 = "INSERT INTO basket VALUES(NULL,'$product_id', '$customer_id', '$quantity', '$price')";
            $query1 = mysqli_query($conn, $sql2);
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Savoir London | Furniture</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.4.2/css/fontawesome.min.css">
</head>
<body>

    <div class="header">
        <div class="container">
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


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="item.css">
    <title>Document</title>
</head>
<body>
    <div class="item-border">
        <h1><?php echo $name; ?></h1>
        <img class="item-image" src="<?php echo $image_url; ?>" alt="<?php echo $name; ?>">
        <p>Price: <?php echo $price; ?></p>
        <p><?php echo $description; ?></p>

        <form action="http://localhost/savoir/item.php?value=<?php echo $_GET['value']; ?>" method="post">
            <input type="hidden" name="customer_id" value="<?php echo isset($_SESSION['id']) ? $_SESSION['id'] : NULL; ?>">
            <input type="hidden" name="product_id" value="<?php echo isset($_GET['value']) ? $_GET['value'] : NULL; ?>">
            <label for="quantity">Quantity:</label>
            <select id="quantity" name="quantity">
                <?php
                for ($i = 1; $i <= $stock; $i++) {
                    echo "<option value='$i'>$i</option>";
                }
                ?>
            </select>
            <input type="submit" name="submit" value="Add to Basket">
        </form>
    </div>
</body>
</html>


