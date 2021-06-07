<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/header.php";

$multi=$_GET["multi"];

$que2="SELECT count(*) FROM cboard c where multi='".$multi."' $where";
$result2 = $mysqli->query($que2) or die("3:".$mysqli->error);
$rs2 = $result2->fetch_array();
$total=$rs2[0];

$que="SELECT *, (select count(*) from cboard_memo m where m.pa_num=c.num) as reply_cnt  FROM cboard c where multi='".$multi."' $where";
$LIMIT=$_GET['LIMIT']??12;
$page=$_GET['page']??1;
$start_page=($page-1)*$LIMIT;
$end_page=$LIMIT;
$ps=$LIMIT;//한페이지에 몇개를 표시할지
$sub_size=10;//아래에 나오는 페이징은 몇개를 할지
$total_page=ceil($total/$ps);//몇페이지
$f_no=$_GET['f_no']??1;//첫페이지
if($f_no<1)$f_no=1;
$l_no=$f_no+$sub_size-1;//마지막페이지
if($l_no>$total_page)$l_no=$total_page;
$n_f_no=$f_no+$sub_size;//다음첫페이지
$p_f_no=$f_no-$sub_size;//이전첫페이지
$no=$total-($page-1)*$ps;//번호매기기

$limit_query=" order by num desc limit $start_page, $end_page";
$last_query=$que.$limit_query;
$result = $mysqli->query($last_query) or die("3:".$mysqli->error);
while($rs = $result->fetch_object()){
    $rsc[]=$rs;
}


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

            <?php
                foreach($rsc as $p){
                    $img=explode(",",$p->file_list);
            ?>
                <!-- Single Post -->
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="single-post wow fadeInUp" data-wow-delay="0.1s">
                        <!-- Post Thumb -->
                        <div class="post-thumb">
                            <?php 
                                if(!empty($img)){
                            ?>
                                <a href="view.php?num=<?php echo $p->num;?>"><img src="<?php echo $img[0];?>"></a>
                            <?php }?>
                        </div>
                        <!-- Post Content -->
                        <div class="post-content">
                            <div class="post-meta d-flex">
                                <div class="post-author-date-area d-flex">
                                    <!-- Post Author -->
                                    <div class="post-author">
                                        <a href="#">By <?php echo $p->name;?></a>
                                    </div>
                                    <!-- Post Date -->
                                    <div class="post-date">
                                        <a href="#"><?php echo date("Y.m.d",strtotime($p->reg_date));?></a>
                                    </div>
                                </div>
                                <!-- Post Comment & Share Area -->
                                <div class="post-comment-share-area d-flex">
                                    <!-- Post Favourite -->
                                    <div class="post-favourite">
                                        <a href="#"><i class="fa fa-heart-o" aria-hidden="true"></i> <?php echo $p->good;?></a>
                                    </div>
                                    <!-- Post Comments -->
                                    <div class="post-comments">
                                        <a href="#"><i class="fa fa-comment-o" aria-hidden="true"></i> <?php echo $p->reply_cnt;?></a>
                                    </div>
                                    <!-- Post Share -->
                                    <!-- <div class="post-share">
                                        <a href="#"><i class="fa fa-share-alt" aria-hidden="true"></i></a>
                                    </div> -->
                                </div>
                            </div>
                            <a href="#">
                                <h5 class="post-headline"><?php echo $p->subject;?></h4>
                            </a>
                        </div>
                    </div>
                </div>
            <?php }?>

                
                <!-- 페이징 -->
                <div class="col-12">
                    <div class="pagination-area d-sm-flex mt-15">
                        <nav aria-label="#">
                            <ul class="pagination">
                            <?php if($f_no!=1){?>
                                <li class="page-item">
                                    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?mode=<?=$mode?>&page=<?=$p_f_no?>&f_no=<?=$p_f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&site_json=<?=$site_json?>&m2=<?=$m2?>&orderby=<?=$orderby?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i> Prev</a>
                                </li>
                            <?php }?>
                            <?php for($i=$f_no;$i<=$l_no;$i++){?>
                                <?php if($i==$page){?>
                                    <li class="page-item active">
                                        <a class="page-link" href="#"><?=$i?> <span class="sr-only">(current)</span></a>
                                    </li>
                                <?php } else {?>
                                    <li class="page-item"><a class="page-link" href="<?=$PHP_SELF?>?mode=<?=$mode?>&page=<?=$i?>&f_no=<?=$f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&site_json=<?=$site_json?>&m2=<?=$m2?>&orderby=<?=$orderby?>"><?=$i?></a></li>
                                <?php }?>
                            <?php }?>
                            <?php if($l_no<$total_page){?>
                                <li class="page-item">
                                    <a class="page-link" href="<?=$_SERVER['PHP_SELF']?>?mode=<?=$mode?>&page=<?=$n_f_no?>&f_no=<?=$n_f_no?>&gubun=<?=$gubun?>&ord=<?=$ord?>&s_key=<?=$s_key?>&sword=<?=$sword?>&site_json=<?=$site_json?>&m2=<?=$m2?>&orderby=<?=$orderby?>">Next <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
                                </li>
                            <?php }?>
                            </ul>
                        </nav>
                        <div class="page-status">
                            <a href="/board/write.php?multi=<?php echo $multi;?>"><button type="button" class="btn btn-primary">WRITE</button></a>
                        </div>
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