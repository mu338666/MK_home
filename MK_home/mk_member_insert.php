<?php
    $id   = $_POST["user_id"];
    $pass = $_POST["user_pw"];
    $name = $_POST["user_name"];
    $email  = $_POST["user_email"];
    $pnum = $_POST["user_pnum"];

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장


    $con = mysqli_connect("localhost", "root", "123456", "mkhome");

	$sql = "insert into members(id, pass, name, email, pnum, regist_day) ";
	$sql .= "values('$id', '$pass', '$name', '$email', '$pnum','$regist_day')";

	mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'mk_index.php';
	      </script>
	  ";
?>
