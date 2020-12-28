<?php


namespace Zuobei\Sdk\Api;


use Zuobei\Sdk\ZuobeiClient;

class BaseApi {

    /**
     *
     * @var \Zuobei\Sdk\ZuobeiClient
     */
    private $clnt;

    /**
     *
     * @var string
     */
    private $host;

    /**
     *
     * @var string
     */
    private $version;

    /**
     *
     * @var string
     */
    private $path;

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

    /**
     *
     * @var string
     */
    private $charset;


    /**
     *
     * @param \Zuobei\Sdk\ZuobeiClient $clnt
     */
    function init(ZuobeiClient $clnt) {
        if (is_null($clnt)) {
            return;
        }
        $this->clnt = $clnt;
        $this->appkey = $clnt->appkey();
        $this->appcode = $clnt->appcode();
        $this->appsecret = $clnt->appsecret();
    }

    /**
     * @param null $host
     *
     * @return $this|string
     */
    function host($host = NULL) {
        if (is_null($host)) {
            return $this->host;
        }

        $this->host = $host;
        return $this;
    }

    function path($path = NULL) {
        if (is_null($path)) {
            return $this->path;
        }

        $this->path = $path;
        return $this;
    }

    function version($version = NULL) {
        if (is_null($version)) {
            return $this->version;
        }

        $this->version = $version;
        return $this;
    }


    public function appkey() {
        return $this->appkey;
    }

    public function appcode() {
        return $this->appkey;
    }

    public function appsecret() {
        return $this->appsecret;
    }


    function uri() {
        return "{$this->host}/{$this->name()}/{$this->path}/{$this->version}";
    }

    function post(array &$param) {
        try {
            $rsp = $this->clnt->post($this->uri(), $param);
            return $this->result($rsp);
        } catch (\Exception $e) {
            return $this->result(["code" => "F0100", "desc" => "请求错误"]);
        }
    }

    //这里不确定返回的内容格式是否一样，所以这里的数据模型先留空
    function result(array $rsp) {
        return new ApiResult($rsp);
    }


}