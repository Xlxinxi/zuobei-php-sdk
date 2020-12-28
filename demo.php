<?php

header("Content-Type:application/json;charset=utf-8");
$ch = curl_init();

//设置验证方式
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type:application/json;charset=utf-8',
]);
//设置返回结果为流
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

//设置超时时间
curl_setopt($ch, CURLOPT_TIMEOUT, 10);

//设置通信方式
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);


//设置请求接口，这里以发送普通短信为例
//curl_setopt($ch, CURLOPT_URL, 'http://yx.sms.zuiniu.xin:9090/sms/batch/v1');
curl_setopt($ch, CURLOPT_URL, 'http://yx.sms.zuiniu.xin:9090/sms/report/v1');

//配置请求参数
$time = getMillisecond();
$appkey = "xxx";
$appcode = "xxx";
$appsecret = "xxx";
$param = [];
$param['appkey'] = $appkey;
$param['appcode'] = $appcode;
$param['sign'] = md5($appkey . $appsecret . $time);
$param['timestamp'] = $time;
$param['uid'] = '';
$param['phone'] = '13888888888';
$param['msg'] = '发送内容';
//$param['send_time'] = date('Y-m-d H:i:s', time() + 600);十分钟后发送
//$param['extend'] = "";

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($param));
$result = curl_exec($ch);
$error = curl_error($ch);
return $result;


function getMillisecond() {
    list($t1, $t2) = explode(' ', microtime());
    return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
}