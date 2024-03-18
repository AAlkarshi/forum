<?php
use App\Session; 
use Service\FieldError;

?>

<div id="form-container">
    <div id="form-header">
        <h1>Connexion afin d'accéder au forum</h1>
    </div>

    <form id="form-content" action="index.php?ctrl=security&action=loginUser" method="post">
        <!-- email -->
        <label for="email">Email</label>
        <input type="email" name="email" id="email">

        <!-- MDP -->
        <div class="form-password">
            <label for="password">Mot de Passe</label>
            <input type="password" name="password" id="password">
        </div>
        
        <button type="submit">Connexion</button> 
        
        <a class="MDPoublier" href="index.php?ctrl=security&action=changePassword">
            <p>Mot de passe oublié ?</p>
        </a>
    </form>      

</div>