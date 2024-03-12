<?php
namespace Model\Entities;

use App\Entity;

final class Post extends Entity {
    private $id;
    private $text;
    private $creationDate;

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
    public function getCreationDate() {
        return $this->creationDate;
    }

    public function setCreationDate($creationDate) {
        $this->creationDate = $creationDate;
        return $this;
    }
}
