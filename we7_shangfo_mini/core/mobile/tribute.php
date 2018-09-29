<?php

global $_GPC, $_W;
$op = $operation = $_GPC['op'] ? $_GPC['op'] : 'display';

load()->func('tpl');
load()->func('logging');





/*修改开始*/
$openid=$_W['openid'];
//
//$head=getheaderx();
//$openid=$head['Openid'];
//$openid='oz1S6vz_MbH-eLtLHri1uwqTRgIo';

//load()->func('logging');
//记录文本日志

//logging_run('fdsfds');

//var_dump($openid);
//
//exit();
//$openid='omV-iwXEIC_NJXEibVWpxSFRXmyE';
///*修改结束*/

$kind=1;
$title='供品';

if($operation=='display'){



    $userinfo = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  `uniacid`=:uniacid and openid=:openid",array(':uniacid' =>$_W['uniacid'],'openid'=>$openid));
    $item = pdo_fetch("SELECT * FROM " .tablename('sf_mini_exeset') ." WHERE `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid']));
    $item['ftitle']=str_replace('[nick]',$userinfo['nickname'],$item['ftitle']);
    $item['fcontent']=str_replace('[nick]',$userinfo['nickname'],$item['fcontent']);
    $flower = pdo_fetchall("SELECT * FROM " .tablename('sf_mini_price') ." WHERE  class=:class  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':class' => 1));
    $stove = pdo_fetchall("SELECT * FROM " .tablename('sf_mini_price') ." WHERE  class=:class  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':class' => 2));
    $fruit = pdo_fetchall("SELECT * FROM " .tablename('sf_mini_price') ." WHERE  class=:class  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':class' => 3));

}elseif($op=='update'){
    logging_run('更新：');
    $signres = pdo_fetch("SELECT * FROM " .tablename('sf_mini_sign') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));

//    $userinfo=$this->get_user_info($openid);
    $userinfo = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));
    $time=strtotime(date("Y-m-d"));
    $up_total = pdo_fetchcolumn("SELECT COUNT(*) FROM ".tablename('sf_mini_uplog')."where openid=:openid  and `uniacid`=:uniacid and uptime>:uptime",array(':uniacid' =>$_W['uniacid'],':openid' => $openid,'uptime'=>$time));

    $data['openid']=$openid;
    $data['nickname']=$userinfo['nickname'];
    $data['addtime']=time();
    $data['uptime']=date('y')+date('m')+date('d');
    $data['uniacid']=$_W['uniacid'];
    $data1['uniacid']=$_W['uniacid'];
    $data1['openid']=$openid;
    $data1['nickname']=$userinfo['nickname'];
    $data1['goodsid']=$_POST['goodsid'];
    $data1['goods']=$_POST['goods'];
    $data1['pay']=$_POST['total_money'];
    $data1['upnum']=date('y')+date('m')+date('d');


    if($up_total>=3){
        $backdata['status'] = 2;
        $backdata['msg'] = '您今天的上佛次数已用完';
        message($backdata,'','ajax');
    }


    if($_POST['id'] && $_W['isajax']){
        if($signres){

            if($data['uptime']-$signres['uptime']>1){//大于1表示没有连续签到
                $data['totatime']=$signres['totatime']+1;
                $data['andtime']=1;
                $data1['uptime']=time();
                $bb= pdo_insert('sf_mini_uplog',$data1);


            }elseif($data['uptime']-$signres['uptime']<0){//小于0表示下一个月
                $xtime=strtotime('+1 day',strtotime(date('y-m-d',$signres['addtime'])))-$signres['addtime']+3600*24;//大于该值表示未连续签到
                if((time()-$signres['addtime'])>$xtime){
                    $data['totatime']=1;
                    $data['andtime']=1;
                    $data1['uptime']=time();
                    $bb= pdo_insert('sf_mini_uplog',$data1);
                }else{//连续签到
                    $data['totatime']=1;
                    if($up_total==0){
                        $data['andtime']=$signres['andtime']+1;
                    }

                    $data1['uptime']=time();
                    $bb= pdo_insert('sf_mini_uplog',$data1);
                    $this->qiandao($data['andtime']);//签到7天或7的倍数得牌位
                }

            }else{//等于1表示连续签到
                $data['totatime']=$signres['totatime']+1;
                if($up_total==0){
                    $data['andtime']=$signres['andtime']+1;
                }
                $data1['uptime']=time();
                $bb= pdo_insert('sf_mini_uplog',$data1);
                $this->qiandao($data['andtime']);//签到7天或7的倍数得牌位
            }
            $aa=pdo_update('sf_mini_sign',$data,array('openid'=>$openid));

            if($aa&&$bb){
                $backdata['status'] = 1;
                $backdata['msg'] = '成功';
                message($backdata,'','ajax');
                die();
            }else{
                $backdata['status'] = 2;
                $backdata['msg'] = '失败';
                message($backdata,'','ajax');
            }
        }else{
            $data['totatime']=1;
            $data['andtime']=1;
            $aa= pdo_insert('sf_mini_sign',$data);
            $data1['uptime']=time();
            $bb= pdo_insert('sf_mini_uplog',$data1);
            if($bb&&$aa){
                $backdata['status'] = 1;
                $backdata['msg'] ='成功';
                message($backdata,'','ajax');
            }else{
                $backdata['status'] = 2;
                $backdata['msg'] = '失败';
                message($backdata,'','ajax');
            }
        }
    }
}elseif($op=='pay_info'){

    $openid=$_POST['openid'];

//    logging_run('其它pay_info：'.$openid);


    $wx=new wxfunc();

    $setting=uni_setting($_W['uniacid'],'payment');

    $wechat=$setting['payment']['wechat'];
    $key=$wechat['apikey'];
    $mch_id=$wechat['mchid'];
    $appid=$_W['account']['key'];

    $user_info = pdo_fetch("SELECT * FROM " .tablename('sf_mini_user') ." WHERE  openid=:openid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':openid' => $openid));

    $need_pay_money=$_POST['total_money']*100;
    $xmlarr['appid'] = $appid;
    $xmlarr['mch_id'] = $mch_id;
    $xmlarr['nonce_str'] = $wx->create_noncestr();
    $xmlarr['body'] = '贡品付费';
    $xmlarr['out_trade_no'] = $wx->create_out_trade_no();
    $_SESSION['oid'] = $xmlarr['out_trade_no']; // 把本次生成的订单号存入session中，保存购买记录的时候用到
    $xmlarr['total_fee'] = $need_pay_money;
    $xmlarr['spbill_create_ip'] =$_SERVER["REMOTE_ADDR"];
    $xmlarr['notify_url'] = $_W['siteroot'] . "addons/we7_shangfo_mini/payment/wechat/notify.php";

    $xmlarr['trade_type'] = "APP";
   // $xmlarr['openid'] =$openid;


    $xmlarr['sign'] = $wx->getSign($xmlarr);

    $xml = "<xml>";

//    $xml .= "<appid>" . $xmlarr['appid'] . "</appid>
//								<body>" . $xmlarr['body']. "</body>
//								<mch_id>" . $xmlarr['mch_id']. "</mch_id>
//								<nonce_str>" . $xmlarr['nonce_str']. "</nonce_str>
//								<notify_url>" . $xmlarr['notify_url']."</notify_url>
//								<out_trade_no>" . $xmlarr['out_trade_no']. "</out_trade_no>
//								<openid>".$xmlarr['openid']. "</openid>
//								<spbill_create_ip>".$xmlarr['spbill_create_ip']."</spbill_create_ip>
//								<total_fee>".$xmlarr['total_fee']."</total_fee>
//								<trade_type>APP</trade_type>
//								<sign>". $xmlarr['sign']."</sign>";
//    $xml .= "</xml>";
//

    $xml .= "<appid>" . $xmlarr['appid'] . "</appid>
								<body>" . $xmlarr['body']. "</body>
								<mch_id>" . $xmlarr['mch_id']. "</mch_id>
								<nonce_str>" . $xmlarr['nonce_str']. "</nonce_str>
								<notify_url>" . $xmlarr['notify_url']."</notify_url>
								<out_trade_no>" . $xmlarr['out_trade_no']. "</out_trade_no>							 
								<spbill_create_ip>".$xmlarr['spbill_create_ip']."</spbill_create_ip>
								<total_fee>".$xmlarr['total_fee']."</total_fee>
								<trade_type>APP</trade_type>
								<sign>". $xmlarr['sign']."</sign>";
    $xml .= "</xml>";


    $url = "https://api.mch.weixin.qq.com/pay/unifiedorder";
    $response = $wx->postXmlCurl($xml, $url);
    $micropayCallResult = $wx->xmlToArray($response);
//    var_dump($micropayCallResult);
//    exit();


    if ($micropayCallResult["return_code"] == "FAIL") {

    } else if ($micropayCallResult["result_code"] == "FAIL") {

    } else if ($micropayCallResult["result_code"] == "SUCCESS" && $micropayCallResult["return_code"] == "SUCCESS") {
        $prepay_id = $micropayCallResult['prepay_id'];
    }
    if ($prepay_id) {
        $backdata['status'] = 1;
        /**增加内容*/

         /*增加内容结束*/

        $oddata['uniacid']=$_W['uniacid'];
        $oddata['oid']=$_SESSION['oid'];
        $oddata['nickname']=$user_info['nickname'];
        $oddata['uid']=$user_info['id'];
        $oddata['addtime']=date("Y-m-d H:i:s");
        $oddata['prepay_id']=$prepay_id;
        $oddata['total_fee']=$need_pay_money/100;
        $oddata['openid']=$openid;
        $bb= pdo_insert('sf_mini_order',$oddata);

        $backdata['prepay_id'] =$prepay_id;

        message($backdata,'','ajax');

        $tims = time();
        $nonstr = $wx->create_noncestr();
        $stringA = "appId=" .$appid . "&nonceStr=$nonstr&package=prepay_id=$prepay_id&signType=MD5&timeStamp=$tims";
        $stringB = $stringA . "&key=" . $key;


        $backdata['status'] = 1;
        $backdata['timeStamp'] = $tims;
        $backdata['nonceStr'] = $nonstr;
        $backdata['package'] = "prepay_id=$prepay_id";
        $backdata['paySign'] = strtoupper(md5($stringB));

       message($backdata,'','ajax');
    }else{

        $backdata['status'] = 2;
        $backdata['msg'] = '不存在prepay_id';
        message($backdata,'','ajax');
    }
}

include $this->template('tribute');
class wxfunc{
    // 微信支付相关funciton
    public function create_noncestr($length = 16)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i ++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }

    // 把数组中的元素根据大小写进行排序,签名算法中有要求
    public function formatBizQueryParaMap($paraMap, $urlencode)
    {
        $buff = "";
        ksort($paraMap);
        foreach ($paraMap as $k => $v) {
            if ($urlencode) {
                $v = urlencode($v);
            }
            $buff .= strtolower($k) . "=" . $v . "&";
        }
        $reqPar = '';
        if (strlen($buff) > 0) {
            $reqPar = substr($buff, 0, strlen($buff) - 1);
        }
        return $reqPar;
    }

    /* 签名算法 */
    public function getSign($Obj)
    {    global $_W;
        $setting=uni_setting($_W['uniacid'],'payment');

        $wechat=$setting['payment']['wechat'];
        $key=$wechat['apikey'];
        foreach ($Obj as $k => $v) {
            $Parameters[strtolower($k)] = $v;
        }
        // 签名步骤一：按字典序排序参数
        ksort($Parameters);
        $String = $this->formatBizQueryParaMap($Parameters, false);
        // echo "【string】 =".$String."</br>";
        // 签名步骤二：在string后加入KEY
        $String = $String . "&key=" .$key;
        // echo "【string】 =".$String."</br>";
        // 签名步骤三：MD5加密
        $result_ = strtoupper(md5($String));
        return $result_;
    }

    /* 数组转换成XML格式 */
    public function arrayToXml($arr)
    {
        $xml = "<xml>";
        foreach ($arr as $key => $val) {
            if (is_numeric($val)) {
                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";
            } else
                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";
        }
        $xml .= "</xml>";
        return $xml;
    }

    /* xml转换成数组 */
    public function xmlToArray($xml)
    {
        // 将XML转为array
        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);
        return $array_data;
    }
    /* 生成商户订单号 */
    public function create_out_trade_no()
    {
        global $_W;
        $out_trade_no = '';
        $last_char = $this->create_noncestr();
        $out_trade_no = time() . $last_char;
        $temp_result = pdo_fetch("SELECT * FROM " .tablename('sf_mini_order') ." WHERE  oid=:oid  and `uniacid`=:uniacid",array(':uniacid' =>$_W['uniacid'],':oid' => $out_trade_no));
        if ($temp_result) {
            $this->create_out_trade_no();
        } else {
            return $out_trade_no;
        }
    }
    public function postXmlCurl($xml, $url)
    {
        $curl = curl_init(); // 启动一个CURL会话
        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在
        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器
        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转
        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer
        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求
        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml); // Post提交的数据包
        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环
        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回
        $tmpInfo = curl_exec($curl); // 执行操作
        if (curl_errno($curl)) {
            $this->writeLog('Errno' . curl_error($curl)); // 捕抓异常
            exit();
        }
        curl_close($curl); // 关闭CURL会话
        return $tmpInfo; // 返回数据
    }
}
