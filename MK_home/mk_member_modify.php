<?php
    $id = $_GET["id"];

    $pass = $_POST["user_pw"];
    $name = $_POST["user_name"];
    $email  = $_POST["user_email"];
    $pnum  = $_POST["user_pnum"];

    $con = mysqli_connect("localhost", "root", "123456", "mkhome");
    $sql = "update members set pass='$pass', name='$name' , email='$email' , pnum='$pnum'";
    $sql .= " where id='$id'";
    mysqli_query($con, $sql);

    $sql1 = "select * from members where id='$id'";
    $result = mysqli_query($con1, $sql1);

    $row = mysqli_fetch_array($result);

    mysqli_close($con);

    session_start();
    $_SESSION["userid"] = $row["id"];
    $_SESSION["username"] = $row["name"];

    echo("
      <script>
        location.href = 'mk_index.php';
      </script>
    ");

?>
