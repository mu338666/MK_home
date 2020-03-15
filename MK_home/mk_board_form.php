<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>MK_Hannah.</title>
<link rel="stylesheet" type="text/css" href="./mk_main.css">
<link rel="stylesheet" type="text/css" href="./mk_board.css">

<script>
  function check_input() {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>
<body>
<header>
    <?php include "mk_header.php";?>
</header>
<?php

    if ( !$userid ){
        echo("
          <script>
          alert('게시판 글쓰기는 로그인 후 이용해 주세요!');
          history.go(-1)
          </script>
        ");
        exit;
    }

    $curd = $_GET["curd"];

    if($curd === "insert"){

      $subject = "";
      $content = "";

      $gp = "";

    }elseif($curd === "update"){

      $num  = $_GET["num"];
    	$page = $_GET["page"];

    	$con = mysqli_connect("localhost", "root", "123456", "mkhome");
    	$sql = "select * from board where num=$num";
    	$result = mysqli_query($con, $sql);
    	$row = mysqli_fetch_array($result);

    	$name       = $row["name"];
    	$subject    = $row["subject"];
    	$content    = $row["content"];
    	$file_name  = $row["file_name"];

      $gp = "&num=$num&page=$page";

    }

?>

<section>

   	<div id="board_box">
	    <h3 id="board_title">
	    		<p style="font-family: 'Cafe24Oneprettynight';">Board &nbsp>&nbsp Writing.</p>
		</h3>
	    <form  name="board_form" method="post" action="mk_board_curd.php?curd=<?=$curd?><?=$gp?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$username?></span>
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2">
              <input name='subject' type='text' value="<?=$subject?>">
            </span>
	    		</li>
	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
                 <textarea name='content'><?=$content?></textarea>
	    			</span>
	    		</li>
	    		<li>
			        <span class="col1"> 첨부 파일</span>
			        <span class="col2">
                <!--<input type="file" name="upfile">-->
                <?php

                  if($curd === "insert"){
                    echo "<input type='file' name='upfile'>";
                  }elseif($curd === "update"){
                    echo "<input type='file' name='upfile' id='aa'>
                          <label for='aa'>◀$file_name</label>";
                  }

                ?>
              </span>
			    </li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" onclick="location.href='mk_board_list.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "mk_footer.php";?>
</footer>
</body>
</html>
