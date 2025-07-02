<?php
session_start();
include 'config.php';
include 'send_mail.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $conn->real_escape_string(trim($_POST['username']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $currency = $_POST['currency'];
    $country = $_POST['country'];

    $check = $conn->query("SELECT id FROM users WHERE email = '$email'");
    if ($check->num_rows > 0) {
        echo "Email already registered.";
        exit();
    }

    $sql = $conn->prepare("INSERT INTO users (username, email, password, currency, country, balance) VALUES (?, ?, ?, ?, ?, 0.00)");
    $sql->bind_param("sssss", $username, $email, $password, $currency, $country);
    if ($sql->execute()) {
        $_SESSION['user_id'] = $sql->insert_id;
        sendRegistrationEmail($email, $username);
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Registration failed.";
    }
}
?>
