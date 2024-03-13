<?php
namespace Model\Entities;

use App\Entity;

//CLASS FINAL permet que la classe ne peux pas être étendue
final class Category extends Entity{
    private $id;
    private $nameCategory;

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
    public function getnameCategory(){
        return $this->nameCategory;
    }

    /**
     * Set the value of CATEGORIE
     * @return  self
     */ 
    public function setnameCategory($nameCategory){
        $this->nameCategory = $nameCategory;
        return $this;
    }



    public function __toString(){
        return $this->nameCategory;
    }
}