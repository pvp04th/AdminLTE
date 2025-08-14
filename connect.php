<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$host = "localhost";
$user = "root"; // หรือชื่อผู้ใช้ฐานข้อมูลของคุณ
$pass = "";     // ถ้าใช้ XAMPP ปกติไม่ต้องใส่รหัสผ่าน
$db = "it68-2"; // เปลี่ยนเป็นชื่อฐานข้อมูลจริง

$con = mysqli_connect($host, $user, $pass, $db);

if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
