<?php

class CategoryManager extends AbstractManager {

    public function getCategoryByName($name) : Category
    {
        $query = $this->db->prepare("SELECT * FROM categories WHERE name = :name"); // Je récupere tout de la table Category qui comporte le nom etabli en parametre.
        $parameter = [
            "name" => $name // J'établi le parametre name.
        ];
        $query->execute($parameter); // Je demande d'exécuter ma requete en prenant en compte le parametre $parameter.
        $result = $query->fetch(PDO::FETCH_ASSOC); // Je stock le resultat de l'exécution dans la variable $result.

        if(isset($result)){
            $category = new Category($result['name'], $result['description']);
            $result->setId('id');
        }

        return $category;
    }
    
    public function getAllCategories() : array
    {
        $query = $this->db->prepare("SELECT * FROM categories");
        $query->execute();
        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        $categoriesTab = [];
        foreach ($results as $category)
        {
            $categoryInstance = new Category($category['name'], $category['description']);
            $categoryInstance->setId($category['id']);
            $categoriesTab [] = $categoryInstance;
        }
        return $categoriesTab;
    }



    public function editCategory($name, $description)
    {
        $query = $this->db->prepare("UPDATE categories SET name AND description = :name, :description WHERE id = 'id'");
        $parameters = [
            "name"=> $name,
            "description"=>$description
        ];

        $query->execute($parameters);

    }




    public function insertCategory($name, $description) : Category
    {

        $query = $this->db->prepare("INSERT INTO categories (name, description) VALUES (:name, :description)");
        $parameters = [
            "name"=>$name,
            "description"=>$description
        ];

        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        if(!isset($result)) {
            $category = new Category($result['name'], $result['description']);
            $result->setId('id');

            return $category;
        }
    }

    public function getCategoryById(int $id) : Category
    {
        $query=$this->db->prepare("SELECT * FROM categories WHERE categories.id = :id");
        $parameters=['id' => $id];
        $query->execute($parameters);
        $result = $query->fetch(PDO::FETCH_ASSOC);

        $category = new Category($result['name'], $result['description']);
        $category->setId($id);

        return $category;
    }

}

?>