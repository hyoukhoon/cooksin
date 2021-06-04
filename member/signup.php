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
                        <h2 class="form-title">Create account</h2>
                        <div class="form-group">
                            <input type="text" class="form-input" name="name" id="name" placeholder="Your Name"/>
                            <span id="alertName"></span>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="re_password" id="re_password" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" name="agree-term" id="agree-term" value="1" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group">
                            <input type="button" name="submit" id="submit" class="form-submit" value="Sign up"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        Have already an account ? <a href="/member/login.php" class="loginhere-link">Login here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
   <script src="js/main.js"></script>

<script>
$("#submit").click(function(){
    var name=$("#name").val();
    var email=$("#email").val();
    var password=$("#password").val();
    var re_password=$("#re_password").val();

    if(!name){
        alert('Check Your Name');
        $('#name').val('').focus();
        return;
    }

    if(!email){
        alert('Check Your email');
        $('#email').val('').focus();
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

    if($("input:checkbox[name=agree-term]").is(":checked") != true) {
        alert('Please Check Term');
        return;
    }

	var params = "name="+name+"&email="+email+"&passwd="+password;

	$.ajax({
			  type: 'post'
			, url: 'signupOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {

				if(data.result==1){
					alert(data.val);
					location.href='/member/login.php'
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