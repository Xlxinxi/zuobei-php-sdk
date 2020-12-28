<?php


namespace Zuobei\Sdk\Api;


class ApiResult {

    private $data;

    function __construct($data) {
        $this->data = $data;
    }

    function isSucc() {
        if (isset($rsp['code']) && $rsp['code'] == '00000') {
            return TRUE;
        }
        else {
            return FALSE;
        }
    }

    function getData() {
        return $this->data;
    }

}