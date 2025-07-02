<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register - ACC Investment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { background: #000011; font-family: Poppins, sans-serif; color: gold; text-align: center; }
        form { max-width: 400px; margin: auto; background: #111133; padding: 20px; border-radius: 10px; }
        input, select { width: 100%; padding: 10px; margin: 10px 0; border-radius: 5px; border: none; }
        button { background: gold; color: black; padding: 10px; width: 100%; font-weight: bold; }
    </style>
</head>
<body>
    <h1>ACC INVESTMENT</h1>
    <form action="register_submit.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <select name="currency" required>
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
            <option value="NGN">NGN</option>
            <option value="CAD">CAD</option>
            <!-- Add top 50 as needed -->
        </select>
        <select name="country" required>
            <option value="United States">United States</option>
            <option value="Canada">Canada</option>
            <option value="Nigeria">Nigeria</option>
            <option value="United Kingdom">United Kingdom</option>
            <option value="Germany">Germany</option>
            <!-- Add more countries -->
        </select>
        <button type="submit">Register</button>
    </form>
    <p><a href="login.php" style="color:lightgreen;">Already have an account? Login</a></p>
</body>
</html>
