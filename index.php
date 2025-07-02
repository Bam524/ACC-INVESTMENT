<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>ACC-INVESTMENT</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background-color: #000c1a;
            color: gold;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }
        h1 {
            color: #0f0; /* green */
        }
        select, button {
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
        }
        select {
            background: #111;
            color: gold;
        }
        button {
            background-color: gold;
            color: #000;
            cursor: pointer;
        }
        .buttons {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <h1>ACC-INVESTMENT</h1>
    <p>Your path to financial success</p>

    <label for="language">Select Language:</label>
    <select id="language">
        <option>English</option>
        <option>Hebrew</option>
        <option>Polish</option>
        <option>German</option>
        <option>Italian</option>
        <option>Russian</option>
        <option>Arabic</option>
        <option>Hungarian</option>
        <!-- Add rest of top 50 -->
    </select>

    <div class="buttons">
        <a href="register.php"><button>Get Started</button></a>
        <a href="login.php"><button>Login</button></a>
    </div>
</body>
</html>
