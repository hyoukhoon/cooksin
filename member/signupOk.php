<?php 

include $_SERVER["DOCUMENT_ROOT"]."/inc/dbconn.php";

$name=strip_tags($_POST['name']);
$email=strip_tags($_POST['email']);
$passwd=hash('sha512',strip_tags($_POST['passwd']));

if(!$name or !$email or !$passwd){
	$data=array("result"=>-1,"val"=>"필수값이 누락됐습니다.");
	echo json_encode($data);
	exit;
}


$que="select * from member where email='".$email."'";
$result = $mysqli->query($que) or die("3:".$mysqli->error);
$rs = $result->fetch_object();

if(!empty($rs)){

    $data=array("result"=>-1,"val"=>"이미 가입한 이메일입니다.");
	echo json_encode($data);

}else{

    $que="INSERT INTO `member`
    (`email`,
    `passwd`,
    `nickName`,
    `regDate`,
    `lastLogin`,
    `loginIp`)
    VALUES
    ('".$email."',
    '".$passwd."',
    '".$name."',
    now(),
    now(),
    '".$_SERVER['REMOTE_ADDR']."')";
    $sql=$mysqli->query($que) or die($mysqli->error);
    
    if($sql){
        $data=array("result"=>1,"val"=>"가입을 환영합니다.");
	    echo json_encode($data);
    }else{
        $data=array("result"=>-1,"val"=>"다시한번 시도해주십시오.");
	    echo json_encode($data);
    }
	
}


?>