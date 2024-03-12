<?php
namespace Model\Entities;

use App\Entity;

final class Post extends Entity {
    private $ID_Post;
    private $text;
    private $creationDate;

    public function __construct($data) {         
        $this->hydrate($data);        
    }

   //hydrate() permet d'initialiser les propriétés avec un tableau associatif Clé Valeur.
    private function hydrate($data) {
        if (isset($data['id_Post'])) {
            $this->setIDPost($data['id_Post']);
        }
        if (isset($data['text'])) {
            $this->setText($data['text']);
        }
        if (isset($data['creationDate'])) {
            $this->setCreationDate($data['creationDate']);
        }
    }

// ID
    public function getId() {
        return $this->id_Post;
    }

    public function setId($ID_Post) {
        $this->id_Post = $ID_Post;
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
