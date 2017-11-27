<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h1>글목록</h1>
<table>
    <tr>
        <td>글번호</td>
        <td>작성자</td>
        <td>제목</td>
        <td>작성일자</td>
    </tr>
<?php
/**
     * Created by PhpStorm.
     * User: hyeongseok
     * Date: 2017-11-23
     * Time: 오후 9:57
     */

session_start();

include "db_info.php";

$connect = mysqli_connect(host, user, pass, db);

if (!$connect) {
    echo "<script>alert('초기화면으로 돌아갑니다...');
            location.replace('loginTemplete.html');</script>";
}

$sql = "select * from list";
$result = mysqli_query($connect, $sql);
$table_low = mysqli_num_rows($result);

for($i = 0 ; $i < $table_low ; $i++){
    $result_array = mysqli_fetch_array($result);
    $board_id = $result_array['board_id'];

    echo "<tr>";
    echo "<td>".$result_array."</td>";
    echo "<td>".$result_array['writer']."</td>";
    echo "<td onclick='read($result_array)'>".$result_array['title']."</td>";
    echo "<td>".$result_array['reg_date']."</td>";
    echo "</tr>";
}

mysqli_close();
?>

</table>
<form action="write.php" method="post">
    <input type="submit" value="write">
</form>
<form action="loginTemplete.html" method="post">
    <input type="submit" value="logout">
</form>
</body>
<script>
    function read(boardId){
        location.href = "http://localhost/view.php?boardId=" + argBoardId;
    }
</script>
</html>