<?php

namespace easyBilling\models;

class Discount extends Common
{
    public function create($customerId, $productId, $rateId, $discountPercent, $discountAmount, $expiresAt)
    {
        $params = [
            'customer_id' => $customerId,
            'product_id' => $productId,
            'rate_id' => $rateId,
            'discount_percent' => $discountPercent,
            'discount_amount' => $discountAmount,
            'expires_at' => $expiresAt
        ];
        $res = $this->request('/discount', $params, 'POST');
        return $res;
    }

    public function removeAll($customerId)
    {
        $params = [
            'customer_id' => $customerId,
        ];
        $res = $this->request('/discount/remove-all', $params, 'POST');
        return $res;
    }
}