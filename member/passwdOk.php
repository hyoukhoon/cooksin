<?php session_start();

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbconn.php";

if(!$_SESSION['loginValue']['SEMAIL']){
    $data=array("result"=>-1,"val"=>"로그인하십시오."); 
    echo json_encode($data);
    exit;
}

$current_password=hash('sha512',strip_tags($_POST['current_password']));
$passwd=hash('sha512',strip_tags($_POST['passwd']));

if(!$current_password or !$passwd){
	$data=array("result"=>-1,"val"=>"필수값이 누락됐습니다.");
	echo json_encode($data);
	exit;
}


$que="select * from member where email='".$_SESSION['loginValue']['SEMAIL']."' and passwd='".$current_password."'";
$result = $mysqli->query($que) or die("3:".$mysqli->error);
$rs = $result->fetch_object();

if(empty($rs)){

    $data=array("result"=>-1,"val"=>"기존 비밀번호가 맞지 않습니다.");
	echo json_encode($data);

}else{

    $que="update member set passwd='".$passwd."' where email='".$_SESSION['loginValue']['SEMAIL']."'";
    $sql=$mysqli->query($que) or die($mysqli->error);
    
    if($sql){
        $data=array("result"=>1,"val"=>"비밀번호를 수정했습니다.");
	    echo json_encode($data);
    }else{
        $data=array("result"=>-1,"val"=>"다시한번 시도해주십시오.");
	    echo json_encode($data);
    }
	
}


?>