<?php
    $posts = $result["data"]['posts'];  
?>

<h1>Liste des posts</h1>
<?php
// Boucle permettant d'afficher la liste des Posts par Topic selon la Catégorie
foreach ($posts as $post) { 
    
    $user = $post->getUser();

   /* if (is_object($user)) { */

    echo "Créer par : ";
  		echo '<a href="index.php?ctrl=user&action=detailProfilUtilisateur&id='.$user->getId().'">';
        
       


          echo $post->getUser()->getNickname()
        
        
    
        
        . '</a> ';
    
//var_dump($post);


    // Affiche un lien vers les posts du topic et la date de création
    echo '<a href="index.php?ctrl=forum&action=listPostByTopic&id='.$post->getId() . '">';
    echo $post->getText() . '</a> ';

    // Formatez la DATE DE CREATION avec HEURE
    echo '<small>Créé le ' . 
                date('Y-m-d H:i', strtotime($post->getCreationDate())) . 
        '</small>
    <br>';
}
?>
