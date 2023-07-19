<?php

class AbstractManager
{
    protected $db;

    function __construct()
    {

        $connexion = "mysql:host=db.3wa.io;port=3306;charset=utf8;dbname=guillaumeldean_e-commerce";
        $this->db = new PDO(
            $connexion,
            "guillaumeldean",
            "68e2c576c7ae433a7259ed26aebdc5ab"
        );
    }
}

?>