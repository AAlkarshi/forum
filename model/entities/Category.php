<?php
namespace Model\Entities;

use App\Entity;

//CLASS FINAL permet que la classe ne peux pas être étendue
final class Category extends Entity{
    private $id;
    private $NameCategory;

    public function __construct($data){         
        $this->hydrate($data);        
    }

//ID
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

//CATEGORIES
    public function getNameCategory(){
        return $this->NameCategory;
    }

    /**
     * Set the value of CATEGORIE
     * @return  self
     */ 
    public function setNameCategory($NameCategory){
        $this->NameCategory = $NameCategory;
        return $this;
    }


    public function __toString(){
        return $this->NameCategory;
    }
}