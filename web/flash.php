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
$username ='diepth3';
$password ="c4ca4238a0b923820dcc509a6f75849b";
$userMoney=300;
$level =2;
$zone_id = 5;

$json="{msg:Bạn chưa đăng nhập hệ thống vui lòng đăng nhập,success:false}";
if($userId !=null){
    $json = array('oName' => $username, 'username' => $username,'password' => $password, 'money' => $userMoney, 'level' => $level, 'zoneId' => $zone_id, 'success' => true, 'chanel' => 0,
        "openid" =>"", "host" => "123.30.140.139", "port" => 1240, "cp" => "0", "currency" => "Mi");
    
    echo json_encode($json);
}else{
    $json = array('msg' => "Bạn chưa đăng nhập hệ thống vui lòng đăng nhập",'success' => false);
    echo json_encode($json);
}

?>

