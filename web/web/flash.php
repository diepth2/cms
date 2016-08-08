<?php
session_start();    
//include_once 'config.php';
//$userId=$_SESSION[USER_ID];
//
//$username=$_SESSION[USERNAME];
//$password=$_SESSION[PASSWORD];
//$userMoney=$_SESSION[USER_MONEY];
//$level=$_SESSION[USER_LEVEL];
//$zoneId=$_SESSION[USER_ZONE_ID]==null?1:$_SESSION[USER_ZONE_ID];
$userId = 1;
$username ='diep123';
$password ="202cb962ac59075b964b07152d234b70";
$userMoney="300";
$level =2;
$zone_id = 5;

$json="{msg:Bạn chưa đăng nhập hệ thống vui lòng đăng nhập,success:false}";
if($userId !=null){
    $json = array('oName' => $username, 'username' => $username,'password' => $password, 'money' => $userMoney, 'level' => $level, 'zoneId' => $zone_id, 'success' => true, 'chanel' => 0,
        "open_id" =>"", "host" => "123.30.140.139", "port" => 1240, "cp" => "0", "currency" => "Mi");
    
    echo json_encode($json);
}else{
    $json = array('msg' => "Bạn chưa đăng nhập hệ thống vui lòng đăng nhập",'success' => false);
    echo json_encode($json);
}

?>

