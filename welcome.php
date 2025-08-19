<?php
session_start();
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$fullname = $_SESSION['fullname'];
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chào mừng</title>
    <style>
        body {
            background-color:rgba(139, 136, 136, 0.95);
            font-family: 'Arial', sans-serif;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #333;
        }
        .welcome-container {
            background-color: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius:9px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            text-align: center;
        }
        h1 {
            color: #2c3e50;
            font-size: 32px;
            margin-bottom: 15px;
            font-weight: 600;
        }
        
        p {
            color: #34495e;
            font-size: 20px;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        
        .logout-button {
            background-color: #e74c3c;
            color: white;
            border: none;
            padding: 16px 40px;
            border-radius: 8px;
            font-size: 18px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(231, 76, 60, 0.3);
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
        }
        
        .logout-button:hover {
            background-color: #c0392b;
            transform: translateY(-3px);
            box-shadow: 0 6px 8px rgba(231, 76, 60, 0.4);
        }
    </style>
</head>
<body>
    <div class="welcome-container">
        <h1>Xin chào, <?php echo htmlspecialchars($fullname); ?>!</h1>
        <p>Bạn đã đăng nhập thành công.</p>
        <a href="dangxuat.php" class="logout-button">Đăng xuất</a>
    </div>
</body>
</html>