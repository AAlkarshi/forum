<?php
namespace Model\Entities;

use App\Entity;

final class Category extends Entity{
    private $id_category;
    private $name_category;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    //hydrate() permet d'initialiser les propriétés avec un tableau associatif Clé Valeur.
     private function hydrate($data) {
        if (isset($data['id_category'])) {
            $this->setId($data['id_category']);
        }
        if (isset($data['name_category'])) {
            $this->setname_category($data['name_category']);
        }
    }
    

//ID
    public function getId()
    {
        return $this->id_category;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id_category)
    {
        $this->id_category = $id_category;
        return $this;
    }

    

    

//CATEGORIES
    public function getname_category(){
        return $this->name_category;
    }

    /**
     * Set the value of CATEGORIE
     *
     * @return  self
     */ 
    public function setname_category($name_category){
        $this->name_category = $name_category;
        return $this;
    }



    public function __toString(){
        return $this->name_category;
    }
}