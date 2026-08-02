<?php

namespace easyBilling\models;

class PromisedPayment extends Common
{

    public function create($promisedPaymentId, $customerId, $amount)
    {
        $params = [
            'promised_payment_id' => $promisedPaymentId,
            'customer_id' => $customerId,
            'amount' => $amount,
        ];
        $res = $this->request('/promised-payment', $params, 'POST');
        return $res;
    }

}