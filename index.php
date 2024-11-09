<?php
include '/feature/Sign-up.php';
feedback("cao");
/* if($_SERVER['REQUEST_METHOD']=='POST')
  $featureType=$_POST['featureType'];
  switch($featureType){
    case "Login":
     include '/feature/Login.php';
     break;
    case "Sign-up":
     include '/feature/Sign-up.php';
     break;
    case "File-operation":
     include '/feature/File-operation.php';
     break;
    case "Outside-interface":
     include '/feature/Outside-interface.php';
     break;
    case "User-management":
     include '/feature/User-management.php';
    default:
    $feedback=['feedbackstate'=>'error:featureTypet-is-error'];
    header('Content-Type:application/json');
    echo json_encode($feedback);
     break;
    }
*/
?>