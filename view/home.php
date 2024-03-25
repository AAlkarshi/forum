<?php


use App\Session;

?>



<!-- Si USER connecté alors ce lien s'affiche -->
<?php if(isset($_SESSION["user"]))  { ?>
    
        <a href="index.php?ctrl=forum&action=index">Liste des Catégories</a>

        <!-- redirige vers Listes Categories qui obligera USER à selectionner la CATEGORIE => TOPICS => POST -->
        <a href="index.php?ctrl=forum&action=listTopics">Liste des Topics</a>

        <!-- redirige vers Listes Categories qui obligera USER à selectionner la CATEGORIE => TOPICS => POST -->
        <a href="index.php?ctrl=forum&action=listPosts">Liste des Posts</a>

        <br>


        <a href="index.php?ctrl=topic&action=addTopicForm">Créer un Topic </a> 



         <!--   
        NBX DE POST PAR TOPIC ne veux pas s'afficher A CORRIGE
        -->
        <a href="index.php?ctrl=user&action=monprofil&id=<?= ($_SESSION["user"]->getId()) ?>">Mon Profil</a>

        <!--   
            le ID en URL s'arrete à 5 sois le nbx de catégorie A CORRIGE
        -->
        <a href="index.php?ctrl=topic&action=updateTopicForm&id=<?= ($_SESSION["user"]->getId()) ?>">Modification du topic</a>





        <a href="index.php?ctrl=post&action=updatePost">Modification du Post </a>

        <a href="index.php?ctrl=forum&action=AffichePost">Affichages des posts</a>
            



<?php } ?>









<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<!--
<p>
    <a href="index.php?ctrl=security&action=login">Se connecter</a>
    <a href="index.php?ctrl=security&action=register">Inscrire</a>
</p>
-->



