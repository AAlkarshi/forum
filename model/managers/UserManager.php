<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\UserManager;

class UserManager extends Manager{

    // on indique la classe POO et la table correspondante en BDD pour le manager concerné
    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    
//AJOUT UTILISATEUR
    public function createUser($nickname, $email, $hashedPassword) {
    $sql = "INSERT INTO user (nickname, email, password,role) 
    VALUES (:nickname, :email, :password, 'Utilisateur')";
      
    return DAO::insert($sql, [
        'nickname' => $nickname,
        'email' => $email,
        'password' => $hashedPassword
    ]);
}


// Va chercher dans la BDD si identifiant est bien enregistré
    public function findnickname() {
            $sql = " SELECT nickname FROM user ";
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
    }

// Va chercher dans la BDD si email est bien enregistré
    public function findemail() {
            $sql = "SELECT email FROM user ";
            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
    }



}