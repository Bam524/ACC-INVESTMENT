<?php
session_start();
require_once "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);
    $currency = $_POST["currency"];
    $country = $_POST["country"];

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        $message = "Email already registered!";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password, currency, country) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $username, $email, $password, $currency, $country);

        if ($stmt->execute()) {
            $_SESSION['user'] = $username;
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Registration failed!";
        }
        $stmt->close();
    }
    $check->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Register - ACC Investment</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
  <style>
    body {
      background-color: #000018;
      color: gold;
      font-family: 'Poppins', sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .form-box {
      background: #111;
      padding: 30px;
      border-radius: 20px;
      width: 90%;
      max-width: 500px;
    }
    input, select {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border: none;
      border-radius: 10px;
      font-size: 1em;
    }
    .btn {
      background-color: gold;
      color: #000;
      padding: 12px;
      width: 100%;
      border-radius: 10px;
      font-weight: bold;
      cursor: pointer;
    }
    .btn:hover {
      background-color: #ffdb4d;
    }
    .message {
      color: red;
      margin-bottom: 10px;
      text-align: center;
    }
    .switch-link {
      text-align: center;
      margin-top: 15px;
    }
    .switch-link a {
      color: #0f0;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="form-box">
    <h2>Create Your Account</h2>
    <?php if ($message): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST">
      <input type="text" name="username" placeholder="Username" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <select name="currency" required>
        <option value="">Select Currency</option>
        <option value="USD">USD</option>
        <option value="EUR">EUR</option>
        <option value="GBP">GBP</option>
        <option value="PLN">PLN</option>
        <option value="CAD">CAD</option>
        <option value="ILS">ILS</option>
        <option value="AMD">Armenian dram</option>
        <option value="SAR">Saudi riyal</option>
        <!-- Add top 50 as needed -->
      </select>
      <select name="country" required>
        <option value="">Select Country</option>
        <option value="Nigeria">Nigeria</option>
        <option value="Poland">Poland</option>
        <option value="USA">United States</option>
        <option value="Germany">Germany</option>
        <option value="France">France</option>
        <option value="Italy">Italy</option>
        <option value="Israel">Israel</option>
        <option value="Armenia">Armenia</option>
        <option value="Saudi Arabia">Saudi Arabia</option>
        <!-- Add more as needed -->
      </select>
      <button type="submit" class="btn">Register</button>
    </form>
    <div class="switch-link">
      Already have an account? <a href="login.php">Login</a>
    </div>
  </div>
</body>
</html>
