<?php
global $_GPC, $_W;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
load()->func('tpl');
if($op=='display'){

    $id = intval($_GPC['id']);
    $item=pdo_fetch("SELECT * FROM " .tablename('sf_mini_rule') ." WHERE uniacid=:uniacid",array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')) {
        $data = array(
            'uniacid' => $_W['uniacid'],
            'ruleone' => $_GPC['ruleone'],
            'ruletwo' => $_GPC['ruletwo'],
        );
        if ($id > 0 && !empty($id)) {
            $result = pdo_update('sf_mini_rule', $data, array('id' => $id));
            if (!empty($result)) {
                message('更新成功', 'refresh', 'success');
            } else {
                message('更新失败', 'refresh', 'error');
            }
        } else {
            $result = pdo_insert('sf_mini_rule', $data);
            if (!empty($result)) {
                message('添加成功', 'refresh', 'success');
            } else {
                message('添加失败', 'refresh', 'error');
            }
        }
    }
}elseif($op=='detail'){

    load()->func('file');
    $id = intval($_GPC['id']);

    $item=pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE uniacid=:uniacid",array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
        $data = array(
            'uniacid' => $_W['uniacid'],
            'stime' => $_GPC['stime'],
            'xtime' => $_GPC['xtime'],
            'status' => $_GPC['status'],
        );
        if($id>0 && !empty($id)){
            $result = pdo_update('sf_mini_exeset', $data, array('id' =>$id));
            if (!empty($result)) {
                message('更新成功','refresh','success');
            }else{
                message('更新失败','refresh','error');
            }
        }else{
            $result = pdo_insert('sf_mini_exeset', $data);
            if (!empty($result)) {
                message('添加成功','refresh','success');
            }else{
                message('添加失败','refresh','error');
            }
        }
    }

}elseif($op=='erweima'){
    $id = intval($_GPC['id']);

    $item=pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE uniacid=:uniacid",array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
        $data = array(
            'uniacid' => $_W['uniacid'],
            'imgurl' => $_GPC['imgurl'],
        );
        if($id>0 && !empty($id)){
            $result = pdo_update('sf_mini_exeset', $data, array('id' =>$id));
            if (!empty($result)) {
                message('更新成功','refresh','success');
            }else{
                message('更新失败','refresh','error');
            }
        }else{
            $result = pdo_insert('sf_mini_exeset', $data);
            if (!empty($result)) {
                message('添加成功','refresh','success');
            }else{
                message('添加失败','refresh','error');
            }
        }
    }
}elseif($op=='network'){
    $id = intval($_GPC['id']);

    $item=pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE uniacid=:uniacid",array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
        $data = array(
            'uniacid' => $_W['uniacid'],
            'networkname' => $_GPC['networkname'],
        );
        if($id>0 && !empty($id)){
            $result = pdo_update('sf_mini_exeset', $data, array('id' =>$id));
            if (!empty($result)) {
                message('更新成功','refresh','success');
            }else{
                message('更新失败','refresh','error');
            }
        }else{
            $result = pdo_insert('sf_mini_exeset', $data);
            if (!empty($result)) {
                message('添加成功','refresh','success');
            }else{
                message('添加失败','refresh','error');
            }
        }
    }
}elseif($op=='share'){
    $id = intval($_GPC['id']);

    $item=pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE uniacid=:uniacid",array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
        $data = array(
            'uniacid' => $_W['uniacid'],
            'fimgurl' => $_GPC['fimgurl'],
            'ftitle' => $_GPC['ftitle'],
            'fcontent' => $_GPC['fcontent'],
        );
        if($id>0 && !empty($id)){
            $result = pdo_update('sf_mini_exeset', $data, array('id' =>$id));
            if (!empty($result)) {
                message('更新成功','refresh','success');
            }else{
                message('更新失败','refresh','error');
            }
        }else{
            $result = pdo_insert('sf_mini_exeset', $data);
            if (!empty($result)) {
                message('添加成功','refresh','success');
            }else{
                message('添加失败','refresh','error');
            }
        }
    }
}elseif($op=='index'){
    $id = intval($_GPC['id']);

    $item=pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE uniacid=:uniacid",array('uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
        $data = array(
            'uniacid' => $_W['uniacid'],
            'fximgurl' => $_GPC['fximgurl'],
            'bgimgurl' => $_GPC['bgimgurl'],
            'musicurl' => $_GPC['musicurl'],

        );
        if($id>0 && !empty($id)){
            $result = pdo_update('sf_mini_exeset', $data, array('id' =>$id));
            if (!empty($result)) {
                message('更新成功','refresh','success');
            }else{
                message('更新失败','refresh','error');
            }
        }else{
            $result = pdo_insert('sf_mini_exeset', $data);
            if (!empty($result)) {
                message('添加成功','refresh','success');
            }else{
                message('添加失败','refresh','error');
            }
        }
    }
}
elseif($op=='delete'){
    $id = intval($_GPC['id']);
    $result = pdo_delete('sf_mini_paiwei', array('id' => $id));
    if (!empty($result)) {
        message('删除成功','refresh','success');
    }else{
        message('删除失败','refresh','error');
    }
}

include $this->template('setting');