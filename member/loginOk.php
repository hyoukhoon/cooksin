<?php session_start();
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbconn.php";


$email=strip_tags($_POST['email']);
$passwd=hash('sha512',strip_tags($_POST['passwd']));

if(!$email or !$passwd){
	$data=array("result"=>-1,"val"=>"필수값이 누락됐습니다.");
	echo json_encode($data);
	exit;
}


$que="select * from member where email='".$email."' and passwd='".$passwd."'";
$result = $mysqli->query($que) or die("3:".$mysqli->error);
$rs = $result->fetch_object();

if(!empty($rs->num)){

	$loginValue=array("SUNAME"=>$rs->nickName,"SEMAIL"=>$rs->email, "SNUM"=>$rs->num);
	$_SESSION["loginValue"]=$loginValue;

	$data=array("result"=>1,"val"=>"로그인 했습니다.");
	echo json_encode($data);

}else{
	$data=array("result"=>-1,"val"=>"아이디나 암호가 틀렸습니다.");
	echo json_encode($data);
}


?>