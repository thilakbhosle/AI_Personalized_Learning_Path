<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Career Counselling System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f4f7fb;
        }
        header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: auto;
            text-align: center;
            padding: 30px;
        }
        .box {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0,0,0,0.1);
        }
        h1 {
            margin-bottom: 10px;
        }
        p {
            color: #555;
            font-size: 18px;
        }
        .buttons {
            margin-top: 20px;
        }
        .btn {
            display: inline-block;
            padding: 12px 25px;
            margin: 10px;
            background: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-size: 16px;
        }
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>

<header>
    <h1>🎓 Career Counselling System</h1>
</header>

<div class="container">
    <div class="box">
        <h2>Welcome to Career Guidance Platform</h2>
        <p>
            This system helps students choose the right career path based on their interests and skills.
            Explore different streams, take quizzes, and get personalized suggestions.
        </p>

        <div class="buttons">
            <a href="register.php" class="btn">Register</a>
            <a href="login.php" class="btn">Login</a>
        </div>
    </div>
</div>

</body>
</html>