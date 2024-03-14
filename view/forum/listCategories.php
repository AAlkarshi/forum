<?php
//TAB associatif qui stocke des données de data et de categories
    $categories = $result["data"]['categories']; 
    var_dump($categories); 
?>

<h1>Liste des catégories</h1>

<?php
//Boucle permettant d'afficher la liste des Catégorie
    foreach($categories as $category ){ 
        echo $category->getname_Category();
    }  
       
    ?>
 



  
