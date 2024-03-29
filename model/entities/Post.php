<?php
namespace Model\Entities;

use App\Entity;

//CLASS FINAL permet que la classe ne peux pas être étendue
final class Post extends Entity {
    private $id;
    private $text;
    private $creationDate;
    private $topic;
    private $user;

    public function __construct($data) {         
        $this->hydrate($data);        
    }

// ID
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }

// TEXT
    public function getText() {
        return $this->text;
    }

    public function setText($text) {
        $this->text = $text;
        return $this;
    }

// CREATIONDATE
    public function getcreationDate() {
        return $this->creationDate;
    }

    public function setcreationDate($creationDate) {
        $this->creationDate = $creationDate;
        return $this;
    }


// ID_TOPIC
    public function getTopic() {
        return $this->topic;
    }

    public function setTopic($topic) {
        $this->topic = $topic;
        return $this;
    }

// ID_USER
    public function getUser() {
        return $this->user;
    }

    public function setUser($user) {
        $this->user = $user;
        return $this;
    }



  public function __toString(){
        return $this->text;
    }

}
