<?php

global $_GPC, $_W;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';
load()->func('tpl');
load()->func('logging');
$uptime=date('y')+date('m')+date('d');
$xtime=strtotime(date('y-m-d'));

$stime=time()-48*3600;
if($op=='display'){
    $id = intval($_GPC['id']);
    $pindex = max(1, intval($_GPC['page']));
    $psize = 15;
//    $list = pdo_fetchall("SELECT * FROM ".tablename("sf_mini_user")." where uniacid=:uniacid ORDER BY lasttime desc LIMIT " . ($pindex - 1) * $psize .',' .$psize,array('uniacid'=>$_W['uniacid']) );
    $list = pdo_fetchall("select * from ims_sf_mini_sign s LEFT JOIN ims_sf_mini_user u ON s.openid=u.openid where s.addtime < $xtime AND s.uptime <> $uptime AND u.lasttime > $stime AND u.issend<> $uptime AND s.uniacid=:uniacid ORDER BY lasttime desc LIMIT " . ($pindex - 1) * $psize ."," .$psize,array(':uniacid' =>$_W['uniacid']));
    $total = pdo_fetchcolumn("select COUNT(*) from ims_sf_mini_sign s LEFT JOIN ims_sf_mini_user u ON s.openid=u.openid where s.addtime < $xtime AND s.uptime <> $uptime AND u.lasttime > $stime AND u.issend<> $uptime AND s.uniacid=:uniacid ",array(':uniacid' =>$_W['uniacid']));

    $pager = pagination($total, $pindex, $psize);


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


}elseif($op=='send'){


    $wx=new post1();
    $account = WeAccount::create($_W['uniacid']);
    $access_token=$account->getAccessToken();
    $xtime=strtotime(date('y-m-d'));
    $stime=time()-48*3600;
    $dataopenid = pdo_fetchall("select distinct(s.openid) from ims_sf_mini_sign s LEFT JOIN ims_sf_mini_user u ON s.openid=u.openid where s.addtime < $xtime AND s.uptime <> $uptime AND u.lasttime > $stime AND u.issend<> $uptime AND s.uniacid=:uniacid",array(':uniacid' =>$_W['uniacid']));

    foreach($dataopenid as $k=>$v1){
        $wx->posttemp($v1['openid'],$access_token,$_W['uniacid']);
//        $abc=$wx->posttemp('o9-rtwgdVPMACBiTYwhqwPs_9uuw',$access_token,$_W['uniacid']);
//        logging_run(var_export($abc,true));
        pdo_update('sf_mini_user',array('issend'=>$uptime),array('openid'=>$v1['openid'],'uniacid'=>$_W['uniacid']));
//        pdo_update('sf_mini_user',array('issend'=>$uptime),array('openid'=>'o9-rtwgdVPMACBiTYwhqwPs_9uuw','uniacid'=>$_W['uniacid']));
        usleep(100);
    }
    message('1','','ajax');



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

include $this->template('notice');

class post1{
    //客服接口发消息
    public function posttemp($openid,$accesstoken,$acid){

        $date=date('m月d日');
        $url='https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token='.$accesstoken;
        $post_json='{"touser":"'.$openid.'",
                        "msgtype":"news",
                        "news":
                        {
                            "articles": [
                                     {
                                         "title":"[重要提醒]您今日还未供佛！",
                                         "description":"阿弥陀佛，大德吉祥！\n请坚持供佛；念念不忘，必有回响。\n今生不将此身度，更待何时度此生。",
                                         "url":"http://bf.jinpijia.com/app/index.php?i='.$acid.'&c=entry&do=index&m=we7_shangfo",
                                         "picurl":""
                                     }

                                     ]
                        }
                    }';
        $res=$this->api_notice_increment($url,$post_json);
        return $res;
    }

    public function api_notice_increment($url, $data){
        $ch = curl_init();
        $header = "Accept-Charset: utf-8";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        curl_setopt($ch, CURLOPT_SSLVERSION, CURL_SSLVERSION_TLSv1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $tmpInfo = curl_exec($ch);
        $errorno=curl_errno($ch);
        curl_close($ch);
        $tmpInfo = json_decode($tmpInfo,true);
        return $tmpInfo;
    }
    /* 读取网页json内容 返回数组格式   */
    public function get_from_curl($url) {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 500);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($curl, CURLOPT_URL, $url);
        $res = curl_exec($curl);
        curl_close($curl);
        $res = json_decode($res,true);
        return $res;
    }
    function write_inc($path,$strings,$type=false)
    {
        $path1=dirname(__FILE__)."/".$path;
        if ($type==false)
            file_put_contents($path1,$strings,FILE_APPEND);
        else
            file_put_contents($path1,$strings);
    }
}
