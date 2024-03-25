<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\PostManager;

class PostManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Post";
    protected $tableName = "post";

    public function __construct(){
        parent::connect();
    }

    // récupérer Topics d'une catégorie par son id
    public function findPostsBytopic($id) {
        
        $sql = "SELECT * FROM post
        INNER JOIN topic ON post.topic_ID = topic.ID_topic
        WHERE topic.Category_ID = :id
        ORDER BY post.creationDate DESC";
       
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }



//Ajout des donnée d'un formulaire dans la BDD
    public function addPost($data) {
        $sql = "INSERT INTO post (`text`, creationDate, topic_ID, user_ID)
        VALUES (:text, :creationDate, :topic_ID, :user_ID)";


        return DAO::insert($sql, [
            'text' => $data['text'],
            'creationDate' => $data['creationDate'],
            'topic_ID' => $data['topic_ID'], 
            'user_ID' => $data['user_ID']
        ]);
    }





// Retourne tout les messages d'un topic spécifique
 public function ReponsePost($id) {
         $sql = "SELECT * FROM post
                INNER JOIN topic ON post.topic_ID = topic.id_topic
                WHERE topic.id_topic = :id
                AND NOT topic.creationDate = post.creationDate
                ORDER BY post.creationDate";

            return $this->getMultipleResults(
                DAO::select($sql, ["id" => $id]), 
                $this->className
            );
        }


// Suppreesion de tt les msg d'un topic
 public function deleteMessagesPost($idTopic) {
            $sql ="DELETE FROM post WHERE topic_id = :id ";
            return DAO::delete($sql, ['id' => $idTopic]); 
        }



}