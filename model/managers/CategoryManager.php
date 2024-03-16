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
    
}