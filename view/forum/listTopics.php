<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics</h1>



<?php

// Boucle permettant d'afficher la liste des topics
foreach ($topics as $topic) {
    $user = $topic->getUser();
    if (is_object($user)) {
        // Si getUser() retourne un objet, on affiche le lien vers le profil utilisateur
        // et le nickname de l'utilisateur

echo '<a href="index.php?ctrl=user&action=detailProfilUtilisateur&id='.$user->getId().'">'; 


//ERREUR UTILISATEUR INCONNU A CORRIGER
        echo $topic->getUser()->getTitle().  
    '</a> ';
    } else {
        echo 'Utilisateur inconnu ';
    }




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
