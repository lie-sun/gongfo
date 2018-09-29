<?php

global $_GPC, $_W;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
load()->func('tpl');
if($op=='display'){
    $id = intval($_GPC['id']);
    $pindex = max(1, intval($_GPC['page']));
    $psize = 15;
    $list = pdo_fetchall("SELECT * FROM ".tablename("sf_mini_paiwei")." where uniacid=:uniacid ORDER BY id asc LIMIT " . ($pindex - 1) * $psize .',' .$psize,array('uniacid'=>$_W['uniacid']) );

    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename("sf_mini_paiwei")." where uniacid=:uniacid",array('uniacid'=>$_W['uniacid']));
    $pager = pagination($total, $pindex, $psize);
    foreach($list as $k=>$val){
        $list[$k]['sort']=$psize*($pindex-1)+($k+1);
    }

}elseif($op=='detail'){

    load()->func('file');
    $id = intval($_GPC['id']);

    $item=pdo_fetch("SELECT * FROM " .tablename('sf_mini_paiwei') ." WHERE id=:id AND uniacid=:uniacid",array(':id' => $id,'uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
        $data = array(
            'uniacid' => $_W['uniacid'],
            'name' => $_GPC['name'],
            'imgurl' => $_GPC['imgurl'],
            'nimgurl' => $_GPC['nimgurl'],
            'sort' => $_GPC['sort'],
        );
        if($id>0 && !empty($id)){
            $result = pdo_update('sf_mini_paiwei', $data, array('id' =>$id));
            if (!empty($result)) {
                message('更新成功','refresh','success');
            }else{
                message('更新失败','refresh','error');
            }
        }else{
            $result = pdo_insert('sf_mini_paiwei', $data);
            if (!empty($result)) {
                message('添加成功','refresh','success');
            }else{
                message('添加失败','refresh','error');
            }
        }
    }

}elseif($op=='shuju'){
    $data=array(
        0 =>array('uniacid'=>$_W['uniacid'],'name'=>'峨眉山','imgurl'=>'images/2/2016/07/w5gBs8Ng8TYSsq8GnHDohB66Q8ymU8.png','nimgurl'=>'images/2/2016/07/q3hL634fQF6D73hnXHhdqLl3dhaDUH.png'),
        1 =>array('uniacid'=>$_W['uniacid'],'name'=>'五台山','imgurl'=>'images/2/2016/07/tYYnHqZWzlfJHWBmyz7y2af2FjH2Fr.png','nimgurl'=>'images/2/2016/07/SWgkyuArBKua96oGaUIaIrqgmm0AmH.png'),
        2 =>array('uniacid'=>$_W['uniacid'],'name'=>'普陀山','imgurl'=>'images/2/2016/07/Z2drdpDe2DE42TtS6e4pID4Sdpi5s9.png','nimgurl'=>'images/2/2016/07/Fy5qECj5Q0c5vxQB5OE2CcZy6nSH08.png'),
        3 =>array('uniacid'=>$_W['uniacid'],'name'=>'九华山','imgurl'=>'images/2/2016/07/JZdr0vUl0l6l6DLu66L66viCZKP0cp.png','nimgurl'=>'images/2/2016/07/V35o0A9Ko2Ud0OeZgl9U22RAD0ukGR.png'),
        4 =>array('uniacid'=>$_W['uniacid'],'name'=>'终南山','imgurl'=>'images/2/2016/07/wez1P1przPpJtP1UpfEnPLXal1aCpC.png','nimgurl'=>'images/2/2016/07/T5O5h5C4XK4HbKPCT3d4Bt5tKuk53s.png'),
        5 =>array('uniacid'=>$_W['uniacid'],'name'=>'西藏','imgurl'=>'images/2/2016/07/bys99C3SFBQfWbw6q6z3VZey9mfufB.png','nimgurl'=>'images/2/2016/07/Ulhz0l9Ge88lK22HT29TBLBbT775Pe.png'),
    );
    if($_GPC['id']==1){
        pdo_delete('sf_mini_paiwei',array('uniacid'=>$_W['uniacid']));


        foreach($data as $k=>$v ){
            pdo_insert('sf_mini_paiwei',$v);
        }
        message('初始化成功','refresh','success');
    }


}elseif($op=='delete'){
    $id = intval($_GPC['id']);
    $result = pdo_delete('sf_mini_paiwei', array('id' => $id));
    if (!empty($result)) {
        message('删除成功',$this->createWebUrl('paiwei'),'success');
    }else{
        message('删除失败',$this->createWebUrl('paiwei'),'error');
    }
}

include $this->template('paiwei');