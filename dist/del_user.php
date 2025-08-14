<?php

$username = $_GET['username'];
require '../connect.php';
$sql = "DELETE FROM user WHERE username='$username' ";
$result = $con->query($sql);
if(!$result){
    echo "<script>alert('Can not delete')</script>";
}else{
    echo "<script>window.location.href='index.php?page=users_list'</script>";
}

?>