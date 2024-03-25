<?php 
use App\Session;

if(isset($result["data"]["formErrors"])) { 

    $formErrors = $result["data"]["formErrors"];
}

$message = $result["data"]["message"];

?>

<?php if($message) { ?>

    <div>
        <div>
            <h1>Mise à jour du POST</h1>
        </div>

        <form action="index.php?ctrl=post&action=updatePost&id=<?= $message->getId() ?>" method="post">

            
            <label for="text">Post</label>

            <textarea name="text" id="text" cols="60" rows="5">
                <?= $message->getText() ?>
            </textarea>
            

            <button type="submit">Mettre à jour</button>
        </form>
    </div>

<?php } ?>