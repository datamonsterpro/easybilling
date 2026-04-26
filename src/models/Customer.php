<?php

namespace easyBilling\models;

class Customer extends Common
{

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

}