$(document).ready(function(){

      var $sign_id_input_go = $("#sign_id_input_go"),
          $sign_id_input_check = $("#sign_id_input_check"),
          $sign_pw_input_go = $("#sign_pw_input_go"),
          $sign_pw_check_input_go = $("#sign_pw_check_input_go"),
          $sign_name_input_go = $("#sign_name_input_go"),
          $sign_email_input_go = $("#sign_email_input_go"),
          $sign_zip_code_button = $("#sign_zip_code_button"),
          $sign_address_input_second = $("#sign_address_input_second"),
          $sign_phone_num_input_go = $("#sign_phone_num_input_go"),
          $sign_up = $("#sign_up"),
          $sign_exit = $("#sign_exit");

      var check_id = /^[a-zA-Z0-9]{4,8}$/;
      var check_pw = /^[a-zA-Z0-9!@$%^&*]{4,12}$/;
      var check_name = /^[가-힣]{2,4}$/;
      var check_email = /^[a-z0-9_+.-]+@([a-z0-9-]+\.)+[a-z0-9]{2,4}$/;
      var check_phone_num = /^[0-9]{1,11}$/;

      //$sign_id_input_check.click(function(){

        //sign_id = document.getElementById("sign_id_input_go").value;

        //if(sign_id === ""){
      //    alert("ID를 입력해주세요.");
      //  }else {
        //  window.open("mk_member_check_id.php?user_id=" + sign_id,
        //      "IDcheck",
        //       "left=700,top=300,width=390,height=130,scrollbars=no,resizable=yes");
      //  }

    //  });

      $sign_pw_input_go.keyup(function(){

        sign_pw = document.getElementById("sign_pw_input_go").value;
        pw_msg_second = document.getElementById("sign_msg_pw_second");

        if(sign_pw.match(check_pw) || sign_pw === ""){
          pw_msg_second.style.visibility = 'hidden';
        }else {
          pw_msg_second.style.visibility = 'visible';
        }

      });

      $sign_pw_check_input_go.keyup(function(){

        sign_pw = document.getElementById("sign_pw_input_go").value;
        sign_pw_check = document.getElementById("sign_pw_check_input_go").value;
        pw_msg_first = document.getElementById("sign_msg_pw_check_first");
        pw_msg_second = document.getElementById("sign_msg_pw_check_second");

        if(sign_pw === sign_pw_check){
          pw_msg_first.style.visibility = 'visible';
          pw_msg_second.style.visibility = 'hidden';
        }else {
          pw_msg_first.style.visibility = 'hidden';
          pw_msg_second.style.visibility = 'visible';
        }

      });

      $sign_name_input_go.keyup(function(){

        sign_name = document.getElementById("sign_name_input_go").value;
        sign_name_first = document.getElementById("sign_name_input_first");

        if(sign_name.match(check_name) || sign_name === ""){
          sign_name_first.style.visibility = 'hidden';
        }else {
          sign_name_first.style.visibility = 'visible';
        }

      });

      $sign_email_input_go.keyup(function(){

        sign_email = document.getElementById("sign_email_input_go").value;
        sign_email_first = document.getElementById("sign_email_input_first");

        if(sign_email.match(check_email) || sign_email === ""){
          sign_email_first.style.visibility = 'hidden';
        }else {
          sign_email_first.style.visibility = 'visible';
        }

      });

      //우편 API

      $sign_zip_code_button.click(function(){

        sign_zip_code = document.getElementById("sign_zip_code_input_go").value;
        sign_address_input_first = document.getElementById("sign_address_input_first").value;
        sign_address_input_second = document.getElementById("sign_address_input_second").value;

        new daum.Postcode({
          oncomplete: function(data) {
      			sign_zip_code = data.zonecode; // 우편번호 (5자리)
      			sign_address_input_first = data.address;
      			sign_address_input_second = data.buildingName;
      		}
      	}).open();

        return false;
      });

      $sign_phone_num_input_go.keyup(function(){

        sign_phone_num = document.getElementById("sign_phone_num_input_go").value;
        sign_phone_num_first = document.getElementById("sign_phone_num_input_fisrt");

        if(sign_phone_num.match(check_phone_num) || sign_phone_num === ""){
          sign_phone_num_first.style.visibility = 'hidden';
        }else {
          sign_phone_num_first.style.visibility = 'visible';
        }

      });

      $sign_up.click(function(){

        sign_id = document.getElementById("sign_id_input_go").value;
      sign_pw = document.getElementById("sign_pw_input_go").value;
      sign_pw_check = document.getElementById("sign_pw_check_input_go").value;
      sign_name = document.getElementById("sign_name_input_go").value;
      sign_email = document.getElementById("sign_email_input_go").value;
      sign_zip_code = document.getElementById("sign_zip_code_input_go").value;
      sign_address_first = document.getElementById("sign_address_input_first").value;
      sign_address_second = document.getElementById("sign_address_input_second").value;
      sign_phone_num = document.getElementById("sign_phone_num_input_go").value;

     if( sign_id === "" || !sign_id.match(check_id) ){
          alert("아이디를 입력하지 않으셨거나 형식이 맞지 않습니다.");
           $sign_id_input_go.focus();
         }else if( sign_pw === ""  || !sign_pw.match(check_pw) ){
           alert("비밀번호를 입력하지 않으셨거나 형식이 맞지 않습니다.");
           $sign_pw_input_go.focus();
         }else if( sign_pw_check === "" || (sign_pw !== sign_pw_check) ){
           alert("비밀번호 확인란을 입력하지 않으셨거나 일치하지 않습니다.");
           $sign_pw_check_input_go.focus();
         }else if( sign_name === ""  || !sign_name.match(check_name) ){
           alert("이름을 입력하지 않으셨거나 형식이 맞지 않습니다.");
          $sign_name_input_go.focus();
         }else if( sign_email === "" || !sign_email.match(check_email) ){
           alert("이메일을 입력하지 않으셨거나 형식이 맞지 않습니다.");
           $sign_email_input_go.focus();
         }else if( sign_zip_code === "" ){
           alert("우편번호를 입력해주세요.");
         }else if( sign_address_first === "" ){
           alert("주소를 입력해주세요.");
         }else if( sign_address_second === "" ){
           alert("상세주소를 입력해주세요.");
           $sign_id_input_go.focus();
         }else if( sign_phone_num === "" || !sign_phone_num.match(check_phone_num)){
           alert("휴대폰번호를 입력하지 않으셨거나 형식이 맞지 않습니다.");
           $sign_phone_num_input_go.focus();
         }else{

           alert("회원 가입에 성공했습니다.");

           document.form1.submit();

           //window.location.href="./login.html";

         };



      });


    $sign_exit.click(function(){
      window.location.href="./login.html";
    });

});
