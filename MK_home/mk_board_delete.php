<?php

    $num   = $_GET["num"];
    $page   = $_GET["page"];

    $mode = 'delete';

    $con = mysqli_connect("localhost", "root", "123456", "mkhome");

    function board_delete($con, $num, $page){

      $sql = "select * from board where num = $num";
      $result = mysqli_query($con, $sql);
      $row = mysqli_fetch_array($result);

      $copied_name = $row["file_copied"];

    	if ($copied_name)
    	{
    		$file_path = "./data/".$copied_name;
    		unlink($file_path);
      }

      $sql = "delete from board where num = $num";
      mysqli_query($con, $sql);

    }

    switch ($mode) {
      case 'delete':

        board_delete($con, $num, $page);
        echo "
    	     <script>
    	         location.href = 'mk_board_list.php?page=$page';
    	     </script>
    	   ";
        break;

      default:
        break;
    }

    mysqli_close($con);


?>
