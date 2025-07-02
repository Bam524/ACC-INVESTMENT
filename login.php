<?php
session_start();
require_once "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST["email"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 1) {
        $stmt->bind_result($id, $username, $hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION["user"] = $username;
            $_SESSION["user_id"] = $id;
            header("Location: dashboard.php");
            exit();
        } else {
            $message = "Invalid password!";
        }
    } else {
        $message = "Account not found!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - ACC Investment</title>
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
    input {
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
    <h2>Welcome Back</h2>
    <?php if ($message): ?>
      <div class="message"><?php echo $message; ?></div>
    <?php endif; ?>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit" class="btn">Login</button>
    </form>
    <div class="switch-link">
      Don't have an account? <a href="register.php">Register</a>
    </div>
  </div>
</body>
</html>
