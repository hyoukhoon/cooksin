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
                            <li class="breadcrumb-item active" aria-current="page"><?php echo multi_is($multi);?></li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Breadcumb Area End ****** -->

    <!-- ****** child Area Start ****** -->
    <section class="archive-area section_padding_80">
        <div class="container">
            <div class="row">

                        <div class="col-12 col-md-12 item">
                        <div class="contact-form wow fadeInUpBig" data-wow-delay="0.6s">
                            <h2 class="contact-form-title mb-30"><?php echo multi_is($multi);?> 글쓰기</h2>
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
    </section>
    <!-- ****** child Area End ****** -->

 
    <!-- ****** Our Creative Portfolio Area End ****** -->

<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php";
?>