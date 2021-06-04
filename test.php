<?php
include $_SERVER["DOCUMENT_ROOT"]."/inc/dbconn.php";

$result3 = $mysqli->query("select * from myCrypto where uid='rotel' limit 10") or die("3:".$mysqli->error);
while($rs3 = $result3->fetch_object()){

echo "<pre>";
print_r($rs3);


}

?>