<?php
include 'feature/Feedback.php';
$rawData=file_get_contents('php://input');
$data=json_decode($rawData,true);
switch($data['featureType']){
    case "Login":
     include 'feature/Login.php';
     login($data['username'],$data['password']);
     break;
    case 'Signup':
     include 'feature/Signup.php';
     post($data);
     break;
    case "File-operation":
     include 'feature/File-operation.php';
     break;
    case "Outside-interface":
     include 'feature/Outside-interface.php';
     break;
    case "User-management":
     include 'feature/User-management.php';
     break;
    default:
     feedback('error:featurnType错误');
     break;
}
?>
