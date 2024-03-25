<?php 
use App\Session;

$topics = $result["data"]["topics"];
$user = $result["data"]["user"];

$userRole = "";
$isAdmin = null;
$isUser = null;

$current = "(CURRENT ROLE)";

if(Session::isAdmin()) {
    $isAdmin = "selected";
} else {
    $isUser = "selected";
}

?>

<div>

    <?php if($user) { ?>

        <div>
            <h1><?= $user->getNickname() ?> Profil </h1>
        </div>
        
        <div>
            
            <div>

                <div>

                    <p>Identifiant</p>
                    <p><?= $user->getNickname() ?></p>

                    <?php if(Session::isAdmin()) { ?>

                        <form action="index.php?ctrl=user&action=updateRole&id=<?= $user->getId() ?>" method="post">
                            <label for="role">Role</label>
                            <select name="role" id="role">
                                <option value="ROLE_ADMIN" <?= $user->getRole() == "ROLE_ADMIN" ? "selected" : "" ?> >ADMIN</option>
                                <option value="ROLE_USER" <?= $user->getRole() == "ROLE_USER" ? "selected" : "" ?> >USER</option>
                            </select>

                            <button type="submit">Change</button>
                        </form>

                    <?php } ?> 

                </div>

            </div>

            <table>

                <thead>
                    <tr>
                        <th>Topic qui ont été poster</th>
                        <th>Categories</th>
                        <th>Posts</th>
                        <th>date</th>
                    </tr>
                </thead>

                <?php if(isset($topics)) { ?>

                    

                        <?php foreach($topics as $topic) { ?>

                            <tr>
                                <td>
                                    <a href="index.php?ctrl=message&action=AffichePost&id=<?= $topic->getId() ?>">
                                        <?= $topic->getTitle() ?>
                                    </a>
                                </td>
                                
                               

                                <td><?= $topic->getNbxMessages() ?><span>messages</span></td>
                                <td><?= $topic->getFormattedDate("Y-m-d") ?></td>
                            </tr>

                        <?php } ?>

                    

                <?php } else { ?>
                    
                        <p>L'utilisateur n'a rien poster</p>
                    
                <?php } ?>

            </table>

        </div>

    <?php } ?>

</div>