<?php

global $_GPC, $_W;
load()->func('tpl');

$title='回向';
//$openid=$_GPC['openid'];
$openid=$_SESSION['openid'];


$info = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));
$user=$info;

$item = pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$item['ftitle']=str_replace('[nick]',$info['nickname'],$item['ftitle']);
$item['fcontent']=str_replace('[nick]',$info['nickname'],$item['fcontent']);

$uplog = pdo_fetch("SELECT * FROM " .tablename('sf_mini_uplog') ." WHERE  openid=:openid  and `uniacid`=:uniacid order by uptime desc",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));


include $this->template('back');