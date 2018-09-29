<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/10/20
 * Time: 13:19
 */
function is_weixin()
{
    if (empty($_SERVER['HTTP_USER_AGENT']) || strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') === false && strpos($_SERVER['HTTP_USER_AGENT'], 'Windows Phone') === false) {
        return false;
    }
    return true;
}
function a (){
    echo '123';
}

function getheaderx()
{
    $headers = array();
    foreach ($_SERVER as $key => $value) {
        if (substr($key, 0, 5) === 'HTTP_') {
            $key = substr($key, 5);
            $key = strtolower($key);
            $key = str_replace('_', ' ', $key);
            $key = ucwords($key);
            $key = str_replace(' ', '-', $key);
            $headers[$key] = $value;
        }
    }
    return $headers;
}

function getwxinfo(){


   // Sex，Nickname       Headimgurl  Openid

}