<?php

namespace qubeans\qubeans;

//require_once 'Transaction.php';
use \Transaction;
use ErrorException;

class Index{

    public $till_number;
    public $clientSecret;
    public $SUCCESSFUL = 200;
    public $TRANSACTION_DOES_NOT_EXIST = 404;
    public $transaction = null;
    public $status;

    public function __construct($till_no, $client_secret)
    {
        $this->till_number = $till_no;
        $this->clientSecret = $client_secret;
    }

    public function find($tid){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'https://api.soofapay.com/v1/transactions/'.$tid.'/');


        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-TILL: '.$this->till_number,'Authorization: '.$this->clientSecret));
        $response = curl_exec($ch);

        $this->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);



        if($this->status == $this->SUCCESSFUL){
            $result = json_decode($response);
            $this->transaction = new Transaction($result);
            return $this->transaction;
        }elseif ($this->status == $this->TRANSACTION_DOES_NOT_EXIST){
            throw new ErrorException('Transaction of id '.$tid.' does not exist');
        }elseif ($this->status === 403){
           throw new ErrorException("Your are not allowed to perform this action. Please ensure you use your correct till number and client_secret");
        }
    }

    public function getTransaction(){
        if($this->transaction === null){
            throw new ErrorException("A transaction is not available yet. Please ensure you call find method and verify that one exists before proceeding");
        }else{
            return $this->transaction;
        }
    }

    public function getBalance(){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,'http://api.soofapay.com/v1/balance/');


        curl_setopt($ch, CURLOPT_HEADER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('X-TILL: '.$this->till_number,'Authorization: '.$this->clientSecret));
        $response = curl_exec($ch);

        $this->status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);



        if($this->status == $this->SUCCESSFUL){
            $result = json_decode($response);
            return $result;
        }elseif ($this->status === 403){
            throw new ErrorException("Your are not allowed to perform this action.");
        }
    }
}