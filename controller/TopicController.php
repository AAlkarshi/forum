<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

use App\Session;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;
use Model\Managers\UserManager;

 class TopicController extends AbstractController implements ControllerInterface{

     public function index() {
          
		$topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."topic/listTopics.php",
                "data" => [
                    "title" => "List of topics",
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                ],
                "meta" => "Listes de chaque topics duforum"
            ];
        
        }



public function addTopic() {
		//Si USER est PAS CONNECTER il pourra pas accdéder à la page
            if(!Session::getUser()) { 
                $this->redirectTo("home", "index");
            }

            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $dateRecente = new \DateTime("now");
            
            //FILTRE donnée du form AJOUT TOPIC
           $title = filter_input(INPUT_POST,"title",FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
           $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
           $categorie = filter_input(INPUT_POST, "categorie",FILTER_SANITIZE_NUMBER_INT); 

            $idUser = $_SESSION["user"]->getId();

           $dataTopic = [
                "text" => $text,
                "creationDate" => $dateRecente->format("Y-m-d H:i:s"),
                "topic_id" => $idTopic, 
                "user_id" => $idUser
            ];
            
            $TopicManager = $topicManager->add($dataTopic);


           $dataPost = [
                "text" => $text,
                "creationDate" => $dateRecente->format("Y-m-d H:i:s"),
                "topic_id" => $idTopic, 
                "user_id" => $idUser
            ];
            

            $PostManager->add($dataPost);

            $this->redirectTo("post", "AffichePost", $idTopic);

            return [
			    "view" => VIEW_DIR."topic/addTopicForm.php",
			    "data" => [
			        "title" => "Ajout d'un topic",
			        "categories" => $categories 
			    ],
			    "meta" => "Création d'un topic",
			    "meta_description" => "Ajout d'un topic" 
];
        }







public function addTopicForm() { 
    // Vérifie si un utilisateur est connecté
    if (!Session::getUser()) { 
        // Redirection USER NON CONNECTER
        $this->redirectTo("home", "index");
    }

	//CREATION instance et recuperation des données
    $categoryManager = new CategoryManager();
    $categories = $categoryManager->findAll();

    
    return [
        "view" => VIEW_DIR."topic/addTopicForm.php",
        "data" => [
            "title" => "Création d'un topic",
            "categories" => $categories 
        ],
        "meta" => "Création du topic"
    ];
}


}





