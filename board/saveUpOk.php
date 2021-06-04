<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/inc/dbconn.php";

 if(!$_SESSION['loginValue']['SEMAIL']){
 	$data=array("result"=>-1,"val"=>"로그인하십시오."); 
 	echo json_encode($data);
 	exit;
 }
$email=$_SESSION['loginValue']['SEMAIL'];
$name=$_SESSION['loginValue']['SUNAME'];
$multi="child";

	$subject=removeHackTag($_POST['subject']);
	$childName=removeHackTag($_POST['childName']);
	$imgUrl=$_POST['imgUrl'];
	$content=$_POST['content'];
	$content=addslashes($content);

	$mysqli->autocommit(FALSE);

	$query="INSERT INTO `cboard`
        (`name`,
        `email`,
        `subject`,
        `url`,
        `file_list`,
        `content`,
        `multi`)
        VALUES
        ('$name',
        '$email',
        '$subject',
        '$childName',
        '$imgUrl',
        '$content',
        '$multi');";

	$sql1=$mysqli->query($query) or die("3:".$mysqli->error);


	if($sql1){

		$mysqli->commit();
		$data=array("result"=>1,"val"=>"성공"); 
	}else{
		$data=array("result"=>0,"val"=>"실패"); 
	}

	echo json_encode($data);
?>