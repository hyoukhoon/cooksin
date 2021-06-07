<?php 
include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php";

if(!$_SESSION['loginValue']['SEMAIL']){
    location_is('','','로그인하십시오.');
    exit;
}

$multi=$_GET["multi"];
?>


    <!-- ****** Breadcumb Area Start ****** -->
    <div class="breadcumb-area" style="background-image: url(/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2><?php echo multi_is($multi);?></h2>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="breadcumb-nav">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="fa fa-home" aria-hidden="true"></i> Home</a></li>
                            <li class="breadcrumb-item"><a href="#"><?php echo multi_is($multi);?></a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="#">Write</a></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Breadcumb Area End ****** -->

    <!-- ****** Contatc Area Start ****** -->
    <div class="contact-area section_padding_80">
        <div class="container">

            <!-- Contact Form  -->
            <div class="contact-form-area">
                <div class="row">

                    <div class="col-12 col-md-12 item">
                        <div class="contact-form wow fadeInUpBig" data-wow-delay="0.6s">
                            <h2 class="contact-form-title mb-30"><?php echo multi_is($multi);?></h2>
                            <!-- Contact Form -->
                            <form action="#" method="post">
                            <input type="hidden" name="multi" id="multi" value="<?php echo $multi;?>">
                            <input type="hidden" name="imgUrl" id="imgUrl" value="">
                            <input type="hidden" name="attachFile" id="attachFile" value="">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="subject" placeholder="제목">
                                </div>
                                <div class="form-group">
                                    <input type="text" class="form-control" id="childName" placeholder="태그">
                                </div>
                                <div class="form-group">
                                    <div id="summernote"></div>
                                </div>
                                <div class="form-group">
                                    <div id="attach_site">
                                        <div id="attachFiles">
                                        </div>
                                        <input type="file" multiple class="form-input" name="afile" id="afile" />
                                    </div>
                                </div>
                                <button type="button" class="btn contact-btn"  onclick="saveUp();">WRITE</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- ****** Contact Area End ****** -->

    
    </div>
    <!-- ****** Our Creative Portfolio Area End ****** -->

    <!-- ****** Footer Social Icon Area Start ****** -->
    <div class="social_icon_area clearfix">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="footer-social-area d-flex">
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i><span>facebook</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i><span>Twitter</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i><span>GOOGLE+</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i><span>linkedin</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i><span>Instagram</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i><span>VIMEO</span></a>
                        </div>
                        <div class="single-icon">
                            <a href="#"><i class="fa fa-youtube-play" aria-hidden="true"></i><span>YOUTUBE</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Footer Social Icon Area End ****** -->

    <!-- ****** Footer Menu Area Start ****** -->
    
<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php";
?>

    <!-- ****** Footer Menu Area End ****** -->
<script>
    $(document).ready(function () {
    var $summernote = $('#summernote').summernote({
		codeviewFilter: false,
		codeviewIframeFilter: true,
        lang: 'ko-KR',
        height: 800,
        callbacks: {
            onImageUpload: function (files) {
				for(var i=0; i < files.length; i++) {
					if(i>20){
						alert('20개까지만 등록할 수 있습니다.');
						return;
					}
                }
                for(var i=0; i < files.length; i++) {
					if(i>20){
						alert('20개까지만 등록할 수 있습니다.');
						return;
					}
				sendFile($summernote, files[i]);
			  } 
                
            }
        }
    });
});

function sendFile($summernote, file) {
    var formData = new FormData();
    formData.append("file", file);
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
				$summernote.summernote('insertImage', data, function ($image) {
					$image.attr('src', data);
					$image.attr('class', 'childImg');
				});
				var imgUrl=$("#imgUrl").val();
				if(imgUrl){
					imgUrl=imgUrl+",";
				}
				$("#imgUrl").val(imgUrl+data);
			}
        }
    });

}



function saveUp(){

		var subject=$("#subject").val();
		var childName=$("#childName").val();
        var multi=$("#multi").val();
		var imgUrl=$("#imgUrl").val();
		var content=$('#summernote').summernote('code');

		if(!subject){
			alert("제목을 입력하세요");
			return;
		}

		if ($('#summernote').summernote('isEmpty')) {
		  alert('내용을 입력하세요.');
		  return;
		}



		var params = "subject="+subject+"&content="+content+"&childName="+childName+"&imgUrl="+imgUrl+"&multi="+multi;
		//console.log(params);

		$.ajax({
			  type: 'post'
			, url: 'saveUpOk.php'
			,data : params
			, dataType : 'json'
			, success: function(data) {
				//console.log(data.result);

				if(data.result==1){
					alert('등록됐습니다.');
					location.href='/lis.php?multi=<?php echo $multi;?>'
				}else if(data.result==-1){
					alert(data.val);
					return;
				}else{
					alert('다시 시도해 주십시오.');
					return;
				}
			  }
		});	

}

$("#afile").change(function(){

var formData = new FormData();
var files = $('#afile').prop('files');
for(var i=0; i < files.length; i++) {
    attachFile(files[i]);
}


});   

function attachFile(file) {
    var formData = new FormData();
    formData.append("file", file);
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
                var img="<img src='"+data+"' width='50'><br>";
                $("#attachFiles").append(img);
				
                //$summernote.summernote('insertImage', data, function //($image) {
				//	$image.attr('src', data);
				//	$image.attr('class', 'childImg');
				//});

				var attachFie=$("#attachFie").val();
				if(attachFie){
					attachFie=attachFie+",";
				}
				$("#attachFie").val(attachFie+data);
			}
        }
    });

}

</script>
