<?php
$servername = "localhost";
$username   = "root"; 
$password   = "";       
$dbname     = "qlsv";   
$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
echo "Kết nối thành công đến MySQL Server.<br>";
$sql_create_db = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql_create_db) === TRUE) {
    echo "Cơ sở dữ liệu '$dbname' đã được tạo thành công hoặc đã tồn tại.<br>";
} else {
    die("Lỗi khi tạo cơ sở dữ liệu: " . $conn->error . "<br>");
}
$conn->close();
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại DB '$dbname': " . $conn->connect_error);
}
echo "Kết nối thành công đến CSDL '$dbname'.<br>";
$sql_classes = "CREATE TABLE IF NOT EXISTS classes (
    ClassId INT AUTO_INCREMENT PRIMARY KEY,
    ClassName VARCHAR(100) NOT NULL
)";
if ($conn->query($sql_classes) === TRUE) {
    echo "Bảng 'classes' đã được tạo thành công hoặc đã tồn tại.<br>";
} else {
    die("Lỗi khi tạo bảng 'classes': " . $conn->error . "<br>");
}
$sql_students = "CREATE TABLE IF NOT EXISTS students (
    StudentId INT AUTO_INCREMENT PRIMARY KEY,
    FullName VARCHAR(200) NOT NULL,
    DateOfBirth DATE,
    Gender VARCHAR(10),
    ClassId INT,
    Avatar VARCHAR(255),
    Email VARCHAR(100) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL,
    Active BIT DEFAULT 1,
    FOREIGN KEY (ClassId) REFERENCES classes(ClassId)
)";
if ($conn->query($sql_students) === TRUE) {
    echo "Bảng 'students' đã được tạo thành công hoặc đã tồn tại.<br>";
} else {
    die("Lỗi khi tạo bảng 'students': " . $conn->error . "<br>");
}
$sql_insert_classes = "INSERT IGNORE INTO classes (ClassId, ClassName) VALUES
(1, 'Lớp 10A1'),
(2, 'Lớp 10A2'),
(3, 'Lớp 11B1'),
(4, 'Lớp 11B2'),
(5, 'Lớp 12C1'),
(6, 'Lớp 12C2')";
if ($conn->query($sql_insert_classes) === TRUE) {
    echo "Dữ liệu mẫu cho bảng 'classes' đã được chèn thành công.<br>";
} else {
    echo "Lỗi khi chèn dữ liệu vào bảng 'classes': " . $conn->error . "<br>";
}
$sql_insert_students = "INSERT IGNORE INTO students 
(StudentId, FullName, DateOfBirth, Gender, ClassId, Avatar, Email, Password, Active) VALUES
(1, 'Nguyễn Văn A', '2005-01-01', 'Nam', 1, 'avatar_a.jpg', 'vana@gmail.com', 'pass123', 1),
(2, 'Trần Thị B', '2005-02-02', 'Nữ', 2, 'avatar_b.jpg', 'thib@gmail.com', 'pass123', 1),
(3, 'Lê Văn C', '2005-03-03', 'Nam', 3, 'avatar_c.jpg', 'vanc@gmail.com', 'pass123', 1),
(4, 'Phạm Thị D', '2005-04-04', 'Nữ', 4, 'avatar_d.jpg', 'thid@gmail.com', 'pass123', 1),
(5, 'Hoàng Văn E', '2005-05-05', 'Nam', 5, 'avatar_e.jpg', 'vane@gmail.com', 'pass123', 1),
(6, 'Ngô Thị F', '2005-06-06', 'Nữ', 6, 'avatar_f.jpg', 'thif@gmail.com', 'pass123', 1)";
if ($conn->query($sql_insert_students) === TRUE) {
    echo "Dữ liệu mẫu cho bảng 'students' đã được chèn thành công.<br>";
} else {
    echo "Lỗi khi chèn dữ liệu vào bảng 'students': " . $conn->error . "<br>";
}
$conn->close();
?>
