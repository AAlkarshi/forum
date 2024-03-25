<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\CategoryManager;

class CategoryManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\Category";
    protected $tableName = "category";

    public function __construct(){
        parent::connect();
    }

    // récupérer tous les topics d'une catégorie spécifique (par son id)
    public function listCategory($id) {
        foreach ($requete as $Category) 
            $sql = "SELECT * FROM ".$this->tableName." WHERE c.category.id = :id";
            
           	
        // la requête renvoie plusieurs enregistrements --> getMultipleResults
        return  $this->getMultipleResults(
            DAO::select($sql, ['id' => $id]), 
            $this->className
        );
    }



//Renvoi les 5 categories vec le + de TOPICS
     public function categoryPopulaire() {
        $sql = "SELECT category.ID_Category, category.nameCategory, 
            COUNT(topic.id_topic) AS nbxtopics 
            FROM category 
            INNER JOIN topic ON category.ID_Category = topic.category_id
            GROUP BY category.ID_Category 
            ORDER BY nbxtopics DESC 
            LIMIT 5
            ";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

    
}