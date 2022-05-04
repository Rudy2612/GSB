<?php
    include("../connexion/connexion.php");
    // echo $_POST["mois"];
    // echo $_POST["idUser"];
    if(isset($_POST["idUser"]) && isset($_POST["mois"])){
        $mois = $_POST["mois"];
        $idUser = $_POST["idUser"];
    
        $sql = "SELECT * FROM lignefraisforfait WHERE idVisiteur = $idUser AND mois = $mois";
        // echo $sql;
        $res = $bdd->query($sql);
 
        while($ligne=$res->fetch()){
            $type = $ligne['idFraisForfait'];
            if($type == "ETP" && isset($_POST['FRA_ETAPE'])){
                if($ligne['quantite'] != $_POST['FRA_ETAPE']){
                    $newEtape = $_POST['FRA_ETAPE'];
                    $up1 = "UPDATE lignefraisforfait SET quantite = $newEtape WHERE mois = $mois AND idVisiteur = $idUser AND idFraisForfait = '$type';";
                    $exec1 = $bdd->exec($up1)or die ("error 1");
                }
            }
            if($type == "REP" && isset($_POST['FRA_REPAS'])){
                if($ligne['quantite'] != $_POST['FRA_REPAS']){
                    $newRepas = $_POST['FRA_REPAS'];
                    $up2 = "UPDATE lignefraisforfait SET quantite = $newRepas WHERE mois = $mois AND idVisiteur = $idUser AND idFraisForfait = '$type';";
                    $exec2 = $bdd->exec($up2)or die ("error 2");
                }
            }
            if($type == "NUI" && isset($_POST['FRA_NUI'])){
                if($ligne['quantite'] != $_POST['FRA_NUI']){
                    $newNui = $_POST['FRA_NUI'];
                    $up3 = "UPDATE lignefraisforfait SET quantite = $newNui WHERE mois = $mois AND idVisiteur = $idUser AND idFraisForfait = '$type';";
                    $exec3 = $bdd->exec($up3)or die ("error 3");
                }
            }
            if($type == "KM" && isset($_POST['FRA_KM'])){
                if($ligne['quantite'] != $_POST['FRA_KM']){
                    $newKM = $_POST['FRA_KM'];
                    $up3 = "UPDATE lignefraisforfait SET quantite = $newKM WHERE mois = $mois AND idVisiteur = $idUser AND idFraisForfait = '$type';";
                    $exec3 = $bdd->exec($up3)or die ("error 4");
                }
            }
        }

        date_default_timezone_set('UTC');
        $annee = date("Y");
        $moisM = date("m");
        $jour = date("j");
        // echo $annee . '-' . $mois . '-' . $jour;
        $date = $annee . '-' . $moisM . '-' . $jour;
        echo $date;
        $ficheUpdate = "UPDATE fichefrais SET idEtat = 'VA', dateModif = '$date' WHERE idVisiteur = $idUser AND mois = $mois";
        echo $ficheUpdate;
        $req1 = $bdd -> exec($ficheUpdate) or die ('help me');


    }

    include("./validation_frais.php");



?>