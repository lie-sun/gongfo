<?php

global $_GPC, $_W;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
load()->func('tpl');
if($op=='display'){
    $id = intval($_GPC['id']);
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename("sf_mini_user")." where uniacid=:uniacid ",array('uniacid'=>$_W['uniacid']));

    $list = pdo_fetchall("SELECT * FROM ".tablename("sf_mini_user")." where uniacid=:uniacid ORDER BY lasttime desc LIMIT " . ($pindex - 1) * $psize .',' .$psize,array('uniacid'=>$_W['uniacid']) );


    $pager = pagination($total, $pindex, $psize);
    foreach($list as $k=>$val){
        $list[$k]['sort']=$psize*($pindex-1)+($k+1);
    }

}elseif($op=='detail'){
    $id = intval($_GPC['id']);
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $list = pdo_fetchall("SELECT * FROM ".tablename("sf_mini_back")." where uniacid=:uniacid ORDER BY id asc LIMIT " . ($pindex - 1) * $psize .',' .$psize,array('uniacid'=>$_W['uniacid']) );

    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename("sf_mini_back"));
    $pager = pagination($total, $pindex, $psize);
    foreach($list as $k=>$val){
        $list[$k]['sort']=$psize*($pindex-1)+($k+1);
    }


}elseif($op=='delete'){
    $id = intval($_GPC['id']);
    $result = pdo_delete('sf_mini_uplog', array('id' => $id));
    if (!empty($result)) {
        message('删除成功','refresh','success');
    }else{
        message('删除失败','refresh','error');
    }
} elseif($op=='delete2'){
    $id = intval($_GPC['id']);
    $result = pdo_delete('sf_mini_back', array('id' => $id));
    if (!empty($result)) {
        message('删除成功','refresh','success');
    }else{
        message('删除失败','refresh','error');
    }
}

include $this->template('logininfo');