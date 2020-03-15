<?php

    $curd = "insert";

    session_start();

    if (isset($_SESSION["userid"])){
      $userid = $_SESSION["userid"];
    }else {
      $userid = "";
    }


    if (isset($_SESSION["username"])) {
      $username = $_SESSION["username"];
    }else {
      $username = "";
    }
?>
<div id="img_sprite">
  <img src="./image/img_sprite_1.png" width="150">
</div>

<h1>
  <img src="./image/Hannah.png" alt="Hannah" width="70" height="70">
  <a href="mk_index.php">Hannah.</a>
</h1>


<?php
    if(!$userid) {
?>
    <div id="div_sign_up">
      <a href="mk_member_form.php">Sign_up</a>&nbsp ｜ &nbsp<a href="mk_login_form.php">Login</a>
    </div>
<?php
    } else {

                $logged = $username."(".$userid.")님, 환영합니다.";
?>
    <div id="div_profile">
      <p><?=$logged?></p>
      <div id="div_profile_second">
        <a href="mk_logout.php">Logout</a>&nbsp ｜ &nbsp<a href="mk_member_modify_form.php">Profile Edit</a>
<?php
    if($userid==="admin") {
?>
        ｜&nbsp<a href="mk_admin.php">Admin</a>
<?php
    }
?>
      </div>
    </div>

                <!-- <li><?=$logged?> </li>
                <li> | </li>
                <li><a href="logout.php">로그아웃(12장)</a> </li>
                <li> | </li>
                <li><a href="member_modify_form.php">정보 수정(12장)</a></li> -->
<?php
    }
?>


<div id="div-search">
  <input type="text">
  <button>Search</button>
</div>

<nav id="Hannah-nav">

  <ul id="nav-ul">
    <li><a href="mk_index.php">Home</a></li>
    <li>&nbsp&nbsp<a href="#">About</a></li>
    <li>&nbsp&nbsp<a href="#">News</a></li>
    <li>&nbsp&nbsp<a href="#">Review</a></li>
    <li>&nbsp&nbsp<a href="mk_board_form.php?curd=<?=$curd?>">Board</a></li>
  </ul>

</nav>
