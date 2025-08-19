<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "qlsv";
$error_message = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $matkhau = $_POST['password'];
    $conn = new mysqli($servername, $username, $password, $dbname);
    if ($conn->connect_error) {
        $error_message = "Kết nối thất bại: " . $conn->connect_error;
    } else {
        $sql = "SELECT StudentId, FullName, Password FROM students WHERE Email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $user = $result->fetch_assoc();
            if ($matkhau === $user['Password']) {
                $_SESSION['email'] = $email;
                $_SESSION['fullname'] = $user['FullName'];
                $_SESSION['student_id'] = $user['StudentId'];
                header("Location: welcome.php");
                exit();
            } else {
                $error_message = "Mật khẩu không chính xác. Vui lòng thử lại.";
            }
        } else {
            $error_message = "Email không tồn tại trong hệ thống.";
        }
        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập hệ thống</title>
    <style>
        html{
            height: 100%;
            width: 100%;
            top:0;
            left:0;
            padding: 0;
            margin:0;
            display:table;
        }
        body{
            display:table-cell;
            vertical-align:middle;
            background-color: #f0f8ff; 
            font-family: Arial, sans-serif;
        }
        .login-container{
            text-align:center;
            border: 1px solid blue;
            width:400px;
            margin: 0 auto;
            border-radius:10px;
            padding: 20px;
            background-color: lightcyan;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-control {
            width: 90%;
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            border: 1px solid #ced4da;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }
        .img-container {
            margin: 10px 0;
        }
        img {
            border-radius: 50%;
            margin-top: 10px;
            margin-bottom: 10px;
            width:100px;
            height:100px;
        }
        .btn {
            width: 100px;
            padding: 10px;
            background-color: blue;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 10px;
        }
        .btn:hover {
            background-color: darkblue;
        }
        .remember-me {
            margin: 10px 0;
        }

        .footer-links a {
            text-decoration: none;
            color: blue;
            margin: 0 5px;
        }
        .footer-links a:hover {
            text-decoration: underline;
        }
        .error-message {
            color: red;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="img-container">
            <img src="./logo/a1.jpg" alt="">
        </div>
        
        <h2>Đăng nhập</h2>
        
        <?php if (!empty($error_message)): ?>
            <div class="error-message"><?php echo $error_message; ?></div>
        <?php endif; ?>
        
        <form method="POST" action="">
            <div class="input-group">
                <input type="email" name="email" class="form-control" placeholder="Email" required>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" class="form-control" placeholder="Mật khẩu" required>
            </div>
            <button type="submit" class="btn">đăng nhập</button>
        </form>
        
        <div class="footer-links">
            <a href="#">Bạn cần trợ giúp gì honggg ib Phúc Nguyên?</a>
        </div>
    </div>
</body>
</html>