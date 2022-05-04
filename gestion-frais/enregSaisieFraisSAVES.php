<?php

session_start();
$mois = $_POST["FRA_MOIS"];
$idVisiteur = $_SESSION["idVisiteur"];

$nbJustif = $_POST['hors_forfait'];

$Repas = intval($_POST["FRA_REPAS"]);
$Nuite = intval($_POST["FRA_NUIT"]);
$Etape = intval($_POST["FRA_ETAP"]);
$Km = intval($_POST["FRA_KM"]);

echo $Repas;

$c = false;
$e = 1;

echo $Repas;

date_default_timezone_set('UTC');
$annee = date("y");
// $mois = date("m");
$jour = date("j");
echo $annee. '-'.$mois.'-'.$jour;
include('../connexion/connexion.php');


// envoi le gros récap dans fichefrais
$req = "INSERT INTO `fichefrais`(`idVisiteur`, `mois`, `nbJustificatifs`, `montantValide`, `dateModif`, `idEtat`) VALUES ($idVisiteur,$mois,$nbJustif, NULL, '$annee-$mois-$jour','CR')";
echo $req . "<br>";
$res1 = $bdd->exec($req) or die("erreur 25");



// envoi en base de données les forfais basique = repas, nuite, etape, km
if ($Repas === "" || $Repas === null || $Repas == 0) {
} else {
    $send = "INSERT INTO `lignefraisforfait`(`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES ($idVisiteur, $mois, 'REP', $Repas)";
    echo $send . "<br>";
    $resSend1 = $bdd->exec($send) or die("erreur 4");
}

if ($Nuite === "" || $Nuite === null || $Nuite == 0) {
} else {
    $send1 = "INSERT INTO `lignefraisforfait`(`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES ($idVisiteur, $mois, 'NUI', $Nuite)";
    echo $send1 . "<br>";
    $resSend2 = $bdd->exec($send1) or die("erreur 5");
}

if ($Etape === "" || $Etape === null || $Etape == 0) {
} else {
    $send2 = "INSERT INTO `lignefraisforfait`(`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES ($idVisiteur, $mois, 'ETP', $Etape)";
    echo $send2 . "<br>";
    $resSend3 = $bdd->exec($send2) or die("erreur 8");
}

if ($Km === "" || $Km === null || $Km == 0) {
} else {
    $send3 = "INSERT INTO `lignefraisforfait`(`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES ($idVisiteur, $mois, 'KM', $Etape)";
    echo $send3 . "<br>";
    $resSend4 = $bdd->exec($send3) or die("erreur 2");
}





// envoi les hors forfais
for ($u = 1; $u < intval($nbJustif) + 1; $u = $u + 1) {

    $date = $_POST['FRA_AUT_DAT' . $u];
    $libelle = $_POST['FRA_AUT_LIB' . $u];
    $montant = $_POST['FRA_AUT_MONT' . $u];

    $req2 = "INSERT INTO lignefraishorsforfait (`id`,`idVisiteur`,`mois`,`libelle`, `date`, `montant`) VALUES (NULL,$idVisiteur,$mois,'$libelle','$date',$montant)";
    echo "<br><br>" . $req2 . "<br><br>";
    $res2 = $bdd->exec($req2) or die("erreur" . $u);
}

