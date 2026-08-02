<?php

namespace easyBilling\models;

class Transaction extends Common
{

    const TYPE_ID_REAL = 1;
    const TYPE_ID_TEST = 2;
    const TYPE_ID_CORRECTION = 3;

    const ACTION_ID_INCOME = 1;
    const ACTION_ID_OUTGOING = 2;

    const PAYMENT_TYPE_ID_CARD = 1;
    const PAYMENT_TYPE_ID_INVOICE = 2;
    const PAYMENT_TYPE_ID_CARD_TO_CARD = 3;
    const PAYMENT_TYPE_ID_MANUAL = 4;
    const PAYMENT_TYPE_ID_SYSTEM = 5;

    const CATEGORY_ID_INCOME = 1;
    const CATEGORY_ID_OUTGOING_TRAFFIC = 3;
    const CATEGORY_ID_OUTGOING_SUBSCRIPTION = 4;
    const CATEGORY_ID_OUTGOING_OTHER = 10;

    public function create($customerId, $actionId, $categoryId, $typeId, $paymentTypeId, $amount, $externalTransactionId, $productId, $rateId, $comment, $createdAt = null)
    {
        $params = [
            'customer_id' => $customerId,
            'action_id' => $actionId,
            'category_id' => $categoryId,
            'type_id' => $typeId,
            'payment_type_id' => $paymentTypeId,
            'amount' => $amount,
            'external_transaction_id' => $externalTransactionId,
            'product_id' => $productId,
            'rate_id' => $rateId,
            'comment' => $comment,
            'created_at' => $createdAt
        ];
        $res = $this->request('/transaction', $params, 'POST');
        return $res;
    }

    public function removeAll($customerId)
    {
        $params = [
            'customer_id' => $customerId,
        ];
        $res = $this->request('/transaction/remove-all', $params, 'POST');
        return $res;
    }

}