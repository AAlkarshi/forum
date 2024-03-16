<?php
//TAB associatif qui stocke des données de data et de categories
    $categories = $result["data"]['categories'];  
?>

<h1>Liste des catégories</h1>
<?php
//Boucle permettant d'afficher la liste des Catégorie
    foreach($categories as $category ){  ?>
        <a href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
            <?php echo $category->getNameCategory(); ?> </br>
            
        </a>
   <?php  }  ?>  
       
 



  
