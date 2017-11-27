<!doctype html>
<html lang="en">
<head>
    <title>Document</title>
</head>
<body>
<p>회원정보 리스트</p>


<?php

require('database.php'); // database.php 호출

$obj = new DB(); // database.php DB 객체 생성

$currentPng = isset($_GET['currentPng']) ? $_GET['currentPng'] : 1; // 현재페이지

if ($currentPng == 0) { // 맨처음 페이지가 이전페이지 버튼을 눌렀을 시 현재페이지를 1로 설정
    $currentPng = 1;
}


$result = $obj->count();

$num_rows = mysqli_num_rows($result); // 총 게시글


$list = 3; // 한 페이지 당 몇 개의 글을 보여줄지

$block = 3;//  한 블럭에 들어갈 페이지 수

$pageNum = ceil($num_rows / $list); // 총페이지

if ($currentPng > $pageNum) { // 마지막페이지에서 다음버튼을 눌렀을 시 현재페이지를 -1해준다.
    $currentPng = $currentPng - 1;
}
$blockNum = ceil($pageNum / $block); // 총블럭

$nowBlock = ceil($currentPng / $block); // 현재 블록

$startPage = ($nowBlock * $block) - ($block - 1); // 시작페이지

$lastPage = $nowBlock * $block; // 마지막페이지

// 시작페이지와 종료페이지가 총 페이지의 최소, 최대 범위를 넘지않게
if ($startPage <= 1) {
    $startPage = 1;
}

if ($pageNum < $lastPage) {
    $lastPage = $pageNum;
}

$s_point = ($currentPng - 1) * $list; // limit 시작점


?>

<table border="1" id="table">
    <tr>
        <td>회원번호</td>
        <td>아이디</td>
        <td>구분</td>
        <td>이름</td>
        <td>성별</td>
        <td>암호</td>
        <td>전화번호</td>
        <td>이메일</td>

    </tr>

    <?php


    $real_data = $obj->limit($s_point, $list); // database.php limit 실행


    while ($listCheck = mysqli_fetch_array($real_data)) { // userinfo 정보 출력
        echo "<tr>";
        echo "<td>" . $listCheck['sysid'] . "</td>";
        echo "<td>" . $listCheck['userid'] . "</td>";
        echo "<td>" . $listCheck['classification'] . "</td>";
        echo "<td>" . $listCheck['name'] . "</td>";
        echo "<td>" . $listCheck['gender'] . "</td>";
        echo "<td>" . $listCheck['password'] . "</td>";
        echo "<td>" . $listCheck['phone'] . "</td>";
        echo "<td>" . $listCheck['email'] . "</td>";
        echo "</tr>";
    }
    ?>
</table>
<a href="list.php?currentPng=<?= $startPage - 1 ?>">이전</a>

<?php


for ($i = $startPage; $i <= $lastPage; $i++) { ?>

    <a href="list.php?currentPng=<?php echo $i ?>"><?php echo $i ?></a>
<?php } ?>


<a href="list.php?currentPng=<?= $lastPage + 1 ?>">다음</a>


</body>
</html>
