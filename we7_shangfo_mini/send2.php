<?php
ini_set('max_execution_time', '0');
require '../../framework/bootstrap.inc.php';
$account = WeAccount::create(4);
$access_token=$account->getAccessToken();
load()->func('logging');
//ignore_user_abort(true);

set_time_limit(0);

$mysqli = new mysqli('127.0.0.1','root','adf45382fc','shangfo');

if (mysqli_connect_errno()){
    die('Unable to connect!'). mysqli_connect_error();
}
$xtime=strtotime(date('y-m-d'));
$uptime=date('y')+date('m')+date('d');
$stime=time()-48*3600;
$sql="select s.openid from ims_sf_sign s LEFT JOIN ims_sf_user u ON s.openid=u.openid where s.addtime < $xtime AND s.uptime <> $uptime AND u.lasttime > $stime";
//执行sql语句，完全面向对象的
$result = $mysqli->query($sql);//要发送消息的openid

$sql="select * from ims_sf_exeset where uniacid=4";

$result1 = $mysqli->query($sql);

$set=$result1->fetch_assoc();

mysqli_close($mysqli);

$sstime=$set['stime'];
$time=strtotime('+1 day');
$date=date('Y-m-d '.$sstime,$time);
$xxtime=strtotime($date);
$wx=new post();
if($set['status'] !=1){
    exit;
}
while($row = $result->fetch_array()){

//        $res=$wx->posttemp($row[0],$access_token);
//    logging_run(var_export($res,true));

//    sleep($set['xtime']);
}
$sleeptime=$xxtime-time();
sleep($sleeptime);






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



