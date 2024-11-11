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
  public function setSignupname($userSginupinput){
    //用户注册输入信息为数组 对应顺序为  username  password  name  main  membars 
    $this->username = $userSginupinput[1];
    $this->password = $userSginupinput[2];
    $this->name =$userSginupinput[3];
    $this->main =$userSginupinput[4];//-
    $this->membars=$userSginupinput[5];

    
    $this->teamposltion = "0-0;";
    $this->activity ="0000001;";
    $this->teams="0;";
    $this->friends="0;";

  }
}



?>