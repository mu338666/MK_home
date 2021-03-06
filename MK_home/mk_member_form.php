<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>MK_Hannah.</title>

    <script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script src="./js/sign_up.js?ver=1"></script>
    <script src="https://t1.daumcdn.net/mapjsapi/bundle/postcode/prod/postcode.v2.js"></script>
    <script type="text/javascript">

      function check_id(){

        var sign_id = document.getElementById("sign_id_input_go");
        var sign_id_ajax = document.getElementById("sign_id_ajax");

        var check_id = /^[a-zA-Z0-9]{4,8}$/;

        if(sign_id.value === ""){
          //alert("아이디를 입력해주세요");
          sign_id_ajax.innerHTML = "<span style='color: red'>아이디를 입력해주세요.</span>";
        }else if(!sign_id.value.match(check_id)){
          //alert("형식에 맞지않습니다.");
          sign_id_ajax.innerHTML = "<span style='color: red'>형식에 맞지않습니다.</span>";
        }else{
          $.ajax({
            url: "mk_member_check_id.php", //?user_id="+sign_id.value // get은 이 방식으로 해도 잘 가져옴.
            type: "POST",
            data: {sign_id: sign_id.value}, // key: value // post는 data타입 방식을 쓰는데, 위 변수명과 넘어갈 php 파일 값을 맞춰야 한다.
            success: function(data){
              if(data === "1"){
                sign_id_ajax.innerHTML = "<span style='color: red'>중복된 아이디입니다.</span>";
              }else if(data === "0"){
                sign_id_ajax.innerHTML = "<span style='color: green'>사용 가능한 아이디입니다.</span>";
              }else{
                sign_id_ajax.innerHTML = "<span style='color: red'>error: 확인할 수 없는 데이터</span>";
              }
            }
          })
        }

      }

    </script>

    <link rel="stylesheet" href="./sign_up.css?ver=3">
    <link rel="stylesheet" href="./mk_main.css">

  </head>
  <body>

    <header>
      	<?php include "mk_header.php";?>
      </header>
  	<section>

      <form name="form1" action="./mk_member_insert.php" method="post">

        <header>

            <div id="sign_header">

              <div id="header_online">
                <span>Online Sign Up Page</span>
              </div>

              <div id="header_info">
                <span>· &nbsp고객님의 정보는 개인정보 보호정책에 의해 철저히 보호됩니다.</span>
              </div>

            </div>

        </header>


        <main>

            <div id="sign_main">

              <div id="sign_id">
                <div class="sign_name_class">
                  <span><strong>사용자 ID</strong> * </span>
                </div>
                <div id="sign_id_input">
                  <input type="text" name="user_id" id="sign_id_input_go">&nbsp
                  <button type="button" id="sign_id_input_check" onclick="check_id()">ID 중복확인</button>
                  <span id="sign_id_first"> &nbsp· 4~8자리의 영문, 숫자만 가능</span>&nbsp&nbsp
                  <span id="sign_id_ajax"></span>
                </div>

              </div>

              <div id="sign_pw">
                <div class="sign_name_class">
                  <span><strong>비밀번호</strong> * </span>
                </div>
                <div id="sign_pw_input">
                  <input type="password" name="user_pw" id="sign_pw_input_go">
                  <span id="sign_msg_pw_first"> &nbsp· 4~12자리의 영문, 숫자, 특수문자(!, @, $, %, ^, &, *)만 가능</span>
                  <span id="sign_msg_pw_second" style="visibility:hidden"> &nbsp비밀번호 형식이 맞지 않습니다.</span>
                </div>
              </div>

              <div id="sign_pw_check">
                <div class="sign_name_class">
                  <span><strong>비밀번호 확인</strong> * </span>
                </div>
                <div id="sign_pw_check_input">
                  <input type="password" id="sign_pw_check_input_go">
                  <span id="sign_msg_pw_check_first" style="visibility:hidden">&nbsp&nbsp비밀번호가 일치합니다.</span>
                  <span id="sign_msg_pw_check_second" style="visibility:hidden"> 비밀번호가 일치하지 않습니다.</span>
                </div>
              </div>

              <div id="sign_name">
                <div class="sign_name_class">
                  <span><strong>성명</strong> * </span>
                </div>
                <div id="sign_name_input">
                  <input type="text" name="user_name" id="sign_name_input_go"><span> &nbsp· 띄어쓰기 없이 입력, 반드시 실명이어야 합니다!</span>
                  <span id="sign_name_input_first" style="visibility:hidden">&nbsp&nbsp이름 형식이 일치하지 않습니다.</span>
                </div>
              </div>

              <div id="sign_email">
                <div id="sign_email_class">
                  <span><strong>E-mail</strong> * </span>
                </div>
                <div id="sign_email_class_input">
                  <input type="text" name="user_email" id="sign_email_input_go"> <strong> &nbsp메일 수신 여부</strong>
                  <span id="sign_email_input_first" style="visibility:hidden">&nbsp&nbsp이메일 형식이 일치하지 않습니다.</span>
                  <br>
                  <div id="sign_email_class_info">
                    <span> &nbsp· <strong>할인 이벤트정보</strong> 및 할인쿠폰, 관심분야 등 꼭 필요한 정보를 빠르게 받아보실 수 있습니다.</span>
                    <br>
                    <span> &nbsp· 비밀번호 분실시 E-mail로 확인해 드리니, <strong style="color: orange">정확한 E-mail주소를 기입</strong>해주세요.</span>
                  </div>

                </div>
              </div>

              <div id="sign_zip_code">
                <div class="sign_name_class">
                  <span><strong>우편 번호</strong> * </span>
                </div>
                <div id="sign_zip_code_input">
                  <!--readonly -->
                  <input type="text" id="sign_zip_code_input_go" name="zip" >&nbsp
                  <button type"button" id="sign_zip_code_button">우편번호 검색</button>
                </div>
              </div>

              <div id="sign_address">
                <div id="sign_address_class">
                  <span><strong>주소</strong> * </span>
                </div>
                <div id="sign_address_input">
                  <!--readonly -->
                  <input type="text" id="sign_address_input_first" name="addr1"><br>
                  <input type="text" id="sign_address_input_second" name="addr2">
                </div>
              </div>

              <div id="sign_phone_num">
                <div class="sign_name_class">
                  <span><strong>휴대폰 번호</strong> * </span>
                </div>
                <div id="sign_phone_num_input">
                  <input type="text" name="user_pnum" id="sign_phone_num_input_go"><span> &nbsp· '-'를 제외하고 입력해주세요.</span>
                  <span id="sign_phone_num_input_fisrt" style="visibility:hidden">&nbsp&nbsp번호 형식이 맞지 않습니다.</span>
                </div>
              </div>

            </div>

        </main>

        <footer>

            <div id="sign_footer">

              <input type="button" id="sign_up" value="Sign Up">
              <button type="button" id="sign_exit">Cancel</button>

            </div>

        </footer>

      </form>

  	</section>
  	<footer>
      	<?php include "mk_footer.php";?>
      </footer>

  </body>
</html>
