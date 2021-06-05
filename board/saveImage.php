<?php session_start();
include $_SERVER['DOCUMENT_ROOT']."/inc/dbconn.php";

 if(!$_SESSION['loginValue']['SEMAIL']){
 	$data=array("result"=>-1,"val"=>"로그인하십시오."); 
 	echo json_encode($data);
 	exit;
 }

$email=$_SESSION['loginValue']['SEMAIL'];
$multi="child";
$gubun=$_POST['gubun'];

print_r($_FILES);

		if($_FILES['file']['size']>10240000){//10메가
			echo "-1";
			exit;
		}
		$ext = substr(strrchr($_FILES['file']['name'],"."),1);
		$ext = strtolower($ext);
		if ($ext != "jpg" and $ext != "png" and $ext != "jpeg" and $ext != "gif")
		{
			echo "-1";
			exit;
		}

        $name = "cs_".$now3.substr(rand(),0,4);
        $filename = $name.'.'.$ext;
		$destination = '/var/www/cooksin/public_html/board/upImages/'.$filename;
        $location =  $_FILES["file"]["tmp_name"];
		
		try {
			$rs=move_uploaded_file($location,$destination);
		}catch(Exception $e) {
			print_r($e);
		}
		
		if($gubun=="member"){
			$query="update member set photo='/board/upImages/".$filename."' where email='".$_SESSION['loginValue']['SEMAIL']."'";
			$sql1=$mysqli->query($query) or die("3:".$mysqli->error);
		}

		// echo "rs=>".$rs."<br>";
        echo '/board/upImages/'.$filename;

?>