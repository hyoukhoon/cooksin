<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php";

$num=$_GET['num'];

$que="update cboard set cnt=cnt+1 where num='".$num."'";
$sql=$mysqli->query($que) or die($mysqli->error);

$query="SELECT *,(select count(*) from cboard_memo m where m.pa_num=c.num) as reply_cnt  FROM cboard c where num='".$num."' $where";
$result = $mysqli->query($query) or die("3:".$mysqli->error);
$rs = $result->fetch_object();


?>
<style>
 .childImg {
	max-width:100%;
    padding-bottom:30px;
    margin-top:30px;
}
</style>
    <!-- ****** Breadcumb Area Start ****** -->
    <div class="breadcumb-area" style="background-image: url(/img/bg-img/breadcumb.jpg);">
        <div class="container h-100">
            <div class="row h-100 align-items-center">
                <div class="col-12">
                    <div class="bradcumb-title text-center">
                        <h2>View</h2>
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
                            <li class="breadcrumb-item"><a href="#">Child</a></li>
                            <li class="breadcrumb-item active" aria-current="page">View</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ****** Breadcumb Area End ****** -->

    <!-- ****** Single Blog Area Start ****** -->
    <section class="single_blog_area section_padding_80">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <div class="row no-gutters">

                        <!-- Single Post Share Info -->
                        <!-- <div class="col-2 col-sm-1">
                            <div class="single-post-share-info mt-100">
                                <a href="#" class="facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#" class="twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#" class="googleplus"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                <a href="#" class="instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#" class="pinterest"><i class="fa fa-pinterest" aria-hidden="true"></i></a>
                            </div>
                        </div> -->

                        <!-- Single Post -->
                        <div class="col-10 col-sm-11">
                            <div class="single-post">
                                <!-- Post Thumb -->
                                <!-- <div class="post-thumb">
                                    <img src="img/blog-img/10.jpg" alt="">
                                </div> -->
                                <!-- Post Content -->
                                <div class="post-content">
                                    <div class="post-meta d-flex">
                                        <div class="post-author-date-area d-flex">
                                            <!-- Post Author -->
                                            <div class="post-author">
                                                <a href="#">By <?php echo $rs->name;?></a>
                                            </div>
                                            <!-- Post Date -->
                                            <div class="post-date">
                                                <a href="#"><?php echo date("Y.m.d",strtotime($rs->reg_date));?></a>
                                            </div>
                                        </div>
                                        <!-- Post Comment & Share Area -->
                                        <div class="post-comment-share-area d-flex">
                                            <!-- Post Favourite -->
                                            <div class="post-favourite">
                                                <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> <?php echo $rs->good;?></a>
                                            </div>
                                            <!-- Post Comments -->
                                            <div class="post-comments">
                                                <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo $rs->reply_cnt;?></a>
                                            </div>
                                            <!-- Post Share -->
                                            <!-- <div class="post-share">
                                                <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                            </div> -->
                                        </div>
                                    </div>
                                    <a href="#">
                                        <h2 class="post-headline"><?php echo $rs->subject;?></h2>
                                    </a>
                                    <div>
                                        <?php echo $rs->content;?>
                                    </div>
                                    <div>
                                        <button class="btn btn-block btn-primary"><i class="fa fa-thumbs-up">Like</i> </button> 
                                    </div>
                                    <div style="text-align:center; padding:20px;">

                                        <button class="btn btn-success" type="button" onclick="history.back();">List</button> 
                                        <?php
                                            if($_SESSION['loginValue']['SEMAIL']==$rs->email){
                                        ?>
                                            <button type="button" class="btn btn-warning">Modify</button> 
                                            <button type="button" class="btn btn-danger">Delete</button> 
                                        <?php }?>

                                    </div>
                                </div>
                            </div>

                            <!-- Tags Area -->
                            <!-- <div class="tags-area">
                                <a href="#">Multipurpose</a>
                                <a href="#">Design</a>
                                <a href="#">Ideas</a>
                            </div> -->

                            <!-- Related Post Area -->
<?PHP
    $query2="SELECT *,(select count(*) from cboard_memo m where m.pa_num=c.num) as reply_cnt  FROM cboard c where email='".$rs->email."' and num not in (".$num.") order by num desc limit 5";
    $result2 = $mysqli->query($query2) or die("3:".$mysqli->error);
    while($rs2 = $result2->fetch_object()){
        $rsc2[]=$rs2;
    }
?>                            
                            <div class="related-post-area section_padding_50">
                                <h4 class="mb-30">Related post</h4>

                                <div class="related-post-slider owl-carousel">
                                <?php
                                    foreach($rsc2 as $p2){
                                        $img2=explode(",",$p2->file_list);
                                ?>
                                    <!-- Single Related Post-->
                                    <div class="single-post">
                                        <!-- Post Thumb -->
                                        <div class="post-thumb">
                                            <img src="<?php echo $img2[0]?>" alt="">
                                        </div>
                                        <!-- Post Content -->
                                        <div class="post-content">
                                            <div class="post-meta d-flex">
                                                <div class="post-author-date-area d-flex">
                                                    <!-- Post Author -->
                                                    <div class="post-author">
                                                        <a href="#">By <?php echo $p2->name;?></a>
                                                    </div>
                                                    <!-- Post Date -->
                                                    <div class="post-date">
                                                        <a href="#"><?php echo date("Y.m.d",strtotime($p2->reg_date));?></a>
                                                    </div>
                                                </div>
                                            </div>
                                            <a href="#">
                                                <h6><?php echo $p2->subject;?></h6>
                                            </a>
                                        </div>
                                    </div>
                                <?php }?>
                                    
                                </div>
                            </div>

                            <!-- Comment Area Start -->
                            <div class="comment_area section_padding_50 clearfix">
                                <h4 class="mb-30">2 Comments</h4>

                                <ol>
                                    <!-- Single Comment Area -->
                                    <li class="single_comment_area">
                                        <div class="comment-wrapper d-flex">
                                            <!-- Comment Meta -->
                                            <div class="comment-author">
                                                <img src="img/blog-img/17.jpg" alt="">
                                            </div>
                                            <!-- Comment Content -->
                                            <div class="comment-content">
                                                <span class="comment-date text-muted">27 Aug 2018</span>
                                                <h5>Brandon Kelley</h5>
                                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora.</p>
                                                <a href="#">Like</a>
                                                <a class="active" href="#">Reply</a>
                                            </div>
                                        </div>
                                        <ol class="children">
                                            <li class="single_comment_area">
                                                <div class="comment-wrapper d-flex">
                                                    <!-- Comment Meta -->
                                                    <div class="comment-author">
                                                        <img src="img/blog-img/18.jpg" alt="">
                                                    </div>
                                                    <!-- Comment Content -->
                                                    <div class="comment-content">
                                                        <span class="comment-date text-muted">27 Aug 2018</span>
                                                        <h5>Brandon Kelley</h5>
                                                        <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora.</p>
                                                        <a href="#">Like</a>
                                                        <a class="active" href="#">Reply</a>
                                                    </div>
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="single_comment_area">
                                        <div class="comment-wrapper d-flex">
                                            <!-- Comment Meta -->
                                            <div class="comment-author">
                                                <img src="img/blog-img/19.jpg" alt="">
                                            </div>
                                            <!-- Comment Content -->
                                            <div class="comment-content">
                                                <span class="comment-date text-muted">27 Aug 2018</span>
                                                <h5>Brandon Kelley</h5>
                                                <p>Neque porro qui squam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit, sed quia non numquam eius modi tempora.</p>
                                                <a href="#">Like</a>
                                                <a class="active" href="#">Reply</a>
                                            </div>
                                        </div>
                                    </li>
                                </ol>
                            </div>

                            <!-- Leave A Comment -->
                            <div class="leave-comment-area section_padding_50 clearfix">
                                <div class="comment-form">
                                    <h4 class="mb-30">Leave A Comment</h4>

                                    <!-- Comment Form -->
                                    <form action="#" method="post">
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="contact-name" placeholder="Name">
                                        </div>
                                        <div class="form-group">
                                            <input type="email" class="form-control" id="contact-email" placeholder="Email">
                                        </div>
                                        <div class="form-group">
                                            <input type="text" class="form-control" id="contact-website" placeholder="Website">
                                        </div>
                                        <div class="form-group">
                                            <textarea class="form-control" name="message" id="message" cols="30" rows="10" placeholder="Message"></textarea>
                                        </div>
                                        <button type="submit" class="btn contact-btn">Post Comment</button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
<?php
    $query3="SELECT * FROM member where email='".$rs->email."'";
    $result3 = $mysqli->query($query3) or die("3:".$mysqli->error);
    $rs3 = $result3->fetch_object();
?>
                <!-- ****** Blog Sidebar ****** -->
                <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                    <div class="blog-sidebar mt-5 mt-lg-0">
                        <!-- Single Widget Area -->
                        <div class="single-widget-area about-me-widget text-center">
                            <div class="widget-title">
                                <h6>About Me</h6>
                            </div>
                            <div class="about-me-widget-thumb">
                                <img src="<?php echo $rs3->photo;?>" alt="">
                            </div>
                            <h4 class="font-shadow-into-light"><?php echo $rs3->nickName;?></h4>
                            
                        </div>

                        <!-- Single Widget Area -->
                        <div class="single-widget-area subscribe_widget text-center">
                            <div class="widget-title">
                                <h6>Subscribe &amp; Follow</h6>
                            </div>
                            <div class="subscribe-link">
                                <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-google" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                                <a href="#"><i class="fa fa-vimeo" aria-hidden="true"></i></a>
                            </div>
                        </div>

                        <!-- Single Widget Area -->
                        <div class="single-widget-area popular-post-widget">
                            <div class="widget-title text-center">
                                <h6>Populer Post</h6>
                            </div>
<?PHP
    $query4="SELECT * FROM cboard c where email='".$rs->email."' and num not in (".$num.") order by cnt desc, good desc limit 5";
    $result4 = $mysqli->query($query4) or die("3:".$mysqli->error);
    while($rs4 = $result4->fetch_object()){
        $rsc4[]=$rs4;
    }
?>                                
                        <?php
                            foreach($rsc4 as $p4){
                                $img4=explode(",",$p4->file_list);
                        ?>
                            <!-- Single Popular Post -->
                            <div class="single-populer-post d-flex">
                                <img src="<?php echo $img4[0];?>" alt="">
                                <div class="post-content">
                                    <a href="#">
                                        <h6><?php echo $p4->subject;?></h6>
                                    </a>
                                    <p><?php echo date("Y.m.d",strtotime($p4->reg_date));?></p>
                                </div>
                            </div>
                            <?php }?>
                            
                        </div>

                        <!-- Single Widget Area -->
                        <div class="single-widget-area popular-post-widget">
                            <div class="widget-title text-center">
                                <h6>New Post</h6>
                            </div>
<?PHP
    $query5="SELECT * FROM cboard c where num not in (".$num.") order by num desc limit 5";
    $result5 = $mysqli->query($query5) or die("3:".$mysqli->error);
    while($rs5 = $result5->fetch_object()){
        $rsc5[]=$rs5;
    }
?>                                
                        <?php
                            foreach($rsc5 as $p5){
                                $img5=explode(",",$p5->file_list);
                        ?>
                            <!-- Single Popular Post -->
                            <div class="single-populer-post d-flex">
                                <img src="<?php echo $img5[0];?>" alt="">
                                <div class="post-content">
                                    <a href="#">
                                        <h6><?php echo $p5->subject;?></h6>
                                    </a>
                                    <p><?php echo date("Y.m.d",strtotime($p5->reg_date));?></p>
                                </div>
                            </div>
                            <?php }?>
                            
                        </div>

                        <!-- Single Widget Area -->
                        <!-- <div class="single-widget-area add-widget text-center">
                            <div class="add-widget-area">
                                <img src="img/sidebar-img/6.jpg" alt="">
                                <div class="add-text">
                                    <div class="yummy-table">
                                        <div class="yummy-table-cell">
                                            <h2>Cooking Book</h2>
                                            <p>Buy Book Online Now!</p>
                                            <a href="#" class="add-btn">Buy Now</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->

                        <!-- Single Widget Area -->
                        <div class="single-widget-area newsletter-widget">
                            <div class="widget-title text-center">
                                <h6>Newsletter</h6>
                            </div>
                            <p>Subscribe our newsletter gor get notification about new updates, information discount, etc.</p>
                            <div class="newsletter-form">
                                <form action="#" method="post">
                                    <input type="email" name="newsletter-email" id="email" placeholder="Your email">
                                    <button type="submit"><i class="fa fa-paper-plane-o" aria-hidden="true"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ****** Single Blog Area End ****** -->
    <!-- ****** Our Creative Portfolio Area End ****** -->

<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/footer.php";
?>