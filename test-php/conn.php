<?php

$db_host = "localhost";
$db_username = "account";
$db_password = "";
$db_name = "account";
//連線資料庫
$db_link = new mysqli($db_host,$db_username,$db_password,$db_name);
//錯誤處理
// if($db_link->connect_error != ""){
// 	echo "資料庫連結失敗";
// }else{
// 	$db_link->query("SET NAME utf8");
// 	echo "資料庫連結成功";
// }
?>