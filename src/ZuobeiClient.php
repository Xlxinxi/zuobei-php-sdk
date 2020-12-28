<?php


namespace Zuobei\Sdk;


use Zuobei\Sdk\Api\ApiFactory;

class ZuobeiClient {

    use ZuobeiGuzzle;

    /**
     *
     * @var ApiFactory
     */
    private $api;

    /**
     *
     * @var string
     */
    private $appkey;

    /**
     *
     * @var string
     */
    private $appcode;

    /**
     *
     * @var string
     */
    private $appsecret;

    function __construct() {
        $this->api = new Api\ApiFactory($this);
    }

    static function create($appkey, $appcode, $appsecret) {
        $clnt = new ZuobeiClient();
        $clnt->appkey = $appkey;
        $clnt->appcode = $appcode;
        $clnt->appsecret = $appsecret;
        $clnt->initHttp();
        return $clnt;
    }

    public function appkey() {
        return $this->appkey;
    }

    public function appcode() {
        return $this->appcode;
    }

    public function appsecret() {
        return $this->appsecret;
    }

    public function api() {
        return $this->api->api('sms');
    }

}