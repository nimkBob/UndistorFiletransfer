<?php
 class Fdate{
  protected $id;
  protected $Fdatename;

  protected $admins;

  protected $sonfiles;

  protected $users;

  protected $files;

  protected $hintinformation;

  protected $endtime;


 public function setFile($fileinformation) {
    // 检查文件名是否存在，并设置 Fdatename 属性
    if (isset($fileinformation['filename'])) {
        $this->Fdatename = $fileinformation['filename'];
    } else {
        feedback('Missing required field "filename"');
    }

 if (isset($fileinformation['id'])) {
        $this->id = $fileinformation['id'];
    } 

    // 其他字段可以根据需要设置
    if (isset($fileinformation['admin'])) {
        $this->admins = $fileinformation['admin'];
    }

    if (isset($fileinformation['sonfile'])) {
        $this->sonfiles = $fileinformation['sonfile'];
    }

    if (isset($fileinformation['user'])) {
        $this->users = $fileinformation['user'];
    }

    if (isset($fileinformation['files'])) {
        $this->files = $fileinformation['files'];
    }

    if (isset($fileinformation['hintinformation'])) {
        $this->hintinformation = $fileinformation['hintinformation'];
    }

    if (isset($fileinformation['endtime'])) {
        $this->endtime = $fileinformation['endtime'];
    }
}

public function getFileInfo() {
    $info = [];

    // 检查并添加文件名
    if (isset($this->Fdatename)) {
        $info['filename'] = $this->Fdatename;
    } else {
        feedback('The filename has not been set.');
    }

    // 添加其他信息
    if (isset($this->admins)) {
        $info['admin'] = $this->admins;
    }

  if (isset($this->id)) {
        $info['id'] = $this->id;
    }

    if (isset($this->sonfiles)) {
        $info['sonfile'] = $this->sonfiles;
    }

    if (isset($this->users)) {
        $info['user'] = $this->users;
    }

    if (isset($this->files)) {
        $info['files'] = $this->files;
    }

    if (isset($this->hintinformation)) {
        $info['hintinformation'] = $this->hintinformation;
    }

    if (isset($this->starttime)) {
        $info['endtime'] = $this->endtime;
    }

    // 返回文件信息数组
    return $info;
 }
}
?>