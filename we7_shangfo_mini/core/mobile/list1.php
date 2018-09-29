<?php

global $_GPC, $_W;
load()->func('tpl');
$openid=$_SESSION['openid'];
$kind=2;
$title='精进榜';
$user = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $touser));

$sql="select s.openid,u.nickname from ims_sf_mini_user u,ims_sf_mini_sign s where andtime>=7 and s.openid=u.openid and u.uniacid={$_W['uniacid']} limit 20";
$list = pdo_fetchall($sql);
$item = pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$item['ftitle']=str_replace('[nick]',$user['nickname'],$item['ftitle']);
$item['fcontent']=str_replace('[nick]',$user['nickname'],$item['fcontent']);



$sql2="select s.openid,u.nickname,s.andtime from ims_sf_mini_user u,ims_sf_mini_sign s where s.openid=u.openid and s.openid='$openid' and u.uniacid={$_W['uniacid']}";
$info = pdo_fetch($sql2);

if($info['andtime']>6){
    $list[5]['nickname']=$info['nickname'];
    $list[5]['openid']=$info['openid'];
}

$rule = pdo_fetch("SELECT * FROM " .tablename('sf_mini_rule') ." WHERE  `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$rule['ruleone']=htmlspecialchars_decode($rule['ruleone']);
$rule['ruletwo']=htmlspecialchars_decode($rule['ruletwo']);


include $this->template('list1');