<?php 
use App\Session;

if(isset($result["security"]["error"])) { 
    $erreur = $result["security"]["error"];
}

$topic = $result["data"]["topic"];

?>


<?php if($topic) { ?>

    <div>

        <div>
            <h1>Mise à jour du topic</h1>
        </div>

        <form action="index.php?ctrl=topic&action=updateTopic&id=<?= $topic->getId() ?>" method="post">

            <label>Title</label>
            <input type="title" name="title" value="<?= $topic->getTitle() ?>">

            
            <label for="text">Contenu du topic</label>
            <textarea name="text" id="text" cols="70" rows="8"><?= $topic->getmessageAuteur() ?></textarea>

            <button type="submit">submit</button>
        </form>
        
    </div>

<?php } ?>