<?php 
use App\Session;

$topics = $result["data"]["topics"];
?>

<div>

    <div>
        <h1>Profil</h1>
    </div>

    <div>

            <div>

                <p>Identifiant</p>
                <p><?= $_SESSION["user"]->getNickname() ?></p>
                
                <p>Email</p>
                <p><?= $_SESSION["user"]->getEmail() ?></p>
 
                
                <!--
                <a href="index.php?ctrl=user&action=updateUserInfo">
                    <p>Change information</p>
                </a>
                -->

            </div>

        

        <table>

            <thead>

                <tr>
                    <th class="tableTitle">Topic poster</th>
                    <th>Categorie</th>
                    <th>Post</th>
                    <th>Date</th>
                </tr>

            </thead>

            <?php if(isset($topics)) { ?>

                <tbody>

                    <?php foreach($topics as $topic) { ?>

                        
                                <a href="index.php?ctrl=message&action=AffichePost&id=<?= $topic->getId() ?>">
                                    <?= $topic->getTitle() ?>
                                </a>
                            
                            
                            
                                <a href="index.php?ctrl=message&action=AffichePost&id=<?= $topic->getId() ?>">
                                    <?= $topic->getCategory() ?>
                                </a>
                            



                            
                                <?= $topic->getNbxMessages() ?>
                                <span> messages</span>
                            
                            
                            <?= $topic->getFormattedDate("Y-m-d") ?>
                        

                    <?php } ?>

                </tbody>

            <?php } else { ?>

                <tr>
                    <td colspan="4">Aucun topic à été poster</td>
                </tr>

            <?php } ?>

        </table>
        
        <form id="form-content-profile" action="index.php?ctrl=user&action=updateUser"  method="post">
           <!--
            <label for="picture">Upload a picture for your profile!</label>
            <input type="hidden" name="MAX_FILE_SIZE" value="10000"/>
            <input type="file" name="picture" id="picture">
            
-->
            <button type="submit">Enregistrer</button>
        </form>

    </div>

</div>