<?php

global $_GPC, $_W;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
load()->func('tpl');
if($op=='display'){
    $id = intval($_GPC['id']);
    $pindex = max(1, intval($_GPC['page']));
    $psize = 20;
    $list = pdo_fetchall("SELECT * FROM ".tablename("sf_mini_price")." where uniacid=:uniacid ORDER BY id asc LIMIT " . ($pindex - 1) * $psize .',' .$psize,array('uniacid'=>$_W['uniacid']) );

    $total = pdo_fetchcolumn('SELECT COUNT(*) FROM ' . tablename("sf_mini_price")." where uniacid=:uniacid",array('uniacid'=>$_W['uniacid']));
    $pager = pagination($total, $pindex, $psize);
    foreach($list as $k=>$val){
        $list[$k]['sort']=$psize*($pindex-1)+($k+1);
    }

}elseif($op=='detail'){
    load()->func('file');
    $id = intval($_GPC['id']);

    $item=pdo_fetch("SELECT * FROM " .tablename('sf_mini_price') ." WHERE  id=:id AND uniacid=:uniacid",array(':id' => $id,'uniacid'=>$_W['uniacid']));
    if(checksubmit('submit')){
        $data = array(
            'uniacid' => $_W['uniacid'],
            'name' => $_GPC['name'],
            'class' => intval($_GPC['class']),
            'imgurl' => $_GPC['imgurl'],
            'wimgurl' => $_GPC['wimgurl'],
            'price' => $_GPC['price'],
            'sort' => $_GPC['sort'],
        );
        if($id>0 && !empty($id)){
            $result = pdo_update('sf_mini_price', $data, array('id' => $id));
            if (!empty($result)) {
                message('更新成功','refresh','success');
            }else{
                message('更新失败','refresh','error');
            }
        }else{
            $result = pdo_insert('sf_mini_price', $data);
            if (!empty($result)) {
                message('添加成功','refresh','success');
            }else{
                message('添加失败','refresh','error');
            }
        }
    }

}elseif($op=='shuju'){
    $data=array(
        0 =>array('uniacid'=>$_W['uniacid'],'name'=>'蝴蝶兰','class'=>'1','imgurl'=>'images/5/2017/12/My9l2wcw33Y4EclwKlLhIx0IyMxY3h.png','wimgurl'=>'images/5/2017/12/bivzTJJkG6Ji1V8TK6z1kT5eg5Um88.png'),
        1 =>array('uniacid'=>$_W['uniacid'],'name'=>'荷花','class'=>'1','imgurl'=>'images/5/2017/12/Na1YP1gb0C3AYhs7v1Y994hvASh3Bc.png','wimgurl'=>'images/5/2017/12/diH64iI6IVi964o6BAA45T55U7Wo49.png'),
        2 =>array('uniacid'=>$_W['uniacid'],'name'=>'鸡蛋花','class'=>'1','imgurl'=>'images/5/2017/12/Yd99i2UOiZ32zI9D22Q2gS492dueID.png','wimgurl'=>'images/5/2017/12/YIODFFSm88EmXM89xDg89exIFDmMdO.png'),
        3 =>array('uniacid'=>$_W['uniacid'],'name'=>'文殊兰','class'=>'1','imgurl'=>'images/5/2017/12/RSBB3iXaXQUQUNtv333tu33tNBa1bQ.png','wimgurl'=>'images/5/2017/12/OA5amSkSqXJLCl5zM5RQwzXaZmXQrj.png'),
        4 =>array('uniacid'=>$_W['uniacid'],'name'=>'平安香','class'=>'2','imgurl'=>'images/5/2017/12/MAVYPyc7RUkYtyuUtTPrRU7Uycar7U.png','wimgurl'=>'images/5/2017/12/Q2iokIZzVFdDDY2KTv3KyDakoYT2Yf.png'),
        5 =>array('uniacid'=>$_W['uniacid'],'name'=>'许愿香','class'=>'2','imgurl'=>'images/5/2017/12/qEx7sdd7MexSz47SL2KhgznHNz2DsZ.png','wimgurl'=>'images/5/2017/12/JKHKYyy3crzVkkKptLlFZKCKyhckTy.png'),
        6 =>array('uniacid'=>$_W['uniacid'],'name'=>'健康香','class'=>'2','imgurl'=>'images/5/2017/12/qO7CJpOPokPw3KJ0UenPmnEKeI0r3M.png','wimgurl'=>'images/5/2017/12/ilf8FI9EaAzIifIzjZ6Rj8j6fmizIw.png'),
        7 =>array('uniacid'=>$_W['uniacid'],'name'=>'招财香','class'=>'2','imgurl'=>'images/5/2017/12/vdQwHdfFtHq9F9m9lL0v9QQ04LL4Q9.png','wimgurl'=>'images/5/2017/12/Weu73R275u2r992g995wW3Ue2Grk9H.png'),
        8 =>array('uniacid'=>$_W['uniacid'],'name'=>'苹果','class'=>'3','imgurl'=>'images/5/2017/12/KoO8KxYo85zdZQqmixBajfXf5H5hof.png','wimgurl'=>'images/5/2017/12/xM6Iy3i63VOdo66azo3kI99I1F30zk.png'),
        9 =>array('uniacid'=>$_W['uniacid'],'name'=>'橙子','class'=>'3','imgurl'=>'images/5/2017/12/SrChOWr4FWrXMOm5rfe45XH5ofoH9R.png','wimgurl'=>'images/5/2017/12/i4p59v1HB55apkr88KOtbPbprHE5Ge.png'),
        10 =>array('uniacid'=>$_W['uniacid'],'name'=>'桃子','class'=>'3','imgurl'=>'images/5/2017/12/jJj17kQTjKJggqgowP00ZKTaCAaOzQ.png','wimgurl'=>'images/5/2017/12/m1K9Vq9MxBbbFxfJB1M9V0m9QemVfb.png'),
        11 =>array('uniacid'=>$_W['uniacid'],'name'=>'火龙果','class'=>'3','imgurl'=>'images/5/2017/12/axDXKKJHqEG3kMZQvS1mM6vMEKMMkz.png','wimgurl'=>'images/5/2017/12/Hhiy8uv2sT2Tz0hZIznYhhsHa5eHvE.png'),
    );
    if($_GPC['id']==1){
        pdo_delete('sf_mini_price',array('uniacid'=>$_W['uniacid']));


        foreach($data as $k=>$v ){
            pdo_insert('sf_mini_price',$v);
        }
        message('初始化成功','refresh','success');
    }


}elseif($op=='delete'){
    $id = intval($_GPC['id']);
    $result = pdo_delete('sf_mini_price', array('id' => $id));
    if (!empty($result)) {
        message('删除成功',$this->createWebUrl('gongpin'),'success');
    }else{
        message('删除失败',$this->createWebUrl('gongpin'),'error');
    }
}

include $this->template('gongpin');