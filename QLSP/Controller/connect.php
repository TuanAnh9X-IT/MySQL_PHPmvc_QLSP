<?php
// Thông tin kết nối đến cơ sở dữ liệu
$servername = "localhost"; // Thay đổi nếu cần
$username = "root"; // Thay đổi thành tên người dùng của bạn
$password = ""; // Thay đổi thành mật khẩu của bạn
$dbname = "qlsp"; // Tên cơ sở dữ liệu

// Tạo kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Thiết lập charset để tránh lỗi ký tự
$conn->set_charset("utf8");
?>