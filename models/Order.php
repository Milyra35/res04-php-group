<?php

class Order {
    private ?int $id;
    private $date;
    private $amount;
    private User $user_id;
    private $products = [];

    public function __construct($date, $amount, $user_id){
        $this->id = null;
        $this->date = $date;
        $this->amount = $amount;
        $this->user_id = $user_id;
        $this->products = [];
    }

    public function getId() : ?int {
        return $this->id;
    }
    public function setId($id) : void {
        $this->id = $id;
    }


    public function getDate(){
        return $this->date;
    }
    public function setDate($date){
        $this->date = $date;
    }


    public function getAmount(){
        return $this->amount;
    }
    public function setAmount($amount){
        $this->amount = $amount;
    }


    public function getUser_id(): User{
        return $this->user_id;
    }
    public function setUser_id($user_id) : void{
        $this->user_id = $user_id;
    }


    public function getProducts(){
        return $this->products;
    }
    public function setProducts($products){
        $this->products = $products;
    }

}




?>