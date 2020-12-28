<?php


namespace Zuobei\Sdk;


use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;

trait ZuobeiGuzzle {

    /**
     *
     * @var Client
     */
    private $http;

    /**
     * http charset
     *
     * @var string
     */
    private $charset;


    /**
     *
     * @return \GuzzleHttp\Client
     */
    protected function initHttp() {
        $client = new Client($this->httpDefOptions());
        $this->http = $client;
        return $client;
    }

    protected function httpDefOptions() {
        return [
            'timeout' => 6.0,
        ];
    }


    /**
     *
     * @param string $uri
     * @param array $data
     *
     * @return mixed
     */
    function post($uri, array &$data) {
        $options = [];
        $options['headers'] = ['Content-Type' => "application/json;charset=utf-8"];
        $options['json'] = $data;

        try {
            $rsp = $this->http()->post($uri, $options);
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $rsp = $e->getResponse();
        }
        return $this->toJson($rsp);
    }

    /**
     *
     * @param ResponseInterface $rsp
     *
     * @return mixed
     */
    function toJson(ResponseInterface $rsp) {
        return \GuzzleHttp\json_decode($rsp->getBody()->getContents(), TRUE);
    }

    /**
     *
     * @return \GuzzleHttp\Client
     */
    function http() {
        return $this->http;
    }

}