<?php

class Product {
    private ?int $id;
    private string $name;
    private string $description;
    private $price;
    private Category $category;


    public function __construct($name,$description,$price, $category){
        $this->id = null;
        $this->name = $name;
        $this->description = $description;
        $this->price = $price;
        $this->category = $category;
    }

    public function getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;
    }


    public function getName(){
        return $this->name;
    }
    public function setName($name){
        $this->name = $name;
    }


    public function getDescription(){
        return $this->description;
    }
    public function setDescription($description){
        $this->description = $description;
    }


    public function getPrice(){
        return $this->price;
    }
    public function setPrice($price){
        $this->price = $price;
    }

    public function getCategory() : Category
    {
        return $this->category;
    }
    public function setCategory(Category $category) : void
    {
        $this->category = $category;
    }
}




?>