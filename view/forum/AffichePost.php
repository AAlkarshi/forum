<?php
use App\Session;
//use Service\ConvertDate;

$messages = $result["data"]['post'];
$topic = $result["data"]["topic"];
$userSession = Session::getUser();
$verrouillageData = $result["data"]["verrouillage"];

if ($verrouillageData->getverrouillage() == "true") {
    $verrouillage = true;
} else {
    $verrouillage = false;
}

?>

<?php if($topic) { ?>

    <div>

            <?php if((Session::getUser() && (Session::getUser()->getId() == $topic->getUser()->getId()) && !$verrouillage) || Session::isAdmin()) { ?>

                <div>

                    <a href="index.php?ctrl=topic&action=updateTopicForm&id=<?= $topic->getId() ?>"> </a>

                    

                    <?php if(Session::isAdmin() && !$closed) { ?>
                        <a href="index.php?ctrl=topic&action=closeTopic&id=<?= $topic->getId() ?>">
                            <p>Fermer ce topic</p>
                        </a>
                    <?php } ?>

                    <?php if(Session::isAdmin() && $closed) { ?>
                        <a href="index.php?ctrl=topic&action=openTopic&id=<?= $topic->getId() ?>">
                           <p>Ouvrir ce topic</p>
                        </a>
                    <?php } ?>
        
                </div>
        <?php } ?>


        <div>

         <a href="index.php?ctrl=user&action=detailProfilUtilisateur&id=<?=$topic->getUser()->getId() ?>">
                <p><?= $topic->getUser()->getNickname() ?></p>
         </a>

            <p class="timeInterval"><?= ConvertDate::convertDate($topic->getCreationDate()) ?></p>
        </div>


        <div>

            <?php if($closed) { ?>
                <strong>Le topic est fermer</strong>
            <?php } ?>

            <h1><?= $topic->getTitle() ?></h1>
            
            <p><?= $topic->getmessageAuteur() ?></p>

        </div>

    </div>

<?php if(Session::getUser() && !$closed) { ?>
    <form action="index.php?ctrl=message&action=addPost&id=<?= $topic->getId() ?>" method="post">
        <label for="text">Créer un POST</label>
        <textarea name="text" id="text" cols="15" rows="1"></textarea>
        <button type="submit"> Enregistrer </button>   
    </form>
    
<?php } ?>

<?php } else if($closed) { ?>

    <p>Ce topic à bien été bloqué.</p>


<?php } else { ?>

    <p>Tu dois être inscris afin de commenter.</p>

<?php } ?>




<!-- TABLEAU  -->
<table>
    <thead>
        <tr>
            <th>Auteur</th>
            <th>Réponses</th>
            <th>Dates</th>
        </tr>
    </thead>

    <tbody>
        <?php if(isset($messages)) { ?>
            <?php foreach($messages as $message) { ?>

                <tr>
                    <td>
                        <a href="index.php?ctrl=user&action=detailProfilUtilisateur&id=<?= $message->getUser()->getId() ?>">
                           <?= $message->getUser()->getNickname() ?>
                        </a>
                    </td>

                    <td><?= $message->getText() ?></td>

                    <td><?= ConvertDate::convertDate($message->getCreationDate()) ?></td>

                    <td>
        
                        <?php if((isset($_SESSION["user"]) && ($_SESSION["user"]->getId() == $message->getUser()->getId()) || Session::isAdmin())) { ?>
                            <a href="index.php?ctrl=message&action=updateMessageForm&id=<?= $message->getId() ?>">
                                <p> Mettre à jour ce post </p>
                            </a>

                            <a href="index.php?ctrl=message&action=deleteMessage&id=<?= $message->getId() ?>">
                                <p> Supprimer ce post </p>
                            </a>
                        <?php } ?>

                    </td>

                </tr>

            <?php } ?>

        <?php } else { ?> 
            
                <p>Pas de réponset</p>
             
        <?php } ?>

    </tbody>
</table>

  