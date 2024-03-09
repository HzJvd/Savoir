<!DOCTYPE html>
<html>
    <head>
        <title>Make an order</title>
        <style>
            body {
                display: flex;
                flex-direction: column;
                align-items: center;
                height: 100vh;
                margin: 0;
            }

            nav {
                width: 100%;
                background-color: #333;
                color: white;
                padding: 10px;
                text-align: center;
            }

            #container {
                display: flex;
                flex-direction: column;
                align-items: center;
            }

            form {
                margin-top: 20px;
            }

            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: center;
            }

            select, input[type="number"], input[type="submit"] {
                width: 100%;
                padding: 8px;
                box-sizing: border-box;
            }
        </style>
    </head>
    <body>
    
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

        <div id="container">
            <h1>Make an order:</h1>

            <form method="post" action="OrderScript.php">
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="2">
                                <select name="furnitureName">
                                    <option selected disabled>Select Furniture</option>
                                    <?php
                                        // Add your PHP code to fetch furniture names from the database and populate the dropdown.
                                    ?>
                                </select>
                            </td>
                            <td colspan="2">
                                <input type="number" min="1" name="quantity"/>
                            </td>
                            <td>
                                <input type="submit" value="Add" />
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>
    </body>
</html>
