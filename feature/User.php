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

  protected $usertype;

  protected $activity;

  protected $teamposltion;

  protected $friends;

  protected $userfile;

  public function setSignup($userSginupinput){
    //用户注册输入信息为数组 对应顺序为  username  password  name  main  membars  usertype
    $this->username = $userSginupinput[0];
    $this->password = $userSginupinput[1];
    $this->name =$userSginupinput[2];
    $this->main =$userSginupinput[3];//-
    $this->membars=$userSginupinput[4];
    
    $this->teamposltion = "0-0;";
    $this->activity ="0000001;";
    $this->teams="0;";
    $this->friends="0;";
    $this->usertype=$userSginupinput[5];
    $temp=new Sql;
    $this->id=$temp->getLastUserId()+1;
    unset($temp);
  }

  public function getSginUserInformation(){
     $num=[
     $this->username,
     $this->password,
     $this->name,
     $this->main,
     $this->membars,
     $this->teams,
     $this->teamposltion,
     $this->friends,
     $this->activity,
     $this->usertype, 
     $this->id,     
 ];
     return $num;
  }

  public function getLoginUserInformation(){
    $num=[
     'username'=>$this->username,
     'password'=>$this->password,
     'name'=>$this->name,
     'main'=>$this->main,
     'membars'=>$this->membars,
     'teams'=>$this->teams,
     'teamposltion'=>$this->teamposltion,
     'friends'=>$this->friends,
     'usertype'=>$this->usertype,
     'activity'=>$this->activity,
     'id'=>$this->id,
     'userfile'=>$this->userfile,
 ];
     return $num;
  }
  
  public function setloginin($userlogininput){
    //用户登入输入信息为数组 对应顺序为   username  password  name  main  membars  usertype
    $this->username = $userlogininput[0];
    $this->password = $userlogininput[1];
    $this->name =$userlogininput[2];
    $this->main =$userlogininput[3];//-
    $this->membars=$userlogininput[4];
    $this->usertype=$userlogininput[5];
    $this->teamposltion = $userlogininput[6];
    $this->activity =$userlogininput[7];
    $this->teams=$userlogininput[8];
    $this->friends=$userlogininput[9];
    $this->id=$userlogininput[10];  
    $this->userfile=$userlogininput[11];
  }

  
}



?>