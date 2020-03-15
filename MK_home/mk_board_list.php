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
	    <h3>
	    	<p style="font-family: 'Cafe24Oneprettynight';">Board &nbsp>&nbsp List.</p>
		</h3>
	    <ul id="board_list">
				<li>
					<span class="col1">번호</span>
					<span class="col2">제목</span>
					<span class="col3">글쓴이</span>
					<span class="col4">첨부</span>
					<span class="col5">등록일</span>
					<span class="col6">조회</span>
				</li>
<?php
	if (isset($_GET["page"])) // 넘어온 get방식에 키값 page가 세팅되어있느냐. 없으면 post. 굳이 이렇게 쓰는것은 어디선가 get방식으로 보내겠다는 뜻.
		$page = $_GET["page"];
	else
		$page = 1;

	$con = mysqli_connect("localhost", "root", "123456", "mkhome");
	$sql = "select * from board order by num desc";
	$result = mysqli_query($con, $sql);
	$total_record = mysqli_num_rows($result); // 전체 글 수 // 레코드셋 개수체크함수

	$scale = 5;

	// 전체 페이지 수($total_page) 계산
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;

	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;

	$number = $total_record - $start;

   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysqli_data_seek($result, $i);
      // 가져올 레코드로 위치(포인터) 이동
      $row = mysqli_fetch_array($result);
      // 하나의 레코드 가져오기
  	  $num         = $row["num"];
  	  $id          = $row["id"];
  	  $name        = $row["name"];
  	  $subject     = $row["subject"];
      $regist_day  = $row["regist_day"];
      $hit         = $row["hit"];
      if ($row["file_name"])
      	$file_image = "<img src='./img/file.gif'>";
      else
      	$file_image = " ";
?>
				<li>
					<span class="col1"><?=$number?></span>
					<span class="col2"><a href="mk_board_view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></span>
					<span class="col3"><?=$name?></span>
					<span class="col4"><?=$file_image?></span>
					<span class="col5"><?=$regist_day?></span>
					<span class="col6"><?=$hit?></span>
				</li>
<?php
   	   $number--;
   }
   mysqli_close($con);

?>
	    	</ul>
			<ul id="page_num">
<?php
	if ($total_page>=2 && $page >= 2) // 현재 페이지가 2보다 크고 페이지가 2 이상일때
	{
		$new_page = $page-1;
		echo "<li><a href='mk_board_list.php?page=$new_page'>◀ prev</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";

   	// 게시판 목록 하단에 페이지 링크 번호 출력
   	for ($i=1; $i<=$total_page; $i++)
   	{
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<li><b> $i </b></li>";
		}
		else
		{
			echo "<li><a href='mk_board_list.php?page=$i'> $i </a><li>";
		}
   	}
   	if ($total_page>=2 && $page != $total_page)
   	{
		$new_page = $page+1;
		echo "<li> <a href='mk_board_list.php?page=$new_page'>next ▶</a> </li>";
	}
	else
		echo "<li>&nbsp;</li>";
?>
</ul> <!-- page num -->
			<ul class="buttons">
				<li><button onclick="location.href='mk_board_list.php'">목록</button></li>
				<li>
<?php
    if($userid) {
      $curd = 'insert';
?>
					<button onclick="location.href='mk_board_form.php?curd=<?=$curd?>'">글쓰기</button>
<?php
	} else {
?>
					<a href="javascript:alert('로그인 후 이용해 주세요!')"><button>글쓰기</button></a>
<?php
	}
?>
				</li>
			</ul>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "mk_footer.php";?>
</footer>
</body>
</html>
