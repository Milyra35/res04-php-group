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
        if(isset($_POST['add-to-cart']) && isset($_POST['product_id']))
        {
            $product_id = $_POST['product_id'];
            $product = $this->manager->getProductById($product_id);
            $_SESSION['cart'][] = $product;
            //$category_id = $_SESSION['category_id'];
            //header("Location:index.php?route=category_id=$category_id");
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
    public function getProductByCategory(Category $category)
    {
        $category_id = $_SESSION['category_id'];
        $products = $this->manager->getProductsByCategory($category_id);
        $this->render("categories/category.phtml", $products);
    }
}

?>

