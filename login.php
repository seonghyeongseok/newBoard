<?php
/**
 * Created by PhpStorm.
 * User: hyeongseok
 * Date: 2017-11-23
 * Time: 오후 9:57
 */

$id = $_POST['id'];
$pass = $_POST['pass'];

include "db_info.php";

$connect = mysqli_connect(host, user, pass, db);

if (!$connect) {
    echo "<script>alert('초기화면으로 돌아갑니다...');
                location.replace('loginTemplete.html');</script>";
}

$sql = "select * from user_info where id='$id' and pass='$pass'";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) == 1) {
    session_start();

    $_SESSION['id'] = $id;
    $_SESSION['pass'] = $pass;

    echo "<script>alert('로그인 되었습니다!');
            location.replace('list.php');</script>";
} else {
    echo "<script>alert('로그인에 실패하였습니다!');
            location.replace('loginTemplete.html');</script>";
}


mysqli_close();