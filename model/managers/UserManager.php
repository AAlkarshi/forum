<?php
namespace Model\Managers;

use App\Manager;
use App\DAO;
use Model\Managers\UserManager;

class UserManager extends Manager{

    protected $className = "Model\Entities\User";
    protected $tableName = "user";

    public function __construct(){
        parent::connect();
    }

    
//AJOUT UTILISATEUR 
public function createUser($nickname, $email, $hashedPassword) {
    $sql = "INSERT INTO user (nickname, email, password, role) VALUES (?, ?, ?, 'Utilisateur')";
    
    //Connexion BDD
    $pdo = DAO::getPDO(); 

    try {
        // Préparer la requête SQL
        $stmt = $pdo->prepare($sql);

        // Exécuter la requête avec les valeurs fournies
        $stmt->execute([$nickname, $email, $hashedPassword]);

        // Retourne ID de USER inséré
        return $pdo->lastInsertId();
    } catch (\PDOException $e) {
        echo "Erreur lors de l'insertion: " . $e->getMessage();
        return false;
    }
}


//Trouver l'USER grâce à son email
public function findUser($email) {
            $sql =  "SELECT * FROM user WHERE email = :email";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['email' => $email], false), 
                $this->className
            );
        }





// Va chercher dans la BDD si identifiant est bien enregistré
    public function findnickname() {
            $sql = "SELECT nickname FROM user ";
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