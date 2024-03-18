<?php
namespace Controller;

use App\Session;
use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\CategoryManager;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;

class ForumController extends AbstractController implements ControllerInterface{

    public function index() {
        // créer une nouvelle instance de CategoryManager
        $categoryManager = new CategoryManager();
        // récupérer la liste de toutes les catégories grâce à la méthode findAll de Manager.php (triés par nom)
        $categories = $categoryManager->findAll(["nameCategory", "DESC"]);

        // le controller communique avec la vue "listCategories" (view) pour lui envoyer la liste des catégories (data)
        return [
            "view" => VIEW_DIR."forum/listCategories.php",
            "meta_description" => "Liste des catégories du forum",
            "data" => ["categories" => $categories]
        ];
    }




// Listes des TOPICS par CATEGORIE
    public function listTopicsByCategory($id) {
        $topicManager = new TopicManager();
        $categoryManager = new CategoryManager();
        $category = $categoryManager->findOneById($id); 
        $topics = $topicManager->listTopicsByCategory($id); 
      
        return [
            "view" => VIEW_DIR."forum/listTopics.php",
            "meta_description" => "Liste des topics par catégorie : ".$category,
            "data" => ["category" => $category, "topics" => $topics]
        ];
    }


// LISTES des POSTS par TOPICS
public function listPostByTopic($id) {
    $postManager = new PostManager();
    $posts = $postManager->findPostsByTopic($id); 

   
    $meta_description = "Liste des posts par topic"; 

    return [
        "view" => VIEW_DIR."forum/listPosts.php",
        "meta_description" => $meta_description,
        "data" => ["posts" => $posts]
    ];
}



     
   
}