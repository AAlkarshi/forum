<?php
namespace Model\Entities;

use App\Entity;

final class User extends Entity{
    private $ID_user;
    private $nickname;
    private $email;
    private $password;
    private $role;

    public function __construct($data){         
        $this->hydrate($data);        
    }

    //hydrate() permet d'initialiser les propriétés avec un tableau associatif Clé Valeur.
    private function hydrate($data) {
        if (isset($data['id_User'])) {
            $this->setId($data['id_User']);
        }
        if (isset($data['nickname'])) {
            $this->setNickName($data['nickname']);
        }
        if (isset($data['email'])) {
            $this->setEmail($data['email']);
        }
        if (isset($data['password'])) {
            $this->setPassword($data['password']);
        }
        if (isset($data['role'])) {
            $this->setRole($data['role']);
        }
    }


//ID
    public function getId(){
        return $this->id_User;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($ID_user){
        $this->id_User = $ID_User;
        return $this;
    }




//NICKNAME
    public function getNickName(){
        return $this->nickName;
    }

    /**
     * Set the value of nickName
     *
     * @return  self
     */ 
    public function setNickName($nickName){
        $this->nickName = $nickName;
        return $this;
    }






//EMAIL
    public function getemail(){
        return $this->email;
    }

    /**
     * Set the value of EMAIL
     *
     * @return  self
     */ 
    public function setemail($email){
        $this->email = $email;
        return $this;
    }



//PASSWORD
    public function getpassword(){
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setpassword($password){
        $this->password = $password;
        return $this;
    }





//ROLE
    public function getrole(){
        return $this->role;
    }

    /**
     * Set the value of ROLE
     *
     * @return  self
     */ 
    public function setrole($role){
        $this->role = $role;
        return $this;
    }





    public function __toString() {
        return $this->nickName;
    }
}