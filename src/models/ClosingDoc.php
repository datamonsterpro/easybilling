<?php

namespace easyBilling\models;

class ClosingDoc extends Common
{

    const TYPE_ID_CERTIFICATE_OF_COMPLETION_OF_WORK = 1;

    public function create($customerId, $typeId, $dateAt, $url)
    {
        $params = [
            'customer_id' => $customerId,
            'type_id' => $typeId,
            'date_at' => $dateAt,
            'url' => $url
        ];
        $res = $this->request('/closing-doc', $params, 'POST');
        return $res;
    }

    public function removeAll($customerId)
    {
        $params = [
            'customer_id' => $customerId,
        ];
        $res = $this->request('/closing-doc/remove-all', $params, 'POST');
        return $res;
    }
}