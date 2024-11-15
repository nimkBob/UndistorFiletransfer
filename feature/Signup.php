<?php
       function posst(){
         
         include 'Check.php';
         include 'Mysql.php';
         include 'User.php';
         include 'Feedback.php';

         $user = new User();
         $userinformation=[
           $_POST['username'],
           $_POST['password'],
           $_POST['name'],
           $_POST['main'],
           $_POST['membars']
          ];

        if(!(validate($userinformation[0],20,6) and validate($userinformation[1],20,12))){
          feedback("error:输入不合法");
          exit();  
         }

        $user->setSignup($userinformation);
        $num=$user->getuserinformation();
        $userw= new Sql;
        if($userw->adduser($num)==true){
          feedback("success:注册成功");
          exit();
        }        
      }
    ?>