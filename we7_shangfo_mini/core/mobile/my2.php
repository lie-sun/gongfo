<?php

global $_GPC, $_W;
load()->func('tpl');

$openid=$_SESSION['openid'];
$kind=3;
$title='我的牌位';
$userinfo = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  `uniacid`=:uniacid and openid=:openid",array(':uniacid' =>$_W['uniacid'],'openid'=>$openid));

$onelist = pdo_fetchall("SELECT * FROM " .tablename('sf_mini_paiwei') ." WHERE  `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$rule = pdo_fetch("SELECT * FROM " .tablename('sf_mini_rule') ." WHERE  `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$item = pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
$item['ftitle']=str_replace('[nick]',$userinfo['nickname'],$item['ftitle']);
$item['fcontent']=str_replace('[nick]',$userinfo['nickname'],$item['fcontent']);
$rule['ruletwo']=htmlspecialchars_decode($rule['ruletwo']);



$this->assign('paiwei',$userinfo['paiwei']);

include $this->template('my2');