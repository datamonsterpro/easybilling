<?php

namespace easyBilling\models;

class Subscription extends Common
{

    /**
     * @param $customerId
     * @param $productId
     * @param $rateId
     * @param $productInstanceId
     * @param $skipTransactionRemainingDays
     * @return mixed
     */
    public function create($customerId, $productId, $productInstanceId, $rateId, $skipTransactionRemainingDays = null)
    {
        $params = [
            'product_id' => $productId,
            'rate_id' => $rateId,
            'customer_id' => $customerId,
            'product_instance_id' => $productInstanceId,
            'skip_transaction_remaining_days' => $skipTransactionRemainingDays
        ];
        $res = $this->request('/subscription', $params, 'POST');
        return $res;
    }

}