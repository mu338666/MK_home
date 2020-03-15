<?php
      $id = $_POST["sign_id"]; // 주의

      $con = mysqli_connect("localhost", "root", "123456", "mkhome");
      $sql = "select * from members where id='$id'";

      $result = mysqli_query($con, $sql);
      $num_record = mysqli_num_rows($result);

      if($num_record){
        echo "1";
      }else{
        echo "0";
      }

      mysqli_close($con);
?>
