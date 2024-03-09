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
                    <li><a href="index.html">Home</a></li>
                    <li><a href="product.php">Products</a></li>
                    <li><a href="about.html">About</a></li>
                    <li><a href="contact.html">Contact</a></li>
                    <li><a href="login.php">Account</a></li>
                    <li><a href="basket.html"><img src="img/bag.png" width="30px" height="30px"></a></li>
                </ul>
            </nav>
            <img src="img/bag.png" width="30px" height="30px">
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
    <header>
        <h1>Furniture Order Basket</h1>
    </header>

    <main>
        <div class="basket-item">
            <div class="item-details">
                <h3>White Lamp</h3>
                <p>Generic white lamp</p>
            </div>
            <div class="item-price">£15.99</div>
        </div>

        <div class="basket-item">
            <div class="item-details">
                <h3>Black Lamp</h3>
                <p>Generic black lamp</p>
            </div>
            <div class="item-price">£15.99</div>
        </div>

        <div class="basket-item">
            <div class="item-details">
                <h3>Pear Table</h3>
                <p>Amazing table</p>
            </div>
            <div class="item-price">£12.99</div>
        </div>

        <div class="basket-item">
            <div class="item-details">
                <h3>Ambulance Bed</h3>
                <p>Ambulance bed for children</p>
            </div>
            <div class="item-price">£200.00</div>
        </div>

        <div class="basket-total">
            <p>Total: £245.97</p>
        </div>

        <button>Proceed to Checkout</button>
    </main>
</body>
</html>
