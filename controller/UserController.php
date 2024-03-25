<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;

    class UserController extends AbstractController implements ControllerInterface{

        public function index() {
            $this->redirectTo("home", "index");
        }

        public function monprofil() {
            //si USER est PAS CONNECTER alors redirection
            if(!Session::getUser()) { 
                $this->redirectTo("home", "index");
            }
            $topicManager = new TopicManager();

            $userId = $_SESSION["user"]->getId();

            $topics = $topicManager->TopicsPoster($userId);

            return [
                "view" => VIEW_DIR."user/monprofil.php",
                "data" => [
                    "title" => "Mon profil",
                    "topics" => $topics
                ],
                "meta_description" => "le profil de l'utilisateur connecté"
            ];
        }




        public function detailProfilUtilisateur($userId) {

            if($userId == null) {
                $this->redirectTo("security", "error");
            }
            
            if(!Session::getUser()) { 
                $this->redirectTo("home", "index");
            }
            $topicManager = new TopicManager();
            $userManager = new UserManager();

            $this->existInDatabase($userId, $userManager);

            $topics = $topicManager->TopicsPoster($userId);
            $user = $userManager->findOneById($userId);

            return [
                "view" => VIEW_DIR."user/detailsUserProfile.php",
                "data" => [
                    "title" => "Profil Utilisateur",
                    "topics" => $topics,
                    "user" => $user
                ],
                "meta_description" => "Profil public qui est visible par les autres utilisateurs"
            ];
        }

     

                

        public function updateUser($idUser) {
            $userManager = new UserManager;

            if(!Session::isAuthorOrAdmin($idUser)) {
                $this->redirectTo("home", "index");
            }

            $this->existInDatabase($idUser, $userManager);

            $userManager->update($idUser);

            $this->redirectTo("home", "users");

        }

                

        public function deleteUser($idUser) {
            $userManager = new UserManager;

            if(!Session::isAuthorOrAdmin($idUser)) {
                $this->redirectTo("home", "index");
            }

            $this->existInDatabase($idUser, $userManager);

            $userManager->delete($idUser);

            $this->redirectTo("home", "users");

        }


        public function updateRole($userId) {
            if(!Session::isAdmin()) {
                $this->redirectTo("security", "error");
            }

            $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $userManager = new UserManager;

            $user = $userManager->findOneById($userId);
  
            if($user->getRole() != $role) {
                $data = [
                    "id" => $userId,
                    "role" => $role
                ];

                $userManager->update($data);

                $this->redirectTo("user", "detailProfilUtilisateur", $userId);
            }
        }
    }