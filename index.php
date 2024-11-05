<?php
 include 'Sign-up.php';

/* if($_SERVER['REQUEST_METHOD']=='POST')
  $featureType=$_POST['featureType'];
  switch($featureType){
    case "Login":
     include 'Login.php';
     break;
    case "Sign-up":
     include 'Sign-up.php';
     break;
    case "File-operation":
     include 'File-operation.php';
     break;
    case "Outside-interface":
     include 'Outside-interface.php';
     break;
    case "User-management":
     include 'User-management.php';
    default:
    $feedback=['feedbackstate'=>'error:featureTypet-is-error'];
    header('Content-Type:application/json');
    echo json_encode($feedback);
     break;
    }
*/
?>