<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION["customer_id"])) {
    $customer_id = $_SESSION["customer_id"];
    $username = $_SESSION["username"];
    $first_name = $_SESSION["first_name"];
    $surname = $_SESSION["surname"];
} else {
    // User is not logged in, redirect to the login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
    <style>
        *{
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    }

    body{
        font-family: 'Poppins', sans-serif;
    }
    .navbar{
        display: flex;
        align-items: center;
        padding: 20px;
    }
    nav{
        flex: 1;
        text-align: right;
    }
    nav ul{
        display: inline-block;
        list-style-type: none;
    }
    nav ul li{
        display: inline-block;
        margin-right: 20px;
    }
    a{
        text-decoration: none;
        color: #555;
    }
    p{
        color: #555;
    }
    .container{
        max-width: 1300px;
        margin: auto;
        padding-left: 25px;
        padding-right: 25px;
    }
    .row{
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .col-2{
        flex-basis: 50%;
        min-width: 300px;
    }
    .col-2 img{
        max-width: 100%;
        padding: 50px 0;
    }
    .col-2 h1{
        font-size: 50px;
        line-height: 60px;
        margin: 25px 0;
    }
    .btn{
        display: inline-block;
        background: #1a2796;
        color: #fff;
        padding: 8px 30px;
        margin: 30px 0;
        border-radius: 30px;
        transition: background 0.5s;
    }
    .btn:hover{
        background: #0d052f;
    }

    .header{
        background: radial-gradient(#fff, #ffd6d6);

    }
    .header .row{
        margin-top: 70px;
    }
    .categories{
        margin: 70px 0;
    }
    .col-3{
        flex-basis: 30%;
        min-width: 250px;
        margin-bottom: 30px;
    }
    .col-3 img{
        width: 100%;
    }
    .small-container{
        max-width: 1080px;
        margin: auto;
        padding-left: 25px;
        padding-right: 25px;

    }
    .col-4{
        flex-basis: 25%;
        padding: 10px;
        min-width: 200px;
        margin-bottom: 50px;
        transition: transform 0.5s;
    }
    .col-4 img{
        width: 100%;
    }

    .title{
        text-align: center;
        margin: 0 auto 80px;
        position: relative;
        line-height: 60px;
        color: #555555;
    }
    .title::after{
        content: '';
        background: #483bff;
        width: 80px;
        height: 5px;
        position: absolute;
        bottom: 0;
        left: 50%;
        transform: translateX(-50%);    
    }

    .h4{
        color: #555555;
        font-weight: normal;
    }
    .col-4 p{
        font-size: 14px;
    }
    .rating .fa{
        color: #3e3bff;
    }

    .col-4:hover{
        transform: translateY(-5px);
    }

    .offer{
        background: radial-gradient(#fff, #ffd6d6);
        margin-top: 80px;
        padding: 30px 0;
    }
    .col-2 .offer-img{
        padding: 50px;
    }
    small{
        color: #555;
    }
        .success-message {
            background-color: #4CAF50;
            color: white;
            padding: 20px;
            text-align: center;
            font-weight: bold;
            margin-top: 20px;
        }
        
    </style>
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
            
            <?php
            // Display the success message if the login was successful
            if (isset($_SESSION["login_success"])) {
                echo "<div class='success-message'>Login successful! Welcome, $first_name $surname.</div>";
                unset($_SESSION["login_success"]);
            }
            ?>

            <div class="row">
                <div class="col-2">
                    <h1>Elevate the aesthetic of your furniture</h1>
                    <p>Embark upon a journey of refinement by exploring a wide range of furniture essentials</p>
                    <a href="product.php" class="btn">Explore Now &#8594;</a>
                </div>
                <div class="col-2">
                    <img src="img/Interior-Design-PNG-File-Download-Free (1).png">
                </div>
            </div>
        </div>
    </div>

    <!------ featured categories ------>
    <div class="categories">
        <div class="small-container">
            <div class="row">
                <?php
                    include 'connect.php'; // Connect to the database

                    $sql = "SELECT * FROM products LIMIT 3";
                    $result = mysqli_query($conn, $sql);

                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<div class="col-3">';
                        echo '<a href="item.php?value=' . $row['product_id'] . '">';
                        echo '<img src="' . $row['image_url'] . '" alt="' . $row['product_name'] . '">';
                        echo '</a>';
                        echo '</div>';
                    }
                ?>
            </div>
        </div>
    </div>

    <!------ featured products ------>
    <div class="small-container">
        <h2 class="title">Featured Products</h2>
        <div class="row">
            <?php
                $sql = "SELECT * FROM products LIMIT 4";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-4">';
                    echo '<a href="item.php?value=' . $row['product_id'] . '">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['product_name'] . '">';
                    echo '<h4>' . $row['product_name'] . '</h4>';
                    echo '<div class="rating">';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                    echo '</div>';
                    echo '<p>$' . $row['price'] . '</p>';
                    echo '</a>';
                    echo '</div>';
                }
            ?>
        </div>

        <!------ latest products ------>
        <h2 class="title">Latest Products</h2>
        <div class="row">
            <?php
                $sql = "SELECT * FROM products ORDER BY product_id DESC LIMIT 4";
                $result = mysqli_query($conn, $sql);

                while ($row = mysqli_fetch_assoc($result)) {
                    echo '<div class="col-4">';
                    echo '<a href="item.php?value=' . $row['product_id'] . '">';
                    echo '<img src="' . $row['image_url'] . '" alt="' . $row['product_name'] . '">';
                    echo '<h4>' . $row['product_name'] . '</h4>';
                    echo '<div class="rating">';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<i class="fa fa-star" aria-hidden="true"></i>';
                    echo '<i class="fa fa-star-half-o" aria-hidden="true"></i>';
                    echo '</div>';
                    echo '<p>$' . $row['price'] . '</p>';
                    echo '</a>';
                    echo '</div>';
                }
            ?>
        </div>
    </div>

    <!------ offers ------>
    <div class="offer">
        <div class="small-container">
            <div class="row">
                <div class="col-2">
                    <img src="img/bed-png-32116.png" class="offer-img">
                </div>
                <div class="col-2">
                    <p>Exclusive Savoir Offers</p>
                    <h1>Luxury Bedset For Sale</h1>
                    <small>Introducing our Luxe Dream Bed Set — a seamless blend of elegance and comfort that adds a touch of sophistication to your bedroom. Immerse yourself in the silky softness of our high-thread-count sheets.</small>
                    <a href="product.php" class="btn">Buy Now &#8594;</a>
                </div>
            </div>
        </div>
    </div>

</body>
</html>