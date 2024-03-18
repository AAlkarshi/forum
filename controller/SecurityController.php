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

//FILTRE LES DONNES FORMULAIRES
        $nickname = filter_input(INPUT_POST, "nickname", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $email = filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL, FILTER_VALIDATE_EMAIL);
        $confirmEmail = filter_input(INPUT_POST, "confirmEmail",FILTER_SANITIZE_FULL_SPECIAL_CHARS,FILTER_VALIDATE_EMAIL);
        $password = filter_input(INPUT_POST, "password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        $confirmPassword = filter_input(INPUT_POST, "confirmPassword", FILTER_SANITIZE_FULL_SPECIAL_CHARS); 

//REGEX permet de verifier si tout les caracteres spéciaux sont fourni dans le champ MDP
         $password_regex = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{4,}$/";

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données du formulaire
        $nickname = $_POST['nickname'];
        $email = $_POST['email'];
        $confirmEmail = $_POST['confirmEmail'];
        $password = $_POST['password'];
        $confirmPassword = $_POST['confirmPassword'];

        // Valider les données (exemple simple)
        if ($email !== $confirmEmail) {
            echo "Email n'est pas identique !";
            return;
        }
        if ($password !== $confirmPassword) {
           echo "Le Mot de Passe n'est pas identique !";
            return; 
        }

        

        // Hasher MDP
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Créer un nouvel utilisateur (vous devez ajouter une méthode pour cela dans UserManager)
        $userManager = new UserManager();
        $result = $userManager->createUser($nickname, $email, 
            $hashedPassword);

        if ($result) {
            // Redirection ou message de succès
            $this->redirectTo('security', 'login');
            echo "Inscription à bien été Réaliser !";
        } else {
             $this->redirectTo('security', 'register');
        }
    }
}


}





