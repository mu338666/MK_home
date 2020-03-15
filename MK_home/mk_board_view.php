<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>MK_Hannah.</title>
<link rel="stylesheet" type="text/css" href="./mk_main.css">
<link rel="stylesheet" type="text/css" href="./mk_board.css">
</head>
<body>
<header>
    <?php include "mk_header.php";?>
</header>
<section>

   	<div id="board_box">
	    <h3 class="title">
			<p style="font-family: 'Cafe24Oneprettynight';">Board &nbsp>&nbsp Contents.</p>
		</h3>
<?php

  $num  = $_GET["num"];
  $page  = $_GET["page"];


  $curd_insert = "insert";
  $curd_update = "update";


	$con = mysqli_connect("localhost", "root", "123456", "mkhome");
	$sql = "select * from board where num=$num";
	$result = mysqli_query($con, $sql);

	$row = mysqli_fetch_array($result);
	$id      = $row["id"];
	$name      = $row["name"];
	$regist_day = $row["regist_day"];
	$subject    = $row["subject"];
	$content    = $row["content"];
	$file_name    = $row["file_name"];
	$file_type    = $row["file_type"];
	$file_copied  = $row["file_copied"];
	$hit          = $row["hit"];

	$content = str_replace(" ", "&nbsp;", $content);
	$content = str_replace("\n", "<br>", $content);

	$new_hit = $hit + 1;
	$sql = "update board set hit=$new_hit where num=$num";
	mysqli_query($con, $sql);
?>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?php
					if($file_name) {
						$real_name = $file_copied;
						$file_path = "./data/".$real_name;
						$file_size = filesize($file_path);

						echo "▷ 첨부파일 : $file_name ($file_size Byte) &nbsp;&nbsp;&nbsp;&nbsp;
			       		<a href='mk_board_download.php?num=$num&real_name=$real_name&file_name=$file_name&file_type=$file_type'>[저장]</a><br><br>";
			           	}
				?>
				<?=$content?>
			</li>
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='mk_board_list.php?page=<?=$page?>'">목록</button></li>
				<li><button onclick="location.href='mk_board_form.php?curd=<?=$curd_update?>&num=<?=$num?>&page=<?=$page?>'">수정</button></li>
				<li><button onclick="location.href='mk_board_delete.php?num=<?=$num?>&page=<?=$page?>'">삭제</button></li>
				<li><button onclick="location.href='mk_board_form.php?curd=<?=$curd_insert?>&num=<?=$num?>&page=<?=$page?>'">글쓰기</button></li>
		</ul>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "mk_footer.php";?>
</footer>
</body>
</html>
