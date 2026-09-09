<?php

namespace easyBilling\models;

use easyBilling\components\JsonHelper;
use easyBilling\components\Logger;
use GuzzleHttp\Client;
use function Symfony\Component\String\b;

class Common
{


    protected $token;

    protected $lastHttpCode;

    protected $lastUrl;

    const API_URL = 'https://api.easybilling.pro';

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function getLastHttpCode()
    {
        return $this->lastHttpCode;
    }

    public function getLastUrl()
    {
        return $this->lastUrl;
    }

    public function getLastError()
    {
        return $this->lastError;
    }

    protected function request($route, $params, $method = 'POST')
    {
        $client = new Client();
        $url = self::API_URL . '/' . trim($route, '/');

        $headers = [
            'Authorization' => 'Bearer ' . $this->token,
        ];

        switch ($method) {
            case 'GET':
                $url .= '?' . http_build_query($params);
                $response = $client->request('GET', $url, [
                    'headers' => $headers,
                    'http_errors' => false,
                    'verify' => false
                ]);
                break;
            default:
                $response = $client->request('POST', $url, [
                    'json' => $params,
                    'headers' => $headers,
                    'http_errors' => false,
                    'verify' => false
                ]);
        }

        $this->lastHttpCode = $response->getStatusCode();
        $this->lastUrl = $url;

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