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
                <li><a href="admin-login.php">Admin</a></li>                    
                </ul>
            </nav>
        </div>
</body>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact Us - Furniture Order</title>
  <style>
/* General Styles */
body {
  font-family: Arial, sans-serif;
  background-color: #0d1b2a; /* Dark blue background */
  margin: 0;
  padding: 0;
  color: #ffffff; /* White text color */
}

/* Header */
header {
  background-color: #1c2e4a; /* Slightly lighter blue for header */
  padding: 1em;
  text-align: center;
}

/* Main Content */
main {
  max-width: 600px;
  margin: 20px auto;
  padding: 20px;
  background-color: #1c2e4a; /* Same blue as header */
  box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  border-radius: 5px; /* Rounded corners */
}

nav a {
  color: #fff;
  text-decoration: none;
  transition: color 0.3s;
}

/* Form */
form {
  display: flex;
  flex-direction: column;
}

label {
  margin-bottom: 8px;
}

input,
textarea {
  padding: 10px;
  margin-bottom: 16px;
  border: none;
  border-radius: 4px;
  background-color: #415a77; /* Lighter blue for input fields */
  color: #ffffff; /* White text color */
}

input:focus,
textarea:focus {
  outline: none;
  box-shadow: 0 0 5px rgba(255, 255, 255, 0.5); /* Subtle white glow on focus */
}

button {
  background-color: #007bff; /* Vibrant blue for button */
  color: #ffffff; /* White text color */
  padding: 12px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  transition: background-color 0.3s ease; /* Smooth transition on hover */
}

button:hover {
  background-color: #0056b3; /* Darker blue on hover */
}

/* Footer */
footer {
  background-color: #1c2e4a; /* Same blue as header */
  color: #ffffff; /* White text color */
  text-align: center;
  padding: 1em;
  position: fixed;
  bottom: 0;
  width: 100%;
}

/* Success Message */
#success-message {
  color: #28a745; /* Green success color */
  font-weight: bold;
  margin-bottom: 16px;
  display: none;
}
  </style>
</head>
<body>
  <header>
    <h1>Contact Us</h1>
  </header>
  <main>
    <div id="success-message">Message sent successfully!</div>
    <form id="contact-form">
      <label for="name">Name:</label>
      <input type="text" id="name" name="name" required>
      <label for="email">Email:</label>
      <input type="email" id="email" name="email" required>
      <label for="message">Message:</label>
      <textarea id="message" name="message" rows="4" required></textarea>
      <button type="submit">Submit</button>
    </form>
  </main>
  <footer>
    <p>Contact us: +44 7444 506 707 | hjxsigma@gmail.com</p>
  </footer>

  <script>
    const form = document.getElementById('contact-form');
    const successMessage = document.getElementById('success-message');

    form.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent the form from submitting

      // Get the form data
      const formData = new FormData(form);

      // You can process the form data here (e.g., send it to a server)
      console.log('Form Data:', Object.fromEntries(formData));

      // Display the success message
      successMessage.style.display = 'block';

      // Reset the form
      form.reset();
    });
  </script>
</body>
</html>