<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbconn.php";
if(!$_SESSION['loginValue']['SEMAIL']){
    location_is('','','로그인하십시오.');
    exit;
}
$query="SELECT * FROM member where email='".$_SESSION['loginValue']['SEMAIL']."'";
$result = $mysqli->query($query) or die("3:".$mysqli->error);
$rs = $result->fetch_object();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Page</title>
    <script  src="http://code.jquery.com/jquery-latest.min.js"  type="text/javascript"></script>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>
    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <div class="main">

        <section class="signup">
            <!-- <img src="images/signup-bg.jpg" alt=""> -->
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">My Page</h2>
                        <div class="single-widget-area about-me-widget text-center"  style="text-align:center;">
                            <div class="about-me-widget-thumb" style="text-align:center;">
                                <img src="<?php echo $rs->photo;?>" id='tf' alt="" style="width:200px; height:200px; object-fit:cover; object-position:top; border-radius:50%;">
                            </div>
                            <h4 class="font-shadow-into-light"><?php echo $rs->nickName;?></h4>
                            <p></p>
                        </div>
                        <div class="form-group">
                            <input type="file" class="form-input" name="tfile" id="tfile" />
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="current_password" id="current_password" placeholder="Current Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Change Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>패스워드를 변경하는 경우에만 패스워드를 입력하세요.</label>
                        </div>
                        <div class="form-group">
                            <input type="button" name="submit" id="submit" class="form-submit" value="Change Password"/>
                        </div>
                    </form>
                    <!-- <p class="loginhere">
                        Have already an account ? <a href="/member/login.php" class="loginhere-link">SAVE</a>
                    </p> -->
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
   <script src="js/main.js"></script>

<script>

$("#tfile").change(function(){

	var formData = new FormData();
    formData.append("file", $('#tfile').prop('files')[0]);
    formData.append("gubun", 'member');
    $.ajax({
        url: '/board/saveImage.php',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        type: 'POST',
        success: function (data) {
			if(data==-1){
				alert('용량이 너무크거나 이미지 파일이 아닙니다.');
				return;
			}else{
				$("#tf").attr('src', data)
			}
        }
    });


});    

$("#submit").click(function(){
    var current_password=$("#current_password").val();
    var password=$("#password").val();
    var re_password=$("#re_password").val();

    if(!current_password){
        alert('Check Your current_password');
        $('#current_password').val('').focus();
        return;
    }

    if(!password){
        alert('Check Your password');
        $('#password').val('').focus();
        return;
    }

    if(!checkPassword(password)){
        return;
    }

    if(password!=re_password){
        alert('Check Your re_password');
        $('#re_password').val('').focus();
        return;
    }

	var params = "current_password="+current_password+"&passwd="+password;

	$.ajax({
			  type: 'post'
			, url: '/member/passwdOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {

				if(data.result==1){
					alert(data.val);
					location.href='/member/mypage.php'
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
		});

});

function checkPassword(password){
    
    if(!/^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{8,25}$/.test(password)){            
        alert('숫자+영문자+특수문자 조합으로 8자리 이상 사용해야 합니다.');
        $('#password').val('').focus();
        return false;
    }    

    return true;
}


</script>   



</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>