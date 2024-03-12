<?php
namespace Model\Entities;

use App\Entity;

final class Topic extends Entity{

    private $id_topic;
    private $title;
    //private $user;
    //private $category;
    private $creationDate;
    private $verrouillage;
   // private $closed;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    //hydrate() permet d'initialiser les propriétés avec un tableau associatif Clé Valeur.
    private function hydrate($data) {
        if (isset($data['id_topic'])) {
            $this->setId($data['id_topic']);
        }
        if (isset($data['title'])) {
            $this->settitle($data['title']);
        }
        if (isset($data['creationDate'])) {
            $this->setcreationdate($data['creationDate']);
        }
        if (isset($data['verrouillage'])) {
            $this->setverrouillage($data['verrouillage']);
        }
    }


    public function getId(){
        return $this->id_topic;
    }

    /**
     * Set the value of ID
     *
     * @return  self
     */ 
    public function setId($id_topic){
        $this->id_topic = $id_topic;
        return $this;
    }

    



//TITLE get
    public function getTitle(){
        return $this->title;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setTitle($title){
        $this->title = $title;
        return $this;
    }


//CREATIONDATE get
     public function getCreationDate(){
        return $this->creationDate;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setCreationDate($creationDate){
        $this->creationDate = $creationDate;
        return $this;
    }




//VERROUILLAGE get
     public function getverrouillage(){
        return $this->verrouillage;
    }

    /**
     * Set the value of title
     *
     * @return  self
     */ 
    public function setverrouillage($verrouillage){
        $this->verrouillage = $verrouillage;
        return $this;
    }




   /*
        public function getUser(){
            return $this->user;
        }

        /**
         * Set the value of user
         
        * @return  self
     
        public function setUser($user){
            $this->user = $user;
            return $this;
        }
*/











    

    public function __toString(){
        return $this->title;
    }
}