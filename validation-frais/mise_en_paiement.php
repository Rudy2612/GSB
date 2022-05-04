<?php
    include('../connexion/connexion.php');
    if(isset($_POST['idVisiteur'])){
    $idVisiteur = $_POST['idVisiteur'];
    $Update = "UPDATE fichefrais SET idEtat = 'RB' WHERE idVisiteur = $idVisiteur AND idEtat ='VA'";
    $res = $bdd->exec($Update);
    }






?>