<?php
namespace Model\Entities;

use App\Entity;

final class User extends Entity {
    private $id; 
    private $nickname;
    private $email;
    private $password;
    private $role;

    public function __construct($data) {         
        $this->hydrate($data);        
    }

   


//ID
    public function getId(){
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id){
        $this->id = $id;
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