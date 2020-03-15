<?php

include $_SERVER['DOCUMENT_ROOT']."/MK_home/mk_db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/MK_home/mk_create_table.php";

create_table($conn,'qna');//가입인사게시판테이블생성

define('SCALE', 10);
//*****************************************************
$sql=$result=$total_record=$total_page=$start="";
$row="";
$memo_id=$memo_num=$memo_date=$memo_nick=$memo_content="";
$total_record=0;
//*****************************************************

if(isset($_GET["mode"])&&$_GET["mode"]=="search"){
  //제목, 내용, 아이디
  $find = test_input($_POST["find"]);
  $search = test_input($_POST["search"]);
  $q_search = mysqli_real_escape_string($conn, $search);
  $sql="SELECT * from `qna` where $find like '%$q_search%' order by num desc;";
}else{
  // 답변형 게시판의 핵심 쿼리문.
  $sql="SELECT * from `qna` order by group_num desc, ord asc;";
}

$result=mysqli_query($conn,$sql);
$total_record=mysqli_num_rows($result);
$total_page=($total_record % SCALE == 0 )?
($total_record/SCALE):(ceil($total_record/SCALE));

//2.페이지가 없으면 디폴트 페이지 1페이지
if(empty($_GET['page'])){
  $page=1;
}else{
  $page=$_GET['page'];
}

//3.현재페이지 시작번호계산함.
$start=($page -1) * SCALE;
//4. 리스트에 보여줄 번호를 최근순으로 부여함.
$number = $total_record - $start;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="./mk_main.css">
    <link rel="stylesheet" href="./mk_greet.css?ver=1">
    <script type="text/javascript" src="./mk_list_member_form.js"></script>
    <title></title>
  </head>
  <body>
    <div id="wrap">
      <header>
        <?php include "mk_header.php"; ?>
      </header>

      <div id="content">
       <div id="col2">

         <form name="board_form" action="mk_list.php?mode=search" method="post">
           <div id="list_search">
             <div id="list_search1">총 <?=$total_record?>개의 게시물이 있습니다.</div>
             <div id="list_search2"> <img src="./img/select_search.gif"></div>
             <div id="list_search3">
               <select  name="find">
                 <option value="subject">제목</option>
                 <option value="content">내용</option>
                 <option value="id">아이디</option>
               </select>
             </div><!--end of list_search3  -->
             <div id="list_search4"><input type="text" name="search"></div>
             <div id="list_search5"> <input type="image" src="./img/list_search_button.gif"></div>
           </div><!--end of list_search  -->
         </form>
         <div id="clear"></div>
         <div id="list_top_title">
           <ul>
             <li id="list_title1"><img src="./img/list_title1.gif"></li>
             <li id="list_title2"><img src="./img/list_title2.gif"></li>
             <li id="list_title3"><img src="./img/list_title3.gif"></li>
             <li id="list_title4"><img src="./img/list_title4.gif"></li>
             <li id="list_title5"><img src="./img/list_title5.gif"></li>
           </ul>
         </div><!--end of list_top_title  -->

         <div id="list_content">

         <?php
          for ($i = $start; $i < $start+SCALE && $i<$total_record; $i++){
            mysqli_data_seek($result,$i);
            $row=mysqli_fetch_array($result);
            $num=$row['num'];
            $id=$row['id'];
            $name=$row['name'];
            $hit=$row['hit'];
            $date= substr($row['regist_day'],0,10);
            $subject=$row['subject'];
            $subject=str_replace("\n", "<br>",$subject);
            $subject=str_replace(" ", "&nbsp;",$subject);
            $depth=(int)$row['depth'];//공간을 몆칸을 띄어야할지 결정하는 숫자임
            $space="";
            for($j=0;$j<$depth;$j++){
              $space="&nbsp;&nbsp;".$space;
            }
        ?>
            <div id="list_item">
              <div id="list_item1"><?=$number?></div>
              <div id="list_item2">
                  <a href="./mk_view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$space.$subject?></a>
              </div>
              <div id="list_item3"><?=$id?></div>
              <div id="list_item4"><?=$date?></div>
              <div id="list_item5"><?=$hit?></div>
            </div><!--end of list_item -->
            <div id="memo_content"><?=$memo_content?></div>
        <?php
            $number--;
         }//end of for
        ?>

        <div id="page_button">
          <div id="page_num">이전◀ &nbsp;&nbsp;&nbsp;&nbsp;
          <?php
            for ($i=1; $i <= $total_page ; $i++) {
              if($page==$i){
                echo "<b>&nbsp;$i&nbsp;</b>";
              }else{
                echo "<a href='./mk_list.php?page=$i'>&nbsp;$i&nbsp;</a>";
              }
            }
          ?>
          &nbsp;&nbsp;&nbsp;&nbsp;▶ 다음
          <br><br><br><br><br><br><br>
        </div><!--end of page num -->
        <div id="button">
          <!--목록 버튼  -->
          <a href="./mk_list.php?page=<?=$page?>"><img src="./img/list.png" alt=""></a>
          <?php
            //세션아디가 있으면 글쓰기 버튼을 보여줌.
            if(!empty($_SESSION['userid'])){
            echo '<a href="mk_write_edit_form.php"><img src="./img/write.png"></a>';
            }
          ?>
        </div><!--end of button -->
      </div><!--end of page button -->
      </div><!--end of list content -->

      </div><!--end of col2  -->
      </div><!--end of content -->
      <footer>
        <?php include "mk_footer.php"; ?>
      </footer>
    </div><!--end of wrap  -->
  </body>
</html>
