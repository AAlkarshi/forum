<?php 
use App\Session;
use Model\Managers\TopicManager;



$topics = $result["data"]["topics"];


//$nbxtopic = $TopicManager->getnbxTopic(); 
?>

<div>

      <a href="index.php?ctrl=forum&action=index">Liste des Catégories</a>

        <!-- redirige vers Listes Categories qui obligera USER à selectionner la CATEGORIE => TOPICS => POST -->
        <a href="index.php?ctrl=forum&action=listTopics">Liste des Topics</a>

        <!-- redirige vers Listes Categories qui obligera USER à selectionner la CATEGORIE => TOPICS => POST -->
        <a href="index.php?ctrl=forum&action=listPosts">Liste des Posts</a>

        <br>


        <a href="index.php?ctrl=topic&action=addTopicForm">Créer un Topic </a> 

        <a href="index.php?ctrl=user&action=monprofil&id=<?= ($_SESSION["user"]->getId()) ?>">Mon Profil</a>



    <!--   
        le ID en URL s'arrete à 5 sois le nbx de catéogire A CORRIGE
    -->
        <a href="index.php?ctrl=topic&action=updateTopicForm&id=
            <?= ($_SESSION["user"]->getId()) ?>">  Modification du Topic 
        </a>



        <a href="index.php?ctrl=post&action=updatePost">Modification du Post </a>

        <a href="index.php?ctrl=forum&action=AffichePost">Affichages des posts</a>

    <div>
        <h1>Profil</h1>
    </div>

    <div>

            <div>

                <h2>Identifiant :</h2>                 
                <p><?= $_SESSION["user"]->getNickname() ?></p>
            <br>
                <h2>Email</h2>
                <p><?= $_SESSION["user"]->getEmail() ?></p>
 
            <br>

            <h3> Les topics : </h3>
                <!-- 
                <a href="index.php?ctrl=user&action=updateTopicForm">
                    <p> Modifier les infos </p>
                </a>
            -->

            </div>

    

        <table>

           

          <?php if (isset($topics) && !empty($topics)) : ?>
<tbody>
    <?php foreach ($topics as $topic) : 
         
        
        ?>
        <tr>
                <td>
                    <a href="index.php?ctrl=post&action=AffichePost&id=<?= $topic->getId() ?>">
                        <?= $topic->getTitle() ?>
                    </a>
                </td>
                
                <td><?= $topic->getCategory() ?></td>
                <td><?= $topic->getnbxTopic() ?> messages</td> 
                <td> <?= $topic->getnbxPostByTopics() ?> </td>
                <td><?= $topic->getCreationDate() ?></td>

              
             


        </tr>
    <?php endforeach; ?>
</tbody>
<?php else : ?>
<tr>
    <td>Aucun topic n'a été posté.</td>
</tr>
<?php endif; ?>

</tbody>




        </table>
        
        <form action="index.php?ctrl=user&action=updateUser"  method="post">
            <button type="submit">Enregistrer</button>
        </form>

    </div>

</div>