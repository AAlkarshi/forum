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
    $sql = "SELECT * FROM topic
        INNER JOIN category ON topic.Category_ID = category.ID_Category
        WHERE topic.Category_ID = :id";


        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]),
            $this->className
        );
         
    }

    
}

?>


