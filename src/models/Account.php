<?php

namespace easyBilling\models;

class Account extends Common
{
    public function checkConnection()
    {
        $params = [
        ];
        $res = $this->request('/account/check', $params, 'POST');
        return $res;
    }

}