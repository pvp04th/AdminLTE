<?php
include 'connect.php';
$username = $_POST['username'];
$password = $_POST['password'];
//echo "username = $username <br>";
//echo "password = $password";
if ($username == "" || $password == "") {
    echo "<script>
        alert('กรุณากรอก username หรือ password');
        location.href = 'login.php';
    </script>";
} else{


require 'connect.php';

$sql = "SELECT * FROM user WHERE username='$username' AND password='$password'";

$resule = mysqli_query($con, $sql);
// $resule = $con =>query($sql);แบบย่อ
$num = mysqli_num_rows($resule);
$row = mysqli_fetch_array($resule);
if ($num == 0) {
    echo "<script>
        alert('Username หรือ Password ไม่ถูกต้อง');
        window.location.href = 'login.php';
    </script>";
} else { 
    $_SESSION['username'] =  $row['username'];
    $_SESSION['fullname'] =  $row['fullname'];
    header('location:dist/index.php');
    //echo "<script>alert('Login Faild')</script>";555
}
}
