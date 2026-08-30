<?php

namespace easyBilling\models;

class Subscription extends Common
{

    /**
     * @param $customerId
     * @param $productId
     * @param $productInstanceId
     * @param $rateId
     * @param $skipTransactionRemainingDays
     * @param $skipDuplicateError
     * @return mixed
     */
    public function create($customerId, $productId, $productInstanceId, $rateId, $skipTransactionRemainingDays = null, $skipDuplicateError = null)
    {
        $params = [
            'product_id' => $productId,
            'rate_id' => $rateId,
            'customer_id' => $customerId,
            'product_instance_id' => $productInstanceId,
            'skip_transaction_remaining_days' => $skipTransactionRemainingDays,
            'skip_duplicate_error' => $skipDuplicateError,
        ];
        $res = $this->request('/subscription', $params, 'POST');
        return $res;
    }

}