<?php
function feedback($type){
    $feedback=['feedbackstate'=>$type];
    header('Content-Type:application/json');
    echo json_encode($feedback);
    exit();
  }

  function feedbacks($array){
    $leng=count($array);
    for($i= 0;$i<$leng;$i++){
       $feedback[$array[$i][0]]=$array[$i][1];
  }
  header('Content-Type:application/json');
    echo json_encode($feedback);
    exit();
}
?>