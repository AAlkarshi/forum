<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
    
?>

<h1>Liste des topics</h1>



<?php

// Boucle permettant d'afficher la liste des topics
foreach ($topics as $topic) {
    $user = $topic->getUser();
    echo "Créer par : ";
        echo '<a href="index.php?ctrl=user&action=detailProfilUtilisateur&id='.$user->getId().'">'; 
    
    //ERREUR UTILISATEUR INCONNU A CORRIGER
        echo $topic->getUser()->getNickname().      '</a> ';
    




    // Affiche un lien vers les posts du topic et la date de création
    echo '<a href="index.php?ctrl=forum&action=listPostByTopic&id='.$topic->getId() . '">';
    echo $topic->getTitle() . '</a> ';

    // Formattez la DATE DE CREATION avec HEURE
    echo '<small>Créé le ' . 
    			date('Y-m-d H:i', strtotime($topic->getCreationDate())) . 
    	'</small>
    <br>';
}

?>
