<?php 
use App\Session;
?>

<div id="errorPage">
    <p>ERREUR</p>
    
    <?= Session::getFlash("wrongPage") ?>
    
    <p class="error">Erreur: Cette page n'existe pas</p>
</div>