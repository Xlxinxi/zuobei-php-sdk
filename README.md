zuobei-php-sdk
================================

## 快速开始

- 添加composer依赖

```
composer require zuobei/zuobei-php-sdk
```

- 初始化ZuobeiClient

```php
use Zuobei\Sdk\ZuobeiClient;

//初始化client
$client = ZuobeiClient::create($appkey, $appcode, $appsecret);

//下发，$phone手机号码，$msg短信发送内容
$req = $client->api()->batch($phone, $msg);
//$send_time 发送时间,选填,格式样例：2020-06-22 08:00:00定时时间须当前时间10分钟后为空或格式不正确，为立即发送
//$extend 扩展号 选填
//$req = $client->api()->batch($phone, $msg,$send_time,$extend);
if ($req->isSucc()){
    //操作成功
    $req->getData();//获取接口返回信息。
}else{
    //操作失败
    $req->getData();//依然可以获取接口返回信息。
}

//状态报告用户自取
//同一条数据只能获取一次，可通过参数获取指定数量，以实际获取数量为准。
//$number选填可为空，数字，范围1到1000不在该范围采用默认值200
$req = $client->api()->report($number);

//上行用户自取
//同一条数据只能获取一次，可通过参数获取指定数量，以实际获取数量为准。
//$number选填可为空，数字，范围1到1000不在该范围采用默认值200
$req = $client->api()->mo($number);

//查询余额
$req = $client->api()->balance();
```

## 源码说明

- 工程使用composer构造，php5.6+
  




