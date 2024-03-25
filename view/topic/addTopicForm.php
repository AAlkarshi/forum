<?php 
use App\Session;

$categories = $result["data"]["categories"];

if(isset($result["data"]["idcategorie"])) {
    $idcategorie = $result["data"]["idcategorie"];
} else {
    $idcategorie = "";
}

?>

<!-- AJOUT D'UN TOPIC DEPUIS UN FORM-->
    
<form id="form-content" action="index.php?ctrl=topic&action=addTopic" method="post">
    <label for="title">Titre du nouveau topic</label>

        <!-- CHAMP NOUVEAU TOPIC INPUT POUR TITRE DU TOPIC -->
        <input id="title" type="text" name="title">

    <label for="categorie">Catégories</label>
        <!-- LISTE DEROULANTE -->
        <select name="categorie" id="categorie">
            <?php foreach($categories as $categorie) { ?>
                <option value="<?= $categorie->getId() ?>" 
                    <?= (isset($idcategorie) && $categorie->getId() == $idcategorie) ? "selected" : "" ?>>
                    <?= $categorie->getNameCategory() ?> 
                </option>
            <?php } ?>
        </select>

<br>

    <!-- TEXTAREA 1ER MESSAGE DU TOPIC -->
    <br>
        <label for="text">1er Message du POST</label>
    <br>
        <textarea name="text" id="text" cols="60" rows="5"> </textarea>
    <br>


     <button type="submit">Envoyer</button>


</form>

    



   
