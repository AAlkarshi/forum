<?php 
use App\Session;

if(isset($formErrors)) {
    $formErrors = $result["data"]["formErrors"];
}

?>

<div id="form-container">
    <div id="form-header">
        <h1>Modifier le Mot de Passe</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=changePasswordUser" method="post">
            <label for="email">Email</label>
            <input type="email" name="email" id="email">

            <div class="form-password">
                <label for="password">Nouveau Mot de Passe</label>
                <input type="password" name="password" id="password">
            </div>

            <label for="confirmPassword">Valider le nouveau Mot de Passe</label>
                <input type="password" name="confirmPassword" id="confirmPassword">

            <button type="submit">Confirmer</button>

            <small>
                MDP doit avoir Minimum : <br>
                1 lettres en Majuscule <br> 
                1  lettres en Minuscules <br> 
                1 Chiffre <br> 
                1 Caracteres speciale & minimum 10 characters
            </small>
    </form>
</div>