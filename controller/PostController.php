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
        



public function AffichePost($idTopic) {

            $messageManager = new MessageManager();
            $topicManager = new TopicManager();
            
            $this->existInDatabase($idTopic, $topicManager);

            
            $post = $messageManager->messagesResponse($idTopic); 
            $topic = $topicManager->headerTopic($idTopic); 
            $closed = $topicManager->closed($idTopic);

            return [
                "view" => VIEW_DIR."forum/AffichePost.php",
                "data" => [
                    "title" => "Details des Topics",
                    "post" => $post, 
                    "topic" => $topic,
                    "Verrouillage" => $closed,
                ], 
                "meta" => "Listes des posts d'un topic".$topic->getTitle()
            ];
        }



public function addPost($idTopic) {

		//Si USER est PAS CONNECTER il pourra pas accdéder à la page
            if(!Session::getUser()) { 
                $this->redirectTo("home", "index");
            }

            //INSTANCE 
            $topicManager = new TopicManager();
            $postManager = new PostManager();
            $dateRecente = new \DateTime("now");

             $this->existInDatabase($idTopic, $topicManager);
            
           //FILTRE donnée du form AJOUT POST
           $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 
           
           
            $idUser = $_SESSION["user"]->getId();
            $ErreurVerification = false;

            $topic = $topicManager->headerTopic($idTopic);

             if(!$topic) {
                $this->redirectTo("security", "index");
            }

            if(empty($text)) {
                $ErreurVerification = true;
            }

            if(!$ErreurVerification) {
                $dataPost = [
                    "text" => $text,
                    "creationDate" => $dateRecente->format("Y-m-d H:i:s"),
                   /* "ID_post" => $idPost, */ 
                    "topic_ID" => $idTopic, 
                    "user_ID" => $idUser 
                ];

                //CREER FONCTION add dans $PostManager
               // $postManager->add($dataPost);

                $postId = $postManager->add($dataPost);
            }


            // Exemple de redirection vers la vue correcte
            $this->redirectTo("forum", "AffichePost", $postId);

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




//SUPP POST
 public function suppressionPost($idMessage) {
            $messageManager = new MessageManager;
            $message = $messageManager->findOneById($idMessage);

            // Si user et pas Auteur du Post ni Admin allors il se fait redirigé
            if(!Session::isAuthorOrAdmin($message->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            $this->existInDatabase($idMessage, $messageManager);

            $messageManager->delete($idMessage);

            $this->redirectTo("home", "index");
        }
    }


}





