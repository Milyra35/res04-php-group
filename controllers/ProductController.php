<?php

class ProductController extends AbstractController
{
    //ATTRIBUTES
    private ProductManager $manager;
    private CategoryManager $cm;
    
    //CONSTRUCTOR
    public function __construct()
    {
        $this->manager = new ProductManager();
        $this->cm = new CategoryManager();
    }
    
    //METHODS
    
    //Add new product to database
    public function newProduct() : void
    {
        if(isset($_POST['submit-new-product']))
        {
            if(!empty($_POST['name']))
            {
                $name = $_POST['name'];
            }
            if(!empty($_POST['description']))
            {
                $description = $_POST['description'];
            }
            if(!empty($_POST['price']))
            {
                $price = $_POST['price'];
            }
            if(!empty($_POST['category']))
            {
                $category = $this->cm->getCategoryByName($_POST['category']);
                $id = $category->getId();
            }
            $product = new Product($name, $description, $price, $category);
            $this->manager->newProduct($product);
            
            //Render
        }
    }
    
    //Edit product
    public function editProduct() : void
    {
        if(isset($_POST['submit-edit-product']))
        {
            if(!empty($_POST['name']))
            {
                $name = $_POST['name'];
            }
            if(!empty($_POST['description']))
            {
                $description = $_POST['description'];
            }
            if(!empty($_POST['price']))
            {
                $price = $_POST['price'];
            }
            $product = new Product($name, $description, $price);
            $this->manager->editProduct($product);
            
            //Render
        }
    }
    
    //Add product to cart
    public function addProductToCart() : void
    {
        //When "add to cart" is clicked
        if(isset($_POST['add-product_id']))
        {
            $product = $this->manager->getProductById($_POST['product_id']);
            array_push($_SESSION['cart'], $product);
        }
    }
    
    //Remove product from cart
    public function removeProductFromCart() : void
    {
        if(isset($_POST['remove-product_id']))
        {
            $product = $this->manager->getProductById($_POST['product_id']);
            $key = array_search($product, $_SESSION['cart']);
            array_splice($_SESSION['cart'], $key, 1);
        }
    }
    
    //Get products by category
    public function getProductByCategory()
    {
        $category_id = $_SESSION['category_id'];
        $category = $this->cm->getCategoryById($category_id);
        $products = $this->manager->getProductsByCategory($category);
        $this->render("categories/category.phtml", $products);
    }
}

?>

