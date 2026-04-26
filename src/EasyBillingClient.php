<?php

namespace easyBilling;

use easyBilling\models\Customer;
use easyBilling\models\Subscription;
use easyBilling\models\Transaction;

class EasyBillingClient
{
    /**
     * @var Customer
     */
    public $customer;

    /**
     * @var Subscription
     */
    public $subscription;

    /**
     * @var Transaction
     */
    public $transaction;

    public function __construct($token)
    {
        $this->customer = new Customer($token);
        $this->subscription = new Subscription($token);
        $this->transaction = new Transaction($token);
    }

}