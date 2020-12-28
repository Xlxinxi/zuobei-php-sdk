<?php


namespace Zuobei\Sdk\Api;


use Zuobei\Sdk\ZuobeiClient;

class SmsApi extends BaseApi {

    const NAME = 'sms';

    function init(ZuobeiClient $clnt) {
        parent::init($clnt);
        $this->version("v1");
        $this->host("http://yx.sms.zuiniu.xin:9090");
    }

    public function name() {
        return self::NAME;
    }

    /**
     * @param $phone
     * @param $msg
     * @param string $send_time 发送时间 选填
     * 格式样例：2020-06-22 08:00:00,定时时间须当前时间10分钟后,为空或格式不正确，为立即发送
     * @param string $extend 扩展号，该参数是显示在接收手机上的主叫尾号，可用于上行信息匹配，若不填写则认为不进行扩展（不填写不影响发送）选填可为空数字，如：001,119等通道本身主叫号加上用户自己分配扩展号的总长度不能超过20位
     *
     * @return \Zuobei\Sdk\Api\ApiResult
     */
    public function batch($phone, $msg, $send_time = "", $extend = "") {
        $param = $this->makeCommonParam();
        $param['uid'] = "";//唯一标识（32位字符串以内，用于获取短信回执，不传或者传空字符串系统自动生成32位字符串）
        $param['phone'] = $phone;
        $param['msg'] = $msg;
        $param['send_time'] = $send_time;
        $param['extend'] = $extend;
        return $this->path("batch")->post($param);
    }

    /**
     * @param int $number
     *
     * @return \Zuobei\Sdk\Api\ApiResult
     */
    public function report($number = 200) {
        $param = $this->makeCommonParam();
        $param['number'] = $number;
        return $this->path("report")->post($param);
    }

    /**
     * @param int $number
     *
     * @return \Zuobei\Sdk\Api\ApiResult
     */
    public function mo($number = 200) {
        $param = $this->makeCommonParam();
        $param['number'] = $number;
        return $this->path("mo")->post($param);
    }

    /**
     * @return \Zuobei\Sdk\Api\ApiResult
     */
    public function balance() {
        $param = $this->makeCommonParam();
        return $this->path("balance")->post($param);
    }

    /**
     * @param $time
     *
     * @return string
     */
    private function verifyParam($time) {
        return md5($this->appkey() . $this->appsecret() . $time);
    }

    private function makeCommonParam() {
        $time = $this->getMillisecond();
        return [
            'appkey' => $this->appkey(),
            'appcode' => $this->appcode(),
            'sign' => $this->verifyParam($time),
            'timestamp' => $time,
        ];
    }

    private function getMillisecond() {
        list($t1, $t2) = explode(' ', microtime());
        return (float) sprintf('%.0f', (floatval($t1) + floatval($t2)) * 1000);
    }

}