<?php

global $_GPC, $_W;
load()->func('tpl');
$openid=$_SESSION['openid'];

$title='回向';
$info = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));

$res1 = pdo_fetch("SELECT * FROM " .tablename('sf_mini_back') ." WHERE  pid=:pid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':pid' => $_GPC['pid']));
$item = pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$item['ftitle']=str_replace('[nick]',$info['nickname'],$item['ftitle']);
$item['fcontent']=str_replace('[nick]',$info['nickname'],$item['fcontent']);
//var_dump($info['headurl']);
if(!empty($_POST['name']) || !empty($_POST['wish'])){

    $data['pid']=$_GPC['pid'];
    $data['uniacid']=$_W['uniacid'];
    $data['username']=$_GPC['username'];
    $data['name']=$_GPC['name'];
    $data['wish']=$_GPC['wish'];
    $data['addtime']=time();

    if(!$res1){
        $res=pdo_insert('sf_mini_back', $data);
    }
}

include $this->template('back2');