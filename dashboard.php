<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$user_q = $conn->query("SELECT username, balance, currency FROM users WHERE id = $user_id");
$user = $user_q->fetch_assoc();
$username = $user['username'];
$balance = $user['balance'];
$currency = $user['currency'];

$pending_deposits = $conn->query("SELECT COUNT(*) AS count FROM deposits WHERE user_id = $user_id AND status = 'pending'")->fetch_assoc()['count'];
$pending_withdrawals = $conn->query("SELECT COUNT(*) AS count FROM withdrawals WHERE user_id = $user_id AND status = 'pending'")->fetch_assoc()['count'];
?><!DOCTYPE html><html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - ACC Investment</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background-color: #000011;
            color: gold;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            text-align: center;
        }
        .title {
            font-size: 28px;
            font-weight: bold;
            color: gold;
        }
        .info {
            margin-top: 20px;
            font-size: 20px;
        }
        .info span {
            display: block;
            margin-bottom: 5px;
            color: lightblue;
            font-size: 22px;
        }
        .button {
            display: block;
            width: 80%;
            margin: 10px auto;
            padding: 14px;
            background-color: #FFD700;
            color: #000;
            text-decoration: none;
            font-weight: bold;
            border-radius: 8px;
            transition: 0.3s;
        }
        .button:hover {
            background-color: #FFA500;
        }
        .badge {
            background-color: red;
            color: white;
            padding: 4px 8px;
            font-size: 12px;
            border-radius: 4px;
            margin-left: 5px;
        }
        .footer {
            margin-top: 30px;
            color: white;
            font-size: 14px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="title">ACC INVESTMENT</div>
    <div class="info">
        <span><?php echo htmlspecialchars($username); ?></span>
        <span><?php echo $currency . ' ' . number_format($balance, 2); ?></span>
    </div><a class="button" href="deposit.php">💰 Deposit<?php if ($pending_deposits > 0) echo " <span class='badge'>$pending_deposits</span>"; ?></a>
<a class="button" href="withdrawal.php">💸 Withdraw<?php if ($pending_withdrawals > 0) echo " <span class='badge'>$pending_withdrawals</span>"; ?></a>
<a class="button" href="kyc.php">🛡️ KYC Verification</a>
<a class="button" href="investment.php">📈 Investment Plan</a>
<a class="button" href="investment_history.php">📊 Investment History</a>
<a class="button" href="deposit_history.php">📄 Deposit History</a>
<a class="button" href="withdrawal_history.php">📄 Withdrawal History</a>
<a class="button" href="blog.php">📰 Blog</a>
<a class="button" href="mailto:activecapitalcompanynotify@gmail.com">💬 Contact Us</a>
<a class="button" href="logout.php">🚪 Logout</a>

<div class="footer">&copy; 2015 - <?php echo date('Y'); ?> ACC Investment. All rights reserved.</div>

</div>
</body>
</html>
