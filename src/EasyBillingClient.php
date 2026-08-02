<?php

namespace easyBilling;

use easyBilling\models\ClosingDoc;
use easyBilling\models\Customer;
use easyBilling\models\Discount;
use easyBilling\models\PromisedPayment;
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

    /**
     * @var ClosingDoc
     */
    public $closingDoc;

    /**
     * @var PromisedPayment
     */
    public $promisedPayment;

    /**
     * @var Discount
     */
    public $discount;

    public function __construct($token)
    {
        $this->customer = new Customer($token);
        $this->subscription = new Subscription($token);
        $this->transaction = new Transaction($token);
        $this->closingDoc = new ClosingDoc($token);
        $this->promisedPayment = new PromisedPayment($token);
        $this->discount = new Discount($token);
    }

}