<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
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
            <div class="container">
                <div class="signup-content">
                    <form method="POST" id="signup-form" class="signup-form">
                        <h2 class="form-title">LOGIN</h2>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                            <span toggle="#password" class="zmdi zmdi-eye field-icon toggle-password"></span>
                        </div>
                        <div class="form-group">
                            <input type="button" name="submit" id="submit" class="form-submit" value="LOGIN"/>
                        </div>
                    </form>
                    <p class="loginhere">
                        account ? <a href="/member/signup.php" class="loginhere-link">Signup here</a>
                    </p>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="js/main.js"></script>

<script>
$("#submit").click(function(){
	var email=$("#email").val();
	var passwd=$("#password").val();


	var params = "email="+email+"&passwd="+passwd;

	$.ajax({
			  type: 'post'
			, url: 'loginOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {

				if(data.result==1){
					alert(data.val);
					location.href='/';
				}else if(data.result==-1){
					alert(data.val);
				}else{
					alert('다시 시도하세요');
				}
			  }
		});

});
</script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>