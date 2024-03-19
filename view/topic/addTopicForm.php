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
    <input id="title" type="text" name="title">

    <label for="categorie">Catégories</label>
   
        <select name="categorie" id="categorie">
            <?php foreach($categories as $categorie) { ?>

                <option value="<?= $categorie->getId() ?>" 
                    <?= (isset($idcategorie) && $categorie->getId() == $idcategorie) ? "selected" : "" ?>>
                    <?= $categorie->getNameCategory() ?> 
                </option>

            <?php } ?>
        </select>

<br>
    <label for="text">Contenu du Topic</label>
<br>
        <textarea name="text" id="text" cols="60" rows="5"> </textarea>
<br>
    <button type="submit">Envoyer</button>
</form>

    
