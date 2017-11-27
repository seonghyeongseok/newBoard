<?php
/**
 * Created by PhpStorm.
 * User: hyeongseok
 * Date: 2017-11-23
 * Time: 오후 11:56
 */

$id = $_POST['id'];
$pass = $_POST['pass'];

include "db_info.php";

$connect = mysqli_connect(host, user, pass, db);

if (!$connect) {
    echo "<script>alert('초기화면으로 돌아갑니다...');
                location.replace('loginTemplete.html');</script>";
}

$result = false;

if(isset($id) && isset($pass)) {
    $sql = "insert into user_info (id, pass) values ('$id', '$pass')";
    $result = mysqli_query($connect, $sql);
}

if ($result) {
    echo "<script>alert('회원가입을 축하합니다!')
            location.replace('loginTemplete.html')</script>";
} else if($result == false){
    echo "<script>alert('잘못된 접근입니다!');
            location.replace('join.html');</script>";
}else {
    echo "<script>alert('20자 이내로!!');
            location.replace('join.html');</script>";
}

mysqli_close();