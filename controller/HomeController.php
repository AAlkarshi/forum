<?php
namespace Controller;

use App\AbstractController;
use App\ControllerInterface;
use Model\Managers\UserManager;

use App\Session;
use Model\Managers\TopicManager;
use Model\Managers\PostManager;
use Model\Managers\CategoryManager;




class HomeController extends AbstractController implements ControllerInterface {

    public function index(){

        $PostManager = new PostManager();
        $CategoryManager = new CategoryManager();
        $TopicManager = new TopicManager();
        $UserManager = new UserManager();

        return [
            "view" => VIEW_DIR."home.php",
            "meta_description" => "Page d'accueil du forum"
        ];
    }
        
    public function users(){
        $this->restrictTo("role");

        $manager = new UserManager();
        $users = $manager->findAll(['nickname']);

        return [
            "view" => VIEW_DIR."security/users.php",
            "meta_description" => "Liste des utilisateurs du forum",
            "data" => [ "users" => $users]
        ];
    }
}
