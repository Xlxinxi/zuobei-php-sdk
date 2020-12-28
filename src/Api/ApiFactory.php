<?php


namespace Zuobei\Sdk\Api;


class ApiFactory {

    //这里全部都是预留以后会有多套进行拓展

    private $clnt;

    function __construct($clnt) {
        $this->clnt = $clnt;
    }

    function api($name) {
        $api = NULL;
        switch ($name) {
            case SmsApi::NAME:
                $api = new SmsApi();
                break;
            default:
                $api = new SmsApi();
        }

        $api->init($this->clnt);
        return $api;
    }

}