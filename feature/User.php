<?php
class User{
  protected $id;

  protected $username;

  protected $name;

  protected $password;

  protected $main;

  protected $Fdate;

  protected $membars;
  
  protected $teams;

  protected $activity;
  protected $teamposltion;

  protected $friends;
  public function setSignup($userSginupinput){
    //用户注册输入信息为数组 对应顺序为  username  password  name  main  membars 
    $this->username = $userSginupinput[0];
    $this->password = $userSginupinput[1];
    $this->name =$userSginupinput[2];
    $this->main =$userSginupinput[3];//-
    $this->membars=$userSginupinput[4];
    
    $this->teamposltion = "0-0;";
    $this->activity ="0000001;";
    $this->teams="0;";
    $this->friends="0;";

  }
  public function getuserinformation(){
     $num=[
     $this->username,
     $this->password,
     $this->name,
     $this->main,
     $this->membars,
     $this->teams,
     $this->teamposltion,
     $this->friends,
     $this->activity            ];
     
     return $num;
  }

  
  public function setloginin($userlogininput){
    //用户登入输入信息为数组 对应顺序为  username  password  name  main  membars  
    $this->username = $userlogininput[0];
    $this->password = $userlogininput[1];
    $this->name =$userlogininput[2];
    $this->main =$userlogininput[3];//-
    $this->membars=$userlogininput[4];
    
    $this->teamposltion = $userlogininput[5];
    $this->activity =$userlogininput[6];
    $this->teams=$userlogininput[7];
    $this->friends=$userlogininput[8];
  }

}



?>