<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Career Counselling</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background: #f9f9f9;
        }
        header {
            background: #007bff;
            color: white;
            padding: 15px;
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
        }
        .welcome {
            font-size: 20px;
            margin-bottom: 20px;
        }
        .intro {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 4px 8px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        .subjects {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }
        .subject-card {
            background: #ffffff;
            padding: 20px;
            text-align: center;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            transition: 0.3s;
        }
        .subject-card:hover {
            background: #f0f8ff;
            transform: scale(1.05);
        }
        .menu {
            margin-top: 30px;
            display: flex;
            gap: 15px;
        }
        .menu a {
            display: inline-block;
            padding: 10px 15px;
            background: #007bff;
            color: white;
            border-radius: 5px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
        }
        .menu a:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <header>
        <h1>Career Counselling System</h1>
    </header>

    <div class="container">
        <p class="welcome">👋 Welcome, <b><?php echo $_SESSION['user_name']; ?></b></p>

        <div class="intro">
            <h2>About Our Career Counselling Website</h2>
            <p>
                This platform helps students explore different subjects, understand their advantages,
                disadvantages, available courses, and career opportunities.  
                By selecting your subject of interest, you can make informed decisions about your future path.
            </p>
        </div>

        <h2>Select Your Interested Subject</h2>
        <div class="subjects">
            <div class="subject-card">
                <h3>Science</h3>
                <a href="subject.php?name=science">Explore →</a>
            </div>
            <div class="subject-card">
                <h3>Commerce</h3>
                <a href="subject.php?name=commerce">Explore →</a>
            </div>
            <div class="subject-card">
                <h3>Arts</h3>
                <a href="subject.php?name=arts">Explore →</a>
            </div>
        </div>

        <!-- Student Menu -->
        <div class="menu">
            <a href="profile.php">👤 My Profile</a>
            <a href="quiz_results.php">📊 My Quiz Results</a>
            <a href="logout.php">🚪 Logout</a>
        </div>
    </div>
</body>
</html>
