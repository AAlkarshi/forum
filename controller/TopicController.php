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
                    "title" => "Listes des topics",
                    "topics" => $topicManager->findAll(["creationDate", "DESC"])
                ],
                "meta_description" => "Listes de chaque topics du forum"
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

            // CONCERNE LE TOPIC
            $dataTopic = [
                "title" => $title,
                "creationDate" => $dateRecente->format("Y-m-d H:i:s"),  
                "Category_ID" => $categorie,
                "user_ID" => $idUser
            ];
            
            //CREER FONCTION add dans $topicManager
            $topicId = $topicManager->add($dataTopic);


            // CONCERNE LE POST
            $dataPost = [
                "text" => $text,
                "creationDate" => $dateRecente->format("Y-m-d H:i:s"),
                "topic_ID" => $topicId, 
                "user_ID" => $idUser
            ];

            //CREER FONCTION add dans $PostManager
          $postId = $postManager->add($dataPost);


            //Redirection  APRES CLICK sur BOUTON
            $this->redirectTo("forum", "AffichePost", $topicId);

            $this->redirectTo("forum", "AffichePost", $postId);

            return [
			    "view" => VIEW_DIR."topic/addTopicForm.php",
			    "data" => [
			        "title" => "Ajout d'un topic",
			        "categories" => $categorie 
			    ],
			    "meta" => "Création d'un topic",
			    "meta_description" => "Ajout d'un topic" 
            ];

        }





//AJOUT TOPIC DEPUIS FORM
public function addTopicForm($categorieID = null) { 
    
    // Vérifie si un utilisateur est connecté
    if (!Session::getUser()) { 
        // Redirection USER NON CONNECTER
        $this->redirectTo("home", "index");
    }

	//CREATION instance et recuperation des données
    $categoryManager = new CategoryManager();
    $categories = $categoryManager->findAll();

            if(isset($categorieID)) {
                $this->existInDatabase($Category_ID, $TopicManager);

                return [
                    "view" => VIEW_DIR."topic/addTopicForm.php",
                    "data" => [
                        "title" => "Création d'un topic",
                        "idcategories" => $categorieID, 
                        "categories" => $categories,
                    ],
                    "meta_description" => "Création du topic"
                ];

                    } else {

                    return [
                        "view" => VIEW_DIR."topic/addTopicForm.php",
                        "data" => [
                            "title" => "Topic creation",
                            "categories" => $categories
                        ],
                        "meta_description" => "Créer un topic à partir d'un formulaire"
                    ];
                    
                }
            }


//MAJ Formulaire TOPIC
public function updateTopicForm($idTopic) {
    $topicManager = new TopicManager;

    //headerTopic sert à renvoyé ds infos du TOPIC crée   
    $topic = $topicManager->headerTopic($idTopic);
 

// existInDatabase verifie si une table existe en php
// Vérifie si ce topic possede Idtopic qui sert à la modification de ce topic

$this->existInDatabase($idTopic , $topicManager );

    return [
        "view" => VIEW_DIR."topic/updateTopicForm.php",
        "data" => [
        "title" => "MAJ formulaire topic ",
        "topic" => $topic
        ],
        "meta_description" => "MAJ d'un topic qui existe"
        ];
    }





public function existInDatabase($idTopic , $topicManager ) {
        $topic = $topicManager->headerTopic($idTopic);

        //Retourne si headerTopic est différent de null
        return $topic !== null;
    }
   












//MAJ TOPIC
public function updateTopic($idTopic) {
            $topicManager = new TopicManager;
            $postManager = new PostManager;

            $this->existInDatabase($idTopic, $topicManager);

            // vérifie si USER est AUTEUR ou ADMIN
            $topic = $topicManager->findOneById($idTopic);

           /* 
            if(!Session::isAuthorOrAdmin($topic->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }
            */

            //FILTRE LES DATA
            $title = filter_input(INPUT_POST, "title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $text = filter_input(INPUT_POST, "text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $topic = $topicManager->headerTopic($idTopic);
            $idMessage = $topic->getidMessagesAuteur();

            $dataTopic = [
                "id" => $idTopic,
                "title" => $title
            ];

            $dataMessage = [
                "id" => $idMessage,
                "text" => $text
            ];

            //MAJ
            $topicManager->update($dataTopic, $topic);
            $postManager->update($dataMessage, $topic->getidMessagesAuteur());
            
            //REDIRIGE
            $this->redirectTo("post", "AffichePost", $idTopic);
        }






//MEME FUNCTION que updateTopic sauf qu'on SUPPRIME
public function deleteTopic($idTopic) {
            $topicManager = new TopicManager;
            $postManager = new PostManager;

            $this->existInDatabase($idTopic, $topicManager);

            $topic = $topicManager->findOneById($idTopic);

            if(!Session::isAuthorOrAdmin($topic->getUser()->getId())) {
                $this->redirectTo("home", "index");
            }

            $postManager->deleteMessages($idTopic);
            $topicManager->delete($idTopic);

            $this->redirectTo("home", "index");
        }




//Nombre d'élément pat POST par utilisateur par TOPIC
public function nbxPostByTopics($idTopic) {
    $topicManager = new TopicManager;

   $this->existInDatabase($idTopic , $topicManager );

    //nbxPostByTopics renvoi le NBX d'élément par POST par utilisateur par TOPIC
   $topic =  $topicManager->nbxPostByTopics($idTopic);
    
     $topicManager->getnbxPostByTopics($idTopic);
 
}







//CLOTURER LE TOPIC
public function closeTopic($idTopic) {
            $topicManager = new TopicManager;

            $this->existInDatabase($idTopic, $topicManager);

            $dataTopic = [
                "id" => $idTopic,
                "closed" => "true"
            ];

            if ($topicManager->update($dataTopic)) {
                $this->redirectTo("forum", "AffichePost", $idTopic);
            } else {
                $this->redirectTo("forum", "listTopics");
                
            }
}

//OUVRIR LE TOPIC
public function openTopic($idTopic) {
            $topicManager = new TopicManager;

            $this->existInDatabase($idTopic, $topicManager);

            $dataTopic = [
                "id" => $idTopic,
                "closed" => "false"
            ];

            if ($topicManager->update($dataTopic)) {
                $this->redirectTo("forum", "AffichePost", $idTopic);
            } else {
                $this->redirectTo("forum", "listTopics");
                
            }
        }


}





