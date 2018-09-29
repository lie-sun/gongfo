<?php

global $_GPC, $_W;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
load()->func('tpl');
if($op=='display'){

//    $time=strtotime(date('Y-m-d'));
//    $date=date('Y-m-d');
//    $map['uptime']=array('GT',$time);
//    $map1['addtime']=array('GT',$time);
//    $map2['addtime']=array('EGT',date('Y-m-d'));
//    $list = pdo_fetch('SELECT COUNT(*) as count,sum(pay) as paynum FROM ' . tablename("sf_mini_uplog")." where uniacid=:uniacid and uptime>'$time'",array('uniacid'=>$_W['uniacid']));
//    $back = pdo_fetch('SELECT COUNT(*) as count FROM ' . tablename("sf_mini_back")." where uniacid=:uniacid and addtime>'$time'",array('uniacid'=>$_W['uniacid']));
//    $user = pdo_fetch('SELECT COUNT(*) as count FROM ' . tablename("sf_mini_user")." where uniacid=:uniacid and addtime>='$date'",array('uniacid'=>$_W['uniacid']));


    $strartimest= date("Y-m-d",strtotime("-2 day "));
    $endtimest= date("Y-m-d");
    if(!empty($_GPC["starttime"])){

        $strartimest   =$_GPC["starttime"];

    }

    if(!empty($_GPC["endtime"])){

        $endtimest  =$_GPC["endtime"];

    }

    $strartime= strtotime($strartimest);
    $endtime= strtotime("$endtimest +1 day")-1;








    $a=time();


    $back1 = pdo_fetchall("SELECT COUNT(*) as bcount,FROM_UNIXTIME( addtime, '%Y-%m-%d' ) as btime FROM " . tablename("sf_mini_back")." where uniacid=:uniacid   and  addtime>$strartime and addtime< $endtime  group by btime desc",array(':uniacid'=>$_W['uniacid']));




    $user1 = pdo_fetchall("SELECT COUNT(*) as ucount,FROM_UNIXTIME(UNIX_TIMESTAMP(addtime) , '%Y-%m-%d' ) as btime FROM " . tablename("sf_mini_user")." where uniacid=:uniacid  and  unix_timestamp(addtime)>$strartime and unix_timestamp(addtime)< $endtime  group by to_days(addtime) desc",array(':uniacid'=>$_W['uniacid']));




    $list1 = pdo_fetchall("SELECT COUNT(*) as pcount,sum(pay) as paynum ,FROM_UNIXTIME(uptime, '%Y-%m-%d' ) as btime FROM " . tablename("sf_mini_uplog")." where uniacid=:uniacid  and uptime>$strartime and uptime< $endtime group by  to_days(uptimestamp)  desc ",array(':uniacid'=>$_W['uniacid']));







    foreach ($user1 as $k=>$item) {

        foreach($back1 as $k1=>$item1){
            if($item['btime']==$item1['btime']){
                $user1[$k]['bcount']=$back1[$k1]['bcount'];
            }
        }
    }
    foreach ($user1 as $k=>$item) {

        foreach($list1 as $k1=>$item1){
            if($item['btime']==$item1['btime']){
                $user1[$k]['pcount']=$list1[$k1]['pcount'];
                $user1[$k]['paynum']=$list1[$k1]['paynum'];
            }
        }
    }

}


//select *,FROM_UNIXTIME( addtime, '%Y-%m-%d' ) as btime from ims_sf_mini_back   group by btime desc
include $this->template('count');