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


//ATTRIBUT SUPPPLEMENTAIRE

    //NBX de Topic par USER
    private $nbxTopic;

    // ID du MSG de l'auteur lors de la création du topic
    private $idMessagesAuteur;

    //MSG de l'auteur lors de la créationdu post
    private $messageAuteur;

    //NBX de POST par topics selon l'USER
    private $nbxPostByTopics;

    



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
     * Set the value of id
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
     * Set the value of id
     * @return  self
 */     
public function setVerrouillage($verrouillage){
    $this->verrouillage = $verrouillage;
    return $this;
}




//NBXTOPIC

//GET  nbxTopic
public function getnbxTopic() {
    return $this->nbxTopic;
}


 /**
     * Set the value of id
     * @return  self
     */ 
public function setnbxTopic($nbxTopic){
    $this->nbxTopic = $nbxTopic;
        return $this;
}





//IDMESSAGESAUTEUR
public function getidMessagesAuteur(){
    return $this->idMessagesAuteur;
}


 /**
     * Set the value of id
     * @return  self
     */ 
 public function setidMessagesAuteur($idMessagesAuteur){
    $this->idMessagesAuteur = $idMessagesAuteur;
    return $this;
}




//MESSAGEAUTEUR
 public function getmessageAuteur(){
    return $this->messageAuteur;
}


 /**
     * Set the value of id
     * @return  self
     */ 
public function setmessageAuteur($messageAuteur){
    $this->messageAuteur = $messageAuteur;
    return $this;
}





//NBX de POST par topics selon l'USER
public function getnbxPostByTopics(){
    return $this->nbxPostByTopics;
}


 /**
     * Set the value of id
     * @return  self
     */ 
public function setnbxPostByTopics($nbxPostByTopics){
    $this->nbxPostByTopics = $nbxPostByTopics;
    return $this;
}









 public function getFormattedDate($format = "Y-m-d H:i:s") {
    return $this->creationDate->format($format);
}


    public function __toString(){
        return $this->title;
    }

   
}