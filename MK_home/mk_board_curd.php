<meta charset="utf-8">
<?php

    $curd = $_GET["curd"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $con = mysqli_connect("localhost", "root", "123456", "mkhome");

    // insert 데이터베이스
    function board_insert($con, $subject, $content){

      @session_start();
      if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
      else $userid = "";
      if (isset($_SESSION["username"])) $username = $_SESSION["username"];
      else $username = "";

    	$subject = htmlspecialchars($subject, ENT_QUOTES);
    	$content = htmlspecialchars($content, ENT_QUOTES);
      date_default_timezone_set('Asia/Seoul');
    	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    	$upload_dir = './data/';

    	$upfile_name	 = $_FILES["upfile"]["name"];
    	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    	$upfile_type     = $_FILES["upfile"]["type"];
    	$upfile_size     = $_FILES["upfile"]["size"];
    	$upfile_error    = $_FILES["upfile"]["error"];

    	if ($upfile_name && !$upfile_error)
    	{
    		$file = explode(".", $upfile_name);
    		$file_name = $file[0];
    		$file_ext  = $file[1];

    		$new_file_name = date("Y_m_d_H_i_s");
    		//$new_file_name = $new_file_name;
    		$copied_file_name = $new_file_name.".".$file_ext;
    		$uploaded_file = $upload_dir.$copied_file_name;

    		if( $upfile_size  > 1000000 ) {
    				echo("
    				<script>
    				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
    				history.go(-1)
    				</script>
    				");
    				exit;
    		}

    		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) ){
    				echo("
    					<script>
    					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
    					history.go(-1)
    					</script>
    				");
    				exit;
    		}
    	}
    	else{
    		$upfile_name      = "";
    		$upfile_type      = "";
    		$copied_file_name = "";
    	}

    	$sql = "insert into board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
    	$sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
    	$sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
    	mysqli_query($con, $sql);

    }

    // update 데이터베이스
    function board_update($con ,$subject, $content){

      $num = $_GET["num"];
      $page = $_GET["page"];

      $subject = htmlspecialchars($subject, ENT_QUOTES);
    	$content = htmlspecialchars($content, ENT_QUOTES);
      date_default_timezone_set('Asia/Seoul');
    	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    	$upload_dir = './data/';

    	$upfile_name	 = $_FILES["upfile"]["name"];
    	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
    	$upfile_type     = $_FILES["upfile"]["type"];
    	$upfile_size     = $_FILES["upfile"]["size"];
    	$upfile_error    = $_FILES["upfile"]["error"];

    	if ($upfile_name && !$upfile_error)
    	{
    		$file = explode(".", $upfile_name);
    		$file_name = $file[0];
    		$file_ext  = $file[1];

    		$new_file_name = date("Y_m_d_H_i_s");
    		//$new_file_name = $new_file_name;
    		$copied_file_name = $new_file_name.".".$file_ext;
    		$uploaded_file = $upload_dir.$copied_file_name;

    		if( $upfile_size  > 1000000 ) {
    				echo("
    				<script>
    				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
    				history.go(-1)
    				</script>
    				");
    				exit;
    		}

    		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) ){
    				echo("
    					<script>
    					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
    					history.go(-1)
    					</script>
    				");
    				exit;
    		}
    	}
    	else{
    		$upfile_name      = "";
    		$upfile_type      = "";
    		$copied_file_name = "";
    	}

      $sql = "update board set subject='$subject', content='$content', file_name='$upfile_name', file_type='$upfile_type', file_copied='$copied_file_name' ";
      $sql .= " where num=$num";
      mysqli_query($con, $sql);

    }

    switch ($curd) {

        case 'insert':

        board_insert($con, $subject, $content);
        echo "
      	   <script>
      	    location.href = 'mk_board_list.php';
      	   </script>
      	";
        break;

        case 'update':

        board_update($con ,$subject, $content);
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

  //   @session_start();
  //   if (isset($_SESSION["userid"])) $userid = $_SESSION["userid"];
  //   else $userid = "";
  //   if (isset($_SESSION["username"])) $username = $_SESSION["username"];
  //   else $username = "";
  //
  //   $subject = $_POST["subject"];
  //   $content = $_POST["content"];
  //
  // 	$subject = htmlspecialchars($subject, ENT_QUOTES);
  // 	$content = htmlspecialchars($content, ENT_QUOTES);
  //   date_default_timezone_set('Asia/Seoul');
  // 	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
  //
  // 	$upload_dir = './data/';
  //
  // 	$upfile_name	 = $_FILES["upfile"]["name"];
  // 	$upfile_tmp_name = $_FILES["upfile"]["tmp_name"];
  // 	$upfile_type     = $_FILES["upfile"]["type"];
  // 	$upfile_size     = $_FILES["upfile"]["size"];
  // 	$upfile_error    = $_FILES["upfile"]["error"];
  //
  // 	if ($upfile_name && !$upfile_error)
  // 	{
  // 		$file = explode(".", $upfile_name);
  // 		$file_name = $file[0];
  // 		$file_ext  = $file[1];
  //
  // 		$new_file_name = date("Y_m_d_H_i_s");
  // 		//$new_file_name = $new_file_name;
  // 		$copied_file_name = $new_file_name.".".$file_ext;
  // 		$uploaded_file = $upload_dir.$copied_file_name;
  //
  // 		if( $upfile_size  > 1000000 ) {
  // 				echo("
  // 				<script>
  // 				alert('업로드 파일 크기가 지정된 용량(1MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
  // 				history.go(-1)
  // 				</script>
  // 				");
  // 				exit;
  // 		}
  //
  // 		if (!move_uploaded_file($upfile_tmp_name, $uploaded_file) )
  // 		{
  // 				echo("
  // 					<script>
  // 					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
  // 					history.go(-1)
  // 					</script>
  // 				");
  // 				exit;
  // 		}
  // 	}
  // 	else
  // 	{
  // 		$upfile_name      = "";
  // 		$upfile_type      = "";
  // 		$copied_file_name = "";
  // 	}
  //
	// //$con = mysqli_connect("localhost", "root", "123456", "mkhome"); // 파일집단을 가지고있는 폴더, 주소를 가지고있음.
  // // 그 db객체에 접근할수있는 주소, 포인터, 핸들러, 디스크립터, 저장장소가 있다. 다 같은말.
  //
	// $sql = "insert into board (id, name, subject, content, regist_day, hit,  file_name, file_type, file_copied) ";
	// $sql .= "values('$userid', '$username', '$subject', '$content', '$regist_day', 0, ";
	// $sql .= "'$upfile_name', '$upfile_type', '$copied_file_name')";
	// mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행

	// mysqli_close($con);                // DB 연결 끊기
  //
	// echo "
	//    <script>
	//     location.href = 'mk_board_list.php';
	//    </script>
	// ";
?>
