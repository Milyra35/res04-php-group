<?php

class OrderController extends AbstractController {
    
    public function __construct()
    {
        $this->manager = new OrderManager();
    }

    public function addCartToOrder()
    {
        $this->render('order/cart.phtml', $_SESSION['cart']);
        //Verify if this variable is defined
        if($_SESSION['cart'] !== null && isset($_POST['add-order']))
        {
            //Set the date and time of the order
            date_default_timezone_set('Europe/Paris');
            $date = date('Y-m-d H:i:s');
            //Find the user id
            $user_id = $_SESSION['user']->getId();
            //initializes the amount of the order to 0
            $amount = 0;
            
            foreach($_SESSION['cart'] as $product)
            {
                //for each product, the function retrieves the prices of product
                $price = $product->getPrice();
                //the function add the product to the amount of the order
                $amount += $price;
            }
            //The function then insert the order to the database
            $order = $this->manager->insertOrder(new Order($date, $amount, $_SESSION['user']));
        }
        
    }
    
}

?>