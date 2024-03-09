<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            flex-direction: column;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        label {
            margin-bottom: 8px;
        }

        input, textarea {
            margin-bottom: 16px;
            padding: 8px;
        }

        textarea {
            resize: vertical;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <h1>Add Product</h1>
    <form action="add-product.php" method="post">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name">

        <label for="price">Price:</label>
        <input type="text" name="price" id="price">

        <label for="stock">Stock:</label>
        <input type="text" name="stock" id="stock">

        <p>Description:</p>
        <textarea name="description" id="description" cols="30" rows="10"></textarea>

        <input type="submit" value="Submit" name="submit">
    </form>
</body>
</html>
