<?php 
use App\Session;

?>

<div id="form-container">
    <div id="form-header">
        <h1>S'Inscrire</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=registerUser" method="post">
     
        <!-- SURNOM ou dans BDD nickname -->
        <div class="form-username">
            <label for="nickname">Identifiant</label>
            <input type="text" name="nickname"  id="nickname">       
        </div>

        <!-- EMAIL -->
        <div class="form-email">
            <label for="email">Email</label>
            <input type="email" name="email" id="email"> 
        </div>

        <!-- confirmation Mail -->
        <div class="form-confirm">
            <label for="confirmEmail">Confirmation de l'email</label>
            <input type="email" name="confirmEmail" id="confirmEmail">

        </div>

        <!-- MDP -->
        <div class="form-password">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" id="password">
        </div>

        <!-- Confirmation MDP -->
        <div class="form-confirm">
            <label for="confirmPassword">Confirmer le Mot de passe</label>
            <input type="password" name="confirmPassword" id="confirmPassword">
        </div>
            
        <button type="submit">S'Inscrire</button>
<br>
            <small>
            MDP doit avoir Minimum : <br>
            1 lettres en Majuscule <br> 
            1  lettres en Minuscules <br> 
            1 Chiffre <br> 
            1 Caracteres speciale & minimum 6 characters
            </small>
    </form>
</div>