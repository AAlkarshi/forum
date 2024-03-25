<?php 
use App\Session;

if(isset($result["security"]["error"])) { 

    $formErrors = $result["security"]["error"];
}

$Post = $result["data"]["post"];

?>

<?php if($Post) { ?>

    <div>
        <div>
            <h1>Mise à jour du POST</h1>
        </div>

        <form action="index.php?ctrl=post&action=updatePost&id=<?= $Post->getId() ?>" method="post">

            
            <label for="text">Post</label>

            <textarea name="text" id="text" cols="60" rows="5">
                <?= $Post->getText() ?>
            </textarea>
            

            <button type="submit">Mettre à jour</button>
        </form>
    </div>

<?php } ?>