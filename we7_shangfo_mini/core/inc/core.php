<?phpclass core extends WeModuleSite{    public function __construct()    {        global $_W;//        $head = getheaderx();//        if (!empty($head['Openid']) && isset($head['Openid'])) {//            $_W['openid'] = $head['Openid'];//            $_SESSION['openid'] = $head['Openid'];//        } else {//            if ((!isset($_SESSION['openid'])) || empty($_SESSION['openid'])) {//////                if (isset($_W["openid"]) && !empty($_W["openid"])) {//                    $_SESSION['openid'] = $_W["openid"];//                }//            }////        }        if(empty($_SESSION['userinfo']))        {            return ;        }        if ((!isset($_SESSION['openid'])) || empty($_SESSION['openid'])) {            if (isset($_W["openid"]) && !empty($_W["openid"])) {                $_SESSION['openid'] = $_W["openid"];            }        }//        var_dump($head);exit;//        $_W['openid']='oz1S6v487CKFzsZSVW2OTv36F58k';        $openid = $_SESSION['openid'];        $user = pdo_fetch("SELECT * FROM " . tablename('sf_mini_user') . " WHERE  openid=:openid  and `uniacid`=:uniacid", array(':uniacid' => $_W['uniacid'], ':openid' => $openid));        $userinfo = mc_oauth_userinfo();    }    function get_user_info()    {        echo 'a';    }    public function qiandao($andtime)    {        global $_GPC, $_W;        $res = pdo_fetchall("SELECT id FROM " . tablename("sf_mini_paiwei") . " where uniacid=:uniacid ", array('uniacid' => $_W['uniacid']));        foreach ($res as $k => $v) {            $nums[$k] = $v['id'];        }        if ($andtime % 7 == 0) { //连续签到7天或7的倍数得排位            $userinfo = $this->get_user_info($_W['openid']);            $data2['id'] = $userinfo['id'];            if ($userinfo['paiwei'] == '') {                $res = array_rand($nums, 1);                $getnum = $nums[$res];                $data2['paiwei'] = strval($getnum);                pdo_update('sf_mini_user', $data2, array('id' => $userinfo['id']));                return $getnum;            } else {                $qqq = explode(',', $userinfo['paiwei']);                foreach ($nums as $key => $v1) {                    foreach ($qqq as $key2 => $v2) {                        if ($v1 == $v2) {                            unset($nums[$key]);//删除$a数组同值元素                        }                    }                }                if (empty($nums)) {                    return false;                } else {                    $res = array_rand($nums, 1);                    $getnum = $nums[$res];                    $data2['paiwei'] = $userinfo['paiwei'] . ',' . strval($getnum);                    pdo_update('sf_mini_user', $data2, array('id' => $userinfo['id']));                }                return $getnum;            }        }    }    // 微信支付相关funciton    private function create_noncestr($length = 16)    {        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";        $str = "";        for ($i = 0; $i < $length; $i++) {            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);        }        return $str;    }    // 把数组中的元素根据大小写进行排序,签名算法中有要求    private function formatBizQueryParaMap($paraMap, $urlencode)    {        $buff = "";        ksort($paraMap);        foreach ($paraMap as $k => $v) {            if ($urlencode) {                $v = urlencode($v);            }            $buff .= strtolower($k) . "=" . $v . "&";        }        $reqPar = '';        if (strlen($buff) > 0) {            $reqPar = substr($buff, 0, strlen($buff) - 1);        }        return $reqPar;    }    /* 签名算法 */    private function getSign($Obj)    {        foreach ($Obj as $k => $v) {            $Parameters[strtolower($k)] = $v;        }        // 签名步骤一：按字典序排序参数        ksort($Parameters);        $String = $this->formatBizQueryParaMap($Parameters, false);        // echo "【string】 =".$String."</br>";        // 签名步骤二：在string后加入KEY        $String = $String . "&key=" . C('key');        // echo "【string】 =".$String."</br>";        // 签名步骤三：MD5加密        $result_ = strtoupper(md5($String));        return $result_;    }    /* 数组转换成XML格式 */    private function arrayToXml($arr)    {        $xml = "<xml>";        foreach ($arr as $key => $val) {            if (is_numeric($val)) {                $xml .= "<" . $key . ">" . $val . "</" . $key . ">";            } else                $xml .= "<" . $key . "><![CDATA[" . $val . "]]></" . $key . ">";        }        $xml .= "</xml>";        return $xml;    }    /* xml转换成数组 */    private function xmlToArray($xml)    {        // 将XML转为array        $array_data = json_decode(json_encode(simplexml_load_string($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);        return $array_data;    }    /* 生成商户订单号 */    private function create_out_trade_no()    {        $out_trade_no = '';        $last_char = $this->create_noncestr();        $out_trade_no = time() . $last_char;        $vip_buy_user = M('order');        $conditio['oid'] = $out_trade_no;        $temp_result = $vip_buy_user->where($conditio)->select();        if ($temp_result) {            $this->create_out_trade_no();        } else {            return $out_trade_no;        }    }    private function postXmlCurl($xml, $url)    {        $curl = curl_init(); // 启动一个CURL会话        curl_setopt($curl, CURLOPT_URL, $url); // 要访问的地址        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0); // 对认证证书来源的检查        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 1); // 从证书中检查SSL加密算法是否存在        curl_setopt($curl, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']); // 模拟用户使用的浏览器        curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1); // 使用自动跳转        curl_setopt($curl, CURLOPT_AUTOREFERER, 1); // 自动设置Referer        curl_setopt($curl, CURLOPT_POST, 1); // 发送一个常规的Post请求        curl_setopt($curl, CURLOPT_POSTFIELDS, $xml); // Post提交的数据包        curl_setopt($curl, CURLOPT_TIMEOUT, 30); // 设置超时限制防止死循环        curl_setopt($curl, CURLOPT_HEADER, 0); // 显示返回的Header区域内容        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); // 获取的信息以文件流的形式返回        $tmpInfo = curl_exec($curl); // 执行操作        if (curl_errno($curl)) {            $this->writeLog('Errno' . curl_error($curl)); // 捕抓异常            exit();        }        curl_close($curl); // 关闭CURL会话        return $tmpInfo; // 返回数据    }}