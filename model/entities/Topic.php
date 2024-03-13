<?php
namespace Model\Entities;

use App\Entity;

//CLASS FINAL permet que la classe ne peux pas être étendue
final class Topic extends Entity{
    private $id;
    private $title;
    private $user;
    private $category;
    private $creationDate;
    private $verrouillage;

    public function __construct($data){         
        $this->hydrate($data);        
    }

//ID
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of ID
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }

//TITLE
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set the value of TITLE
     * @return  self
     */ 
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }

    
//USER
public function getUser(){
    return $this->user;
}

/**
 * Set the value of USER
 *
 * @return  self
 */ 
public function setUser($user){
    $this->user = $user;
    return $this;
}

//CATEGORY 
public function getCategory(){
    return $this->category;
}

/**
 * Set the value of CATEGORY
 *
 * @return  self
 */ 
public function setCategory($category){
    $this->category = $category;
    return $this;
}


//CREATIONDATE 
     public function getcreationDate(){
        return $this->creationDate;
    }

    /**
     * Set the value of CREATIONDATE
     *
     * @return  self
     */ 
    public function setcreationDate($creationDate){
        $this->creationDate = $creationDate;
        return $this;
    }


//VERROUILLAGE get
     public function getVerrouillage(){
        return $this->verrouillage;
    }

    /**
     * Set the value of VERROUILLAGE
     *
     * @return  self
     */ 
    public function setVerrouillage($verrouillage){
        $this->verrouillage = $verrouillage;
        return $this;
    }


    public function __toString(){
        return $this->title;
    }
}