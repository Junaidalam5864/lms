<?php
// Include database connection
require 'config.php';

// Start session
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch user information
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];

// Fetch courses from the database
$stmt = $pdo->prepare("SELECT id, name, description FROM courses");
$stmt->execute();
$courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            padding: 20px;
            max-width: 800px;
            margin: auto;
            background: #ffffff;
            border-radius: 8px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #333333;
            text-align: center;
        }

        .welcome {
            margin-bottom: 20px;
            font-size: 18px;
            text-align: center;
            color: #555555;
        }

        .course-list {
            list-style: none;
            padding: 0;
        }

        .course-item {
            background: #f9f9f9;
            margin-bottom: 10px;
            padding: 15px;
            border: 1px solid #dddddd;
            border-radius: 4px;
        }

        .course-item h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }

        .course-item p {
            margin: 0;
            font-size: 14px;
            color: #666666;
        }

        .logout {
            display: block;
            text-align: center;
            margin-top: 20px;
            text-decoration: none;
            color: #4CAF50;
        }

        .logout:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Dashboard</h1>
        <p class="welcome">Welcome, <?php echo htmlspecialchars($user_name); ?>!</p>
        
        <h2>Your Courses</h2>
        <ul class="course-list">
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $course): ?>
                    <li class="course-item">
                        <h3><?php echo htmlspecialchars($course['name']); ?></h3>
                        <p><?php echo htmlspecialchars($course['description']); ?></p>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No courses available.</p>
            <?php endif; ?>
        </ul>

        <a href="logout.php" class="logout">Log out</a>
    </div>
</body>
</html> 