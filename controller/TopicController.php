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
           
            $topic = filter_input(INPUT_POST, "topic",FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $PostManager = filter_input(INPUT_POST, "post",FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $idUser = $_SESSION["user"]->getId();

            $idPost = $_SESSION["user"]->getId();



        // CONCERNE LE TOPIC
           $dataTopic = [
                "title" => $title,
                "creationDate" => $dateRecente->format("Y-m-d H:i:s"),
                "ID_topic" => $topic, 
                "Category_ID" => $categorie,
                "user_ID" => $idUser
            ];
            
            //CREER FONCTION add dans $topicManager
            $TopicManager = $topicManager->add($dataTopic);

            


        // CONCERNE LE POST
           $dataPost = [
                "text" => $text,
                "creationDate" => $dateRecente->format("Y-m-d H:i:s"),
                "topic_ID" => $topic, 
                "ID_post" => $idPost, 
                "ID_user" => $idUser
            ];
            
            //CREER FONCTION add dans $PostManager
            $PostManager =  $postManager->add($dataPost);

            //Redirection vers Listes des topics

            $this->redirectTo("forum", "listTopics", $idTopic);

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





//AJOUT TOPIC DEPUIS FORM

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





