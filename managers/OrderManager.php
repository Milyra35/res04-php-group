<?php

class OrderManager extends AbstractManager {
    
    //Push new order in the database
    public function insertOrder(Order $order){
        
        //Prepare the query
        $query = $this->db->prepare("INSERT INTO orders (date, amount, user_id) VALUES (:date, :amount, :user_id)");
        //Bind the paramaters
        $parameters = [
                'date' => $order->getDate(),
                'amount' => $order->getAmount(),
                'user_id' => $order->getUser_id()->getId()
            ];
        //Execute the query
        $query->execute($parameters);
        //Get the id of the newly inserted order
        $order->setId($this->db->lastInsertId());
        
        //return Order
        return $order;
    }

    public function editOrder(Order $order) : void
    {
        $query=$this->db->prepare("UPDATE orders SET date=:date, amount=:amount, user_id=:user_id");
        $parameters=[
            'date' => $order->getDate(),
            'amount' => $order->getAmount(),
            'user_id' => $order->getUser_id()->getId()
        ];
        $query->execute($parameters);
    }
}

?>