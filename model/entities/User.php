<?php
namespace Model\Entities;

use App\Entity;

//CLASS FINAL permet que la classe ne peux pas être étendue
final class User extends Entity {
    private $id; 
    private $nickname;
    private $email;
    private $password;
    private $role;


    private $nbxPostByTopics;

    public function __construct($data) {         
        $this->hydrate($data);        
    }

   
//ID
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
        return $this;
    }


//NICKNAME
    public function getNickname(){
        return $this->nickname;
    }

    /**
     * Set the value of nickName
     * @return  self
     */ 
    public function setNickname($nickname){
        $this->nickname = $nickname;
        return $this;
    }


//EMAIL
    public function getEmail(){
        return $this->email;
    }

    /**
     * Set the value of EMAIL
     * @return  self
     */ 
    public function setEmail($email){
        $this->email = $email;
        return $this;
    }


    //PASSWORD
    public function getPassword(){
        return $this->password;
    }

    /**
     * Set the value of password
     * @return  self
     */ 
    public function setPassword($password){
        $this->password = $password;
        return $this;
    }


//ROLE
    public function getRole(){
        return $this->role;
    }

    /**
     * Set the value of ROLE
     * @return  self
     */ 
    public function setRole($role){
        $this->role = $role;
        return $this;
    }


    public function __toString() {
        return $this->nickname;
    }



    //NBX de POST par topics selon l'USER
    public function getnbxPostByTopics(){
        return $this->nbxPostByTopics;
    }


 /**
     * @return  self
     */ 
public function setnbxPostByTopics($nbxPostByTopics){
    $this->nbxPostByTopics = $nbxPostByTopics;
    return $this;
}





      /**
        * @return  bool
        */ 
        public function hasRole($role) {
            //Vérifie si le role est IDENTIQUE
            if ($this->getRole() === $role) {
                return true;
            } else {
                return false;
            }
        }



}