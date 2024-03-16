<?php
    $posts = $result["data"]['posts'];  
?>

<h1>Liste des posts</h1>
<?php
//Boucle permettant d'afficher la liste des Posts par Topic selon la Catégorie
    
foreach ($posts as $post) {
    echo '<div>' . $post->getText() . '</div>';



   }  ?>  
       
 



