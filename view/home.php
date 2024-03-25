<?php

use Service\ConvertDate;
use App\Session;

?>



<!-- Si USER connecté alors ce lien s'affiche -->
<?php if(isset($_SESSION["user"])) { ?>

    <a href="index.php?ctrl=topic&action=addTopicForm">
        Créer un Topic
    </a> 

     <a href="index.php?ctrl=user&action=profile">
        Mon Profil
    </a>


    <a href="index.php?ctrl=topic&action=updateTopicForm">
       Modification du Topic
    </a>


    <a href="index.php?ctrl=post&action=updatePost">
       Modification du Post
    </a>

      <a href="index.php?ctrl=forum&action=AffichePost">
       Affichages des posts
    </a>




<?php } ?>





<h1>BIENVENUE SUR LE FORUM</h1>

<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Sit ut nemo quia voluptas numquam, itaque ipsa soluta ratione eum temporibus aliquid, facere rerum in laborum debitis labore aliquam ullam cumque.</p>

<!--
<p>
    <a href="index.php?ctrl=security&action=login">Se connecter</a>
    <a href="index.php?ctrl=security&action=register">Inscrire</a>
</p>
-->



