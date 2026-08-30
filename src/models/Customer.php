<?php

namespace easyBilling\models;

class Customer extends Common
{

    public function getInfo($email)
    {
        $params = [
            'email' => $email,
        ];
        $res = $this->request('/customer', $params, 'GET');
        return $res;
    }

    public function create($email, $phone, $externalId = null, $contractId = null, $createdAt = null)
    {
        $params = [
            'email' => $email,
            'phone' => $phone,
            'external_id' => $externalId,
            'contract_id' => $contractId,
            'created_at' => $createdAt,
        ];
        $res = $this->request('/customer', $params, 'POST');
        return $res;
    }

    public function createBatch($customers)
    {
        $params = [
            'customers' => $customers
        ];
        $res = $this->request('/customer/create-batch', $params, 'POST');
        return $res;
    }

}