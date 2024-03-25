<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\TopicManager;

class TopicManager extends Manager {
    protected $className = "Model\Entities\Topic";
    protected $tableName = "topic";

    public function __construct() {
        parent::connect();
    }

    public function listTopicsByCategory($id) {
        $sql = "SELECT topic.* , user.nickname FROM topic
        INNER JOIN category ON topic.Category_ID = category.ID_Category
        INNER JOIN user ON topic.user_ID = user.ID_user
        WHERE topic.Category_ID = :id
        ORDER BY topic.creationDate ASC";

        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
         
    }




public function updateTopicForm($idTopic) {
    $topicManager = new TopicManager;
    $topic = $topicManager->headerTopic($idTopic);

   
    if (!$topic) {
       
        $this->redirectTo("security", "error");
        return; 
    }

    if (!Session::isAuthorOrAdmin($topic->getUser()->getId())) {
        $this->redirectTo("home", "index");
        return; 
    }

    $this->existInDatabase($idTopic, $topicManager);

    return [
        "view" => VIEW_DIR . "topic/updateTopicForm.php",
        "data" => [
            "title" => "MAJ formulaire topic",
            "topic" => $topic
        ],
        "meta_description" => "MAJ d'un topic qui existe"
    ];
}



//Ajout du topic     addTopic 
     public function addTopic($id) {
        $sql = "SELECT topic.* , user.nickname FROM topic
        INNER JOIN category ON topic.Category_ID = category.ID_Category
        INNER JOIN user ON topic.user_ID = user.ID_user
        WHERE topic.Category_ID = :id
        ORDER BY topic.creationDate ASC";

        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
         
    }



//EN TETE DU TOPIC qui renvoi ID et texte,date,categorie du topic
public function headerTopic($id) {
            $sql = "SELECT 
                topic.id_topic,topic.title,topic.creationDate,
                topic.verrouillage, topic.category_id, topic.user_id,
                post.ID_post AS idPostAuteur, 
                post.text AS PostAuteur
                FROM topic
                INNER JOIN post ON topic.id_topic = post.topic_ID
                WHERE topic.id_topic = :id
                ORDER BY post.creationDate
                LIMIT 1
            ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }





//Renvoi tout les topics créer par 1 utilisateur
 public function TopicsPoster($id) {

            $sql = 
            "SELECT topic.id_topic,topic.title,topic.creationDate,
            topic.verrouillage,topic.category_id, topic.user_id,
            COUNT(post.topic_ID) AS nbmessages            
            FROM topic
            INNER JOIN post ON topic.id_topic = post.topic_ID
            WHERE topic.user_id = topic.user_id 
            GROUP BY topic.id_topic
            ORDER BY topic.creationDate DESC";

            return $this->getMultipleResults(
                DAO::select($sql, ["id" => $id]), 
                $this->className
            );
        }


// Renvoi les 5 topics les + RECENT
public function TopicsRecent() {
            $sql = 
            "SELECT topic.id_topic,topic.title,topic.creationDate,topic.verrouillage,
            topic.user_id,topic.category_id      
            FROM topic
            ORDER BY topic.creationDate DESC
            LIMIT 5";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }


// Topic les + populaires avec les + de POSTS
public function TopicsPopulaire() {
            $sql = 
            " SELECT topic.id_topic, topic.title, topic.creationDate, 
            topic.verrouillage,topic.category_id,topic.user_id ,
            COUNT(post.topic_ID) AS nbmessages
            FROM topic
            INNER JOIN post ON topic.id_topic = post.topic_ID
            GROUP BY topic.id_topic
            ORDER BY nbmessages DESC LIMIT 5";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }



// FERME LE SUJET TOPIC
public function verrouillageTopic($id) {
            $sql = 
            "SELECT topic.id_topic , topic.verrouillage FROM topic WHERE topic.id_topic = :id";

            //dans Manager.php retourne 1 ou AUCUN résultat
            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }


}

?>


