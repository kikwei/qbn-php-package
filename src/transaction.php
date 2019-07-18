<?php
class Transaction{

    public $sender;
    public $sender_currency;
    public $status;
    public $receiver_currency;
    public $tid;
    public $reference;
    public $receiver;
    public $receipt_no;
    public  $timestamp;
    public $gross_amount;
    public $net_amount;
    public  $transacted_via;
    public $is_money_in;
    public  $as_string;
    /**
     * Transaction constructor.
     * @param $data
     */
    public function __construct($data)
    {
       $this-> sender = $data->sender;
        $this-> sender_currency = $data->sender_currency;
        $this->status = $data->status;
        $this->receiver_currency = $data->receiver_currency;
        $this->tid = $data->tid;
        $this->reference = $data->reference;
        $this->receiver = $data->receiver;
        $this->receipt_no = $data->receipt_no;
        $this->timestamp = $data->timestamp;
        $this->gross_amount = $data->gross_amount;
        $this->net_amount = $data->net_amount;
        $this->transacted_via = $data->transacted_via;
        $this->is_money_in = $data->is_money_in;
        $this->as_string = json_encode($data);

    }


    public function getAsJson(){
        return json_decode($this->as_string);
    }

    /**
     * @return false|string
     */
    public function getAsString()
    {
        return $this->as_string;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getGrossAmount()
    {
        return $this->gross_amount;
    }

    /**
     * @return mixed
     */
    public function getIsMoneyIn()
    {
        return $this->is_money_in;
    }

    /**
     * @return mixed
     */
    public function getNetAmount()
    {
        return $this->net_amount;
    }

    /**
     * @return mixed
     */
    public function getReceiptNo()
    {
        return $this->receipt_no;
    }

    /**
     * @return mixed
     */
    public function getReceiver()
    {
        return $this->receiver;
    }

    /**
     * @return mixed
     */
    public function getReceiverCurrency()
    {
        return $this->receiver_currency;
    }

    /**
     * @return mixed
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getSender()
    {
        return $this->sender;
    }

    /**
     * @return mixed
     */
    public function getSenderCurrency()
    {
        return $this->sender_currency;
    }

    /**
     * @return mixed
     */
    public function getTid()
    {
        return $this->tid;
    }

    /**
     * @return mixed
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * @return mixed
     */
    public function getTransactedVia()
    {
        return $this->transacted_via;
    }


}