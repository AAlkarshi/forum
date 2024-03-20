<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;

use App\Session;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;
use Model\Managers\UserManager;

 class PostController extends AbstractController implements ControllerInterface{

     public function index() {
          
		$postManager = new PostManager();

            return [
                "view" => VIEW_DIR."post/listPosts.php",
                "data" => [
                    "title" => "Listes des posts",
                    "posts" => $postManager->findAll(["creationDate", "DESC"])
                ],
                "meta" => "Listes de chaque post du forum"
            ];
        
        }
        

public function addPost() {
		//Si USER est PAS CONNECTER il pourra pas accdéder à la page
            if(!Session::getUser()) { 
                $this->redirectTo("home", "index");
            }

            //INSTANCE 
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $dateRecente = new \DateTime("now");

            
            //FILTRE donnée du form AJOUT POST
           $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
           $categorie = filter_input(INPUT_POST, "categorie",FILTER_SANITIZE_NUMBER_INT); 
           
            $idUser = $_SESSION["user"]->getId();

            $dataPost = [
                "text" => $text,
                "creationDate" => $dateRecente->format("Y-m-d H:i:s"),
                "post_id" => $idPost, 
                "ID_user" => $idUser
            ];
            
            //CREER FONCTION add dans $PostManager
            $PostManager =  $PostManager->add($dataPost);







/* CREER AffichePost*/
            $this->redirectTo("post", "AffichePost", $idTopic);

            return [
			    "view" => VIEW_DIR."topic/addTopicForm.php",
			    "data" => [
			        "title" => "Ajout d'un post",
			        "categories" => $categories 
			    ],
			    "meta" => "Création d'un post",
			    "meta_description" => "Ajout d'un post" 
];
        }





//AJOUT TOPIC DEPUIS FORM

public function addPostForm() { 
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
            "title" => "Création d'un post",
            "categories" => $categories 
        ],
        "meta" => "Création du post"
    ];
}


}





