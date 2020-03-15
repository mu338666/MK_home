<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>MK_Hannah.</title>
<link rel="stylesheet" href="./mk_main.css">
<link rel="stylesheet" type="text/css" href="./mk_login.css?ver=2">
<script type="text/javascript">
function check_input()
{
		if (!document.login_form.user_id.value)
		{
				alert("아이디를 입력하세요.");
				document.login_form.user_id.focus();
				return;
		}

		if (!document.login_form.user_pw.value)
		{
				alert("비밀번호를 입력하세요.");
				document.login_form.user_pw.focus();
				return;
		}
		document.login_form.submit();
}
</script>
</head>
<body>
	<header>
    	<?php include "mk_header.php";?>
    </header>
	<section>

        <div id="main_content">
      		<div id="login_box">
	    		<div id="login_title">
		    		<span>Login Page</span>
	    		</div>
	    		<div id="login_form">
          		<form  name="login_form" method="post" action="mk_login.php">
                  	<ul>
                    <li><input type="text" name="user_id" placeholder="&nbsp&nbsp아이디" ></li>
                    <li><input type="password" id="pass" name="user_pw" placeholder="&nbsp&nbsp비밀번호" ></li> <!-- pass -->
                  	</ul>
                  	<div id="login_btn">
                      <button type="button" onclick="check_input()">Login</button>
                  	</div>
           		</form>
        		</div> <!-- login_form -->
    		</div> <!-- login_box -->
        </div> <!-- main_content -->
	</section>
	<footer>
    	<?php include "mk_footer.php";?>
    </footer>
</body>
</html>
