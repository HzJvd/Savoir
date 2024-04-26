<?php
include "connect.php";
if(isset($_POST['submit'])){
    $product_name = $_POST['name'];
    $image_url = $_POST['image'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $stock = $_POST['stock'];

    $sql = "INSERT INTO products VALUES(NULL,'$product_name','$description','$price','$stock','$image_url')";
    if(mysqli_query($conn,$sql)){
        header("location:http://localhost/savoir/index.php");
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
    <title>Add Product</title>
    <style>
/* Add Product Section */
/* Add Product Section */
.add-product-section {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f8f8f8;
}

.add-product-form {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    background-color: #fff;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    width: 400px;
}

.add-product-form h1 {
    text-align: center;
    margin-bottom: 30px;
    color: #333;
    font-family: 'Poppins', sans-serif;
    font-weight: 600;
}

.add-product-form label {
    margin-bottom: 8px;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    color: #555;
}

.add-product-form input,
.add-product-form textarea {
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ddd;
    border-radius: 20px; /* Added curved border */
    width: 100%;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    color: #333;
}

.add-product-form textarea {
    resize: vertical;
    border-radius: 10px; /* Added curved border for textarea */
}

.add-product-form input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    padding: 12px 30px;
    border: none;
    border-radius: 20px; /* Added curved border for submit button */
    cursor: pointer;
    font-family: 'Poppins', sans-serif;
    font-weight: 500;
    transition: background-color 0.3s ease;
}

.add-product-form input[type="submit"]:hover {
    background-color: #45a049;
}

/* Image Upload */
.image-upload {
    display: flex;
    align-items: center;
    margin-bottom: 20px;
}

.image-upload input[type="file"] {
    margin-right: 10px;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    color: #333;
}

.image-upload img {
    max-width: 100px;
    max-height: 100px;
    border-radius: 5px;
    box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
}
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <label for="name">Name:</label>
    <form action="admin-product.php" method=POST>
            <input type="text" name="name" id="name">
            <div class="image-upload">
                <label for="image">Image:</label>
                <input type="text" name="image" id="image">
            </div>
            <label for="price">Price:</label>
            <input type="text" name="price" id="price">
            <label for="description">Description:</label>
            <input type="text" name="description">
            <label for="stock">Stock:</label>
            <input type="number" name="stock" id="stock">
            <p>Description:</p>
            <textarea name="description" id="description" cols="30" rows="10"></textarea>
            <input type="submit" value="Submit" name="submit">
        </form>
    </div>

    <script>
        const imageInput = document.getElementById('image');
        const previewImage = document.getElementById('preview');

        imageInput.addEventListener('change', function() {
            const file = this.files[0];

            if (file) {
                const reader = new FileReader();

                reader.addEventListener('load', function() {
                    previewImage.src = reader.result;
                });

                reader.readAsDataURL(file);
            } else {
                previewImage.src = '#';
            }
        });
    </script>
</body>
</html>