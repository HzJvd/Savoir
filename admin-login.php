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
                    </ul>
                </nav>
            </div>
            
<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "hamzah";
$password = "hamzah";
$dbname = "savoir";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Prepare and execute the SQL query
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Login successful, store the admin information in the session
        $row = $result->fetch_assoc();
        $_SESSION["admin_id"] = $row["admin_id"];
        $_SESSION["admin_username"] = $row["username"];

        // Redirect to the admin dashboard
        header("Location: admin-dashboard.php");
        exit();
    } else {
        // Login failed
        $error_message = "Invalid username or password.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <style>
        body {
    font-family: 'Poppins', sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f8f8f8;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
}

.login-container {
    background-color: #fff;
    padding: 40px;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 400px;
    width: 100%;
    text-align: center;
}

h1 {
    color: #333;
    margin-bottom: 30px;
}

.error-message {
    color: #ff4d4d;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

label {
    font-weight: 500;
    color: #555;
    margin-bottom: 8px;
}

input {
    padding: 12px 16px;
    border: 1px solid #ddd;
    border-radius: 4px;
    margin-bottom: 16px;
    font-size: 14px;
}

button[type="submit"] {
    background-color: #333;
    color: #fff;
    border: none;
    padding: 12px 16px;
    border-radius: 4px;
    cursor: pointer;
    font-size: 14px;
    transition: background-color 0.3s ease;
}

button[type="submit"]:hover {
    background-color: #555;
}

p {
    margin-top: 20px;
    color: #666;
}

a {
    color: #333;
    text-decoration: none;
    font-weight: 500;
}

a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
    <h1>Admin Login</h1>
    <?php if (isset($error_message)) { ?>
        <p style="color: red;"><?php echo $error_message; ?></p>
    <?php } ?>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
        <input type="submit" value="Login">
    </form>
    <p>Don't have an account? <a href="admin-register.php">Register</a></p>
</body>
</html>








