<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;


use App\Session;
use Model\Managers\TopicManager;
use Model\Managers\MessageManager;
use Model\Managers\TagManager;
use Model\Managers\UserManager;

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
}