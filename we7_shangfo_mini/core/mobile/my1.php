<?php

global $_GPC, $_W;
load()->func('tpl');
$openid=$_SESSION['openid'];
$kind=3;
$title='供佛记录';

$userinfo = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));
$item = pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$item['ftitle']=str_replace('[nick]',$userinfo['nickname'],$item['ftitle']);
$item['fcontent']=str_replace('[nick]',$userinfo['nickname'],$item['fcontent']);
$sql="select u.id,u.uptime,b.name,b.wish from ims_sf_mini_uplog u LEFT JOIN ims_sf_mini_back b ON u.id=b.pid and u.uniacid={$_W['uniacid']} where u.openid='$openid' ORDER BY uptime DESC  limit 30 ";
$log = pdo_fetchall($sql);



$sign = pdo_fetch("SELECT * FROM " .tablename('sf_mini_sign') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));



include $this->template('my1');