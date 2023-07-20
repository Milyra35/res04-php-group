<?php

class Router
{
    private CategoryController $cc;
    private MediaController $mc;
    private OrderController $oc;
    private ProductController $pc;
    private UserController $uc;

    public function __construct()
    {
        $this->cc = new CategoryController();
        $this->mc = new MediaController();
        $this->oc = new OrderController();
        $this->pc = new ProductController();
        $this->uc = new UserController();
    }
    
    public function checkRoute()
    {
        $categories = $this->cc->allCategories();
        // $this->cc->render("views/partials/_header.phtml", $categories);
        
        if(isset($_GET['route']))
        {
            if($_GET['route'] === "homepage")
            {
                // $categories = $this->cc->allCategories();
                $this->cc->render("homepage/homepage.phtml", $categories);
            }
            else if($_GET['route'] === "register")
            {
                $this->uc->createUser();
            }
            else if($_GET['route'] === "login")
            {
                $this->uc->loadUser();
            }
            else if(str_contains($_GET['route'], "category_id"))
            {
                list($route, $category_id) = explode("=", $_GET['route']);
                $_SESSION['category_id'] = $category_id;
                $category = $this->cc->getCategoryById($category_id);
                $this->pc->getProductByCategory($category);
                $this->pc->addProductToCart();
                $this->oc->addCartToOrder();
            }
        }
        else
        {
            $categories = $this->cc->allCategories();
            // $this->cc->render("views/homepage/homepage.phtml", $categories);
        }
    }
}

?>