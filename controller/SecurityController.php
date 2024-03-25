<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;


use App\Session;
use Model\Managers\TopicManager;
use Model\Managers\UserManager;
use Model\Managers\CategoryManager;
use Model\Managers\PostManager;

class SecurityController extends AbstractController{
    // contiendra les méthodes liées à l'authentification : register, login et logout

// INDEX
    public function index() {
        $title = "Page existe pas";
        return [
            "view" => VIEW_DIR."/security/error.php",
            "data" => ["title" => $title],
            "meta" => "Erreur,cette page n'existe pas"
        ];
    }

// INSCRIPTION
    public function register () {  
        if (Session::getUser()) {
            $this->redirectTo("home", "index");
    }
    return [
        // View redirigé vers page register.php
        "view" => VIEW_DIR."security/register.php",
        "data" => ["title" => "Inscription"],

        "meta" => "Creer un compte"
    ];
}

//CONNEXION
    public function login () {
        if (Session::getUser()) {
            $this->redirectTo("home", "index");
        }

        return [
            "view" => VIEW_DIR."security/login.php",
            "data" => ["title" => "Login"],
            "meta" => "Connexion au Forum"
        ];
    }

// DECONNEXION
    public function logout () {
        unset($_SESSION["user"]);
        $this->redirectTo("home", "index");
    }

//Enregistrement USER  
   public function registerUser() {
   
    $userManager = new UserManager;

    // FILTRE LES DONNES FORMULAIRES
    $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL);
    $confirmEmail = filter_input(INPUT_POST, "confirmEmail", FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $role = filter_input(INPUT_POST, "role", FILTER_SANITIZE_FULL_SPECIAL_CHARS);  


    // REGEX pour vérifier si tous les caractères spéciaux sont fournis dans le champ MDP
    $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{4,}$/";

    // preg_match pour faire une recherche sensible à la casse
    preg_match($password_regex, $password);

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if ($email !== $confirmEmail) {
            echo "Les adresses e-mail ne correspondent pas !";
            return;
        }
        if ($password !== $confirmPassword) {
           echo "Les mots de passe ne correspondent pas !";
            return; 
        }

        // Hasher le mot de passe
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Créer un nouvel utilisateur
        $role = 'Utilisateur';
        $result = $userManager->createUser($nickname,$email,$hashedPassword ,$role);

        if ($result) {
            // Redirection ou message de succès
            $this->redirectTo("security", "login");
        } else {
            echo "Une erreur est survenue lors de l'inscription.";
        }
    }

      return [
            "view" => VIEW_DIR."security/Login.php",
            "meta_description" => "Connexion",
            "data" => ["user" => $nickname]
        ];
}



//CONNEXION UTILISATEUR

 public function loginUser() {

            $userManager = new UserManager;

            $email = filter_input(INPUT_POST, "email",FILTER_VALIDATE_EMAIL);
            $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            $er = false;


            // verifie si EMAIL est vide
            if(empty($email)) {               
                $ErreurVerif = true;
            }
            
            if(empty($password)) {
                $ErreurVerif = true;
            }

           
            if(!$email) {
                $ErreurVerif = true;
            }

            if(!$password) {
                $ErreurVerif = true;
            }



            
            if(!$ErreurVerif) {
                // Filtrer l'email de User afin de voir si il a deja un compte
                $user = $userManager->findUser($email);

                
                if($user) {    
                    $hashPassword = $user->getPassword();

                    // si MDP HACHE est correct alors création Utilisateur
                    if (password_verify($password, $hashPassword)) {
                        Session::setUser($user);
                        
                        //Redirection 
                        $this->redirectTo("home", "index");
                    }
                }
            }
            // Sinon redirection page connexion
            $this->redirectTo("security", "login");
            
        }

       

        public function changePassword($formErrors = []) {

            return [
                "view" => VIEW_DIR."security/changePassword.php",
                "data" => [
                    "title" => "Change password",
                    "formErrors" => $formErrors
                ],
                "meta" => "change the password of an account"
            ];
        }


}





