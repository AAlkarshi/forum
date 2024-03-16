<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
    
?>

<h1>Liste des topics</h1>

<?php
//Boucle permettant d'afficher la liste des Catégorie
foreach ($topics as $topic) {
    echo '<a href="index.php?ctrl=forum&action=listPostByTopic&id=' . $topic->getId() . '">' .
        $topic->getTitle() . '</a><br>';
}


