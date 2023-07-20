<?php

class ProductManager extends AbstractManager
{
    //Get product by id
    public function getProductById(int $id) : Product
    {
        $query = $this->db->prepare("SELECT * FROM products WHERE products.id = ?");
        $query->execute([$id]);
        $fetch = $query->fetch(PDO::FETCH_ASSOC);
        $product = new Product($fetch['name'], $fetch['description'], $fetch['price']);
        $product->setId($fetch['id']);
        return $product;
    }
    
    //Get products by category
    public function getProductsByCategory(int $id) : array
    {
        $query = $this->db->prepare
            ("SELECT products.* FROM products JOIN products_categories 
            ON products.id = products_categories.product_id JOIN categories 
            ON products_categories.product_id = categories.id WHERE products_categories.category_id = ?");
        $query->execute([$id]);
        $fetch = $query->fetchAll(PDO::FETCH_ASSOC);
        $products = [];
        foreach($fetch as $item)
        {
            $product = new Product($item['name'], $item['description'], $item['price']);
            $product->setId($item['id']);
            array_push($products, $product);
        }
        return $products;
    }
    
    //Add new product to database
    public function newProduct(Product $product) : void
    {
        $query = $this->db->prepare("INSERT INTO products (name, description, price) VALUES (:name, :description, :price)");
        $parameters =
        [
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice()
        ];
        $query->execute($parameters);
    }
    
    //Edit product
    public function editProduct(Product $product) : void
    {
        $query = $this->db->prepare("UPDATE products SET name = :name, description = :description, price = :price");
        $parameters =
        [
            'name' => $product->getName(),
            'description' => $product->getDescription(),
            'price' => $product->getPrice()
        ];
        $query->execute($parameters);
    }
}

?>