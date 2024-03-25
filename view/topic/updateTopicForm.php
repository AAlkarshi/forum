<?php 
use App\Session;

if(isset($result["data"]["formErrors"])) { 
    $formErrors = $result["data"]["formErrors"];
}

$topic = $result["data"]["topic"];

?>


<?php if($topic) { ?>

    <div>

        <div id="form-header">
            <h1>Mise à jour du topic</h1>
        </div>

        <form id="form-content" action="index.php?ctrl=topic&action=updateTopic&id=<?= $topic->getId() ?>" method="post">
            

            <label for="title">Title</label>
            <input id="title" type="title" name="title" value="<?= $topic->getTitle() ?>">

            
            <label for="text">Contenu du topic</label>
            <textarea name="text" id="text" cols="60" rows="5"><?= $topic->getmessageAuteur() ?></textarea>

            <button type="submit">submit</button>
        </form>
        
    </div>

<?php } ?>