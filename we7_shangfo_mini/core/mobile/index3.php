<?php

global $_GPC, $_W;

load()->func('tpl');
$openid=$_SESSION['openid'];
//var_dump($openid);
$kind=1;
$follow=1;//判断是否关注
$title='我的佛堂';

$uptime=date("y")+date("m")+date("d");
$user = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $touser));

$info = pdo_fetch("SELECT * FROM " .tablename('sf_mini_sign') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));

$uplogres = pdo_fetch("SELECT * FROM " .tablename('sf_mini_uplog') ." WHERE  openid=:openid  and `uniacid`=:uniacid and `upnum`=:upnum order by id desc",array(':uniacid' =>$_W['uniacid'],':openid' => $openid,':upnum' => $uptime));
$item = pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$item['ftitle']=str_replace('[nick]',$user['nickname'],$item['ftitle']);
$item['fcontent']=str_replace('[nick]',$user['nickname'],$item['fcontent']);
$ids=explode(',',$uplogres['goodsid']);
//var_dump($uplogres);exit;
foreach($ids as $k=>$v){
    $res = pdo_fetch("SELECT * FROM " .tablename('sf_mini_price') ." WHERE  id=:id  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':id' => $v));

    $aaa[]=$res;

}
$list=$aaa;

include $this->template('index3');