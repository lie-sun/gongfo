<?php

global $_W,$_GPC;
load()->func('logging');
$uptime=date('y')+date('m')+date('d');

if($_POST['openid']){
    $openid=$_POST['openid'];

 pdo_update('sf_mini_user',array('issend'=>$uptime),array('openid'=>$openid,'uniacid'=>$_W['uniacid']));

    exit;
}
$account = WeAccount::create($_W['uniacid']);
$access_token=$account->getAccessToken();

$xtime=strtotime(date('y-m-d'));

$stime=time()-48*3600;
$data['data'] = pdo_fetchall("select distinct(s.openid) from ims_sf_mini_sign s LEFT JOIN ims_sf_mini_user u ON s.openid=u.openid where s.addtime < $xtime AND s.uptime <> $uptime AND u.lasttime > $stime AND u.issend<> $uptime AND s.uniacid=:uniacid limit 100",array(':uniacid' =>$_W['uniacid']));
//$data['data'] = pdo_fetchall("select s.openid from ims_sf_mini_sign s LEFT JOIN ims_sf_mini_user u ON s.openid=u.openid where s.addtime < $xtime AND s.uptime <> $uptime AND u.lasttime > $stime AND s.uniacid=:uniacid",array(':uniacid' =>$_W['uniacid']));
$set = pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE`uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));

$data['set']=$set;
$data['accesstoken']=$access_token;
echo  json_encode($data);
//echo "<pre>";
//var_dump("select s.openid from ims_sf_mini_sign s LEFT JOIN ims_sf_mini_user u ON s.openid=u.openid where s.addtime < $xtime AND s.uptime <> $uptime AND u.lasttime > $stime AND u.issend<> $uptime AND s.uniacid=6 limit 100");
//var_dump($data['data']);
//echo "</pre>";
//exit();


class post{
    //客服接口发消息
    public function posttemp($openid,$accesstoken){

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
                                         "url":"http://bf.jinpijia.com/app/index.php?i=4&c=entry&do=index&m=we7_shangfo",
                                         "picurl":""
                                     }

                                     ]
                        }
                    }';
        $res=$this->api_notice_increment($url,$post_json);
        return $res;
    }

    private function api_notice_increment($url, $data){
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
}



