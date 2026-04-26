<?php

namespace easyBilling\models;

use easyBilling\components\JsonHelper;
use easyBilling\components\Logger;
use GuzzleHttp\Client;

class Common
{


    protected $token;

    protected $lastHttpCode;

    const API_URL = 'https://api.easybilling.pro';

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getLastHttpCode()
    {
        return $this->lastHttpCode;
    }

    protected function request($route, $params, $method = 'POST')
    {
        $client = new Client();
        $url = self::API_URL . '/' . trim($route, '/');

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
        ];

        $response = $client->request('POST', $url, [
            'json' => $params,
            'headers' => $headers,
            'http_errors' => false
        ]);

        $this->lastHttpCode = $response->getStatusCode();

        $result = $response->getBody()->getContents();

        if ($this->lastHttpCode === 200) {
            Logger::success($url);
        } else {
            Logger::error($url);
            Logger::error(JsonHelper::encode($result));
        }

        return json_decode($result, true);
    }

}