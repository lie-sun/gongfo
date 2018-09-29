<?php
//每天供佛 发送消息

load()->model('account');
$data=uni_owned();
echo json_encode($data);
//echo "<pre>";
//var_dump($data);
//echo "</pre>";
exit;
$wx=new post();

$url='http://bf.jinpijia.com/app/index.php?i=4&c=entry&do=send&m=we7_shangfo';
$data=$wx->get_from_curl($url);
$dataopenid=$data['data'];
$accesstoken=$data['accesstoken'];
$set=$data['set'];

//每天执行间隔时间
$sstime=$set['stime'];
$time=strtotime('+1 day');
$date=date('Y-m-d '.$sstime,$time);
$xxtime=strtotime($date);

//var_dump($sleeptime);
//var_dump($set['xtime']);
//var_dump($dataopenid);
//exit;
if($set['status'] ==1){
	foreach($dataopenid as $k=>$v){
		var_dump($v['openid']);
//	$wx->posttemp($v['openid'],$accesstoken);
	$wx->posttemp('o8G8SwPR0VsaMi03oBVrBp3udyBY',$accesstoken);

	$wx->api_notice_increment($url,array('openid'=>'o8G8SwPR0VsaMi03oBVrBp3udyBY'));
//		    sleep($set['xtime']);

	}
}elseif($set['status']==0){
	exit();
}elseif($set['status']==2){

}
//$sleeptime=$xxtime-time();
//sleep($sleeptime);



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
}