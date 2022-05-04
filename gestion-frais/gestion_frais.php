<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="logo.jpg" />
</head>


<meta charset="utf-8">

<title>Gestion des frais de visite</title>
<link type="text/css" rel="stylesheet" href="gestions.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script language="javascript">
    function ajoutLigne(pNumero) { //ajoute une ligne de produits/qt a la div "lignes"     
        //masque le bouton en cours
        document.getElementById("but" + pNumero).setAttribute("hidden", "true");
        pNumero++; //incremente le numero de ligne
        var laDiv = document.getElementById("lignes"); //recupere l'objet DOM qui contient les donnees
        var titre = document.createElement("label"); //cree un label
        laDiv.appendChild(titre); //l'ajoute a la DIV
        titre.setAttribute("class", "titre"); //definit les proprietes
        titre.innerHTML = "   " + pNumero + " : ";
        //zone our la date du frais
        var ladate = document.createElement("input");
        laDiv.appendChild(ladate);
        ladate.setAttribute("name", "FRA_AUT_DAT" + pNumero);
        ladate.setAttribute("size", "12");
        ladate.setAttribute("class", "zone");
        ladate.setAttribute("type", "date");
        //zone de saisie pour un nouveau libelle			
        var libelle = document.createElement("input");
        laDiv.appendChild(libelle);
        libelle.setAttribute("name", "FRA_AUT_LIB" + pNumero);
        libelle.setAttribute("size", "30");
        libelle.setAttribute("class", "zone");
        libelle.setAttribute("type", "text");
        //zone de saisie pour un nouveau montant		
        var mont = document.createElement("input");
        laDiv.appendChild(mont);
        mont.setAttribute("name", "FRA_AUT_MONT" + pNumero);
        mont.setAttribute("size", "9");
        mont.setAttribute("class", "zone");
        mont.setAttribute("type", "text");
        var bouton = document.createElement("input");
        laDiv.appendChild(bouton);
        //ajoute une gestion evenementielle en faisant evoluer le numero de la ligne
        bouton.setAttribute("onClick", "ajoutLigne(" + pNumero + ");");
        bouton.setAttribute("type", "button");
        bouton.setAttribute("value", "+");
        bouton.setAttribute("class", "zone button-int");
        bouton.setAttribute("id", "but" + pNumero);

        var br = document.createElement('br');
        laDiv.appendChild(br);


        var adde = document.getElementById('hors_forfait')
        adde.setAttribute("value", pNumero);



        /// GET LAST MOUNTH


    }
</script>

<body>

    <!-- <div name="gauche">
            <div name="coin" class="logo"><img src="logo.jpg" width="300" height="200" /></div>
        </div> -->

    <?php session_start(); ?>


    <!-- // Le reste -->
    <div name="droite" class="tout">

        <div class="home_button">
            <a href="../su_remboursement/ConsulterFrais.php"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                    <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                </svg></a>
        </div>
        <div class="pad-top"></div>
        <div name="haut" class="titre">
            <h1 class="principal-title">Gestion des Frais</h1>
        </div>

        <div class="bas" name="bas">
            <form name="formSaisieFrais" method="post" action="enregSaisieFrais.php" onsubmit="javascript: return verifSaisie();">
                <div class="h3">
                    <h3 class="gros_title"> Ajouter une nouvelle entrée </h3>
                    <hr>
                </div>
                <h1 class="little" style='padding-top: 0px;'>PERIODE D'ENGAGEMENT</h1> </br>
                <label style="margin-right:10px"> Mois :</label>
                <select class="form-control" name="FRA_MOIS" id="prout" style="display: inline-block; width: 20%">
                    <option value="1" id="1">Janvier</option>
                    <option value="2" id="2">Fevrier</option>
                    <option value="3" id="3">Mars</option>
                    <option value="4" id="4">Avril</option>
                    <option value="5" id="5">Mai</option>
                    <option value="6" id="6">Juin</option>
                    <option value="7" id="7">Juillet</option>
                    <option value="8" id="8">Aout</option>
                    <option value="9" id="9">Septembre</option>
                    <option value="10" id="10">Octobre</option>
                    <option value="11" id="11">Novembre</option>
                    <option value="12" id="12">Decembre</option>
                </select>
                <p class="titre" />
                <div>
                    <h3 class="little">Frais au forfait</h3>
                </div>
                <div name="tableau" class="tableau">
                    <table>
                        <tr>
                            <td> <label class="titre">Repas midi : </label></td>
                            <td><input type="text" size="2" name="FRA_REPAS" id="FRA_REPAS" class="zone" /></td>
                            <td> <label class="titre"">Nuitees :</label></td> 
                                    <td><input type=" text" size="2" name="FRA_NUIT" id="FRA_NUIT" class="zone" /></td>
                        </tr>

                        <tr>
                            <td> <label class="titre">Etape :</label></td>
                            <td><input type="text" size="5" name="FRA_ETAP" id="FRA_ETAP" class="zone" /></td>
                            <td> <label class="titre">Km :</label></td>
                            <td> <input type="text" size="5" name="FRA_KM" id="FRA_KM" class="zone" /></td>
                        </tr>
                    </table>
                </div>
                <p class="titre" />
                <div>
                    <h3 class="little">Hors Forfait</h3>
                </div>
                <p class="error-code" id="error-code"></p>
                <div id="lignes">
                    <label class="titre"> 1 : </label>
                    <input type="date" size="12" name="FRA_AUT_DAT1" id="FRA_AUT_DAT1" class="zone" placeholder="Date" aria-label="Date" />
                    <input type="text" size="30" name="FRA_AUT_LIB1" class="zone" placeholder="Libelle" aria-label="Libelle" />
                    <input class="zone" size="9" id="saut" name="FRA_AUT_MONT1" type="text" placeholder="Montant" aria-label="Montant" />
                    <input class="button-int" type="button" id="but1" value="+" onclick="ajoutLigne(1);" class="zone" />
                    <br>
                </div>
                <input class="zone" style="visibility: hidden" id="hors_forfait" name="hors_forfait" value="1" />
                <br>
                <button type="reset" class="btn btn-primary">Effacer</button>
                <button type="submit" class="btn btn-primary">Envoyer</button>
                <br>
                <br>

            </form>
        </div>
    </div>

    <div class="logout_button">
        <a href="../connexion/logout.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
            </svg></a>
    </div>


    <script>
        function verifSaisie() {
            var docu = document.getElementById('FRA_AUT_DAT1')
            var error = document.getElementById('error-code')
            if (docu) {
                if (docu.value.length > 1) {
                    var date = docu.value
                    var dateSaisi = date.split("-")
                    var dateActuYear = new Date().getFullYear();
                    var dateActuMounth = new Date().getMonth();
                    dateActuMounth = dateActuMounth + 1;
                    if(String(dateActuMounth).length == 1){
                        dateActuMounth = "0" + dateActuMounth;  
                    }
                    if (dateActuYear === dateSaisi[0]) {
                        return true;
                        // console.log("erreur 1")
                    } else {
                        // console.log("erreur 2")
                        if (dateSaisi[0] === String(dateActuYear - 1)) {
                            // console.log("erreur 3")
                            return true
                        } else {
                            if (dateActuMounth > dateSaisi[1] || dateActuMounth == dateSaisi[1]) {
                                // console.log("erreur 4")
                                return true;
                            } else {
                                console.log("erreur 5")
                                docu.classList.add('error-saisie')
                                error.textContent = "Les frais hors forfait doivent avoir une ancienneté maximum d'1 an."
                                return false;
                            }

                        }
                    }
                }
            }
        }
    </script>





</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
    // selectionne le mois en cours dans le select
    var mois = new Date()
    mois = mois.getMonth() + 1
    var sqddsq = document.getElementById(String(mois))
    sqddsq.setAttribute('selected', "selected")
</script>

<?php

$mois = date("n");
include('../connexion/connexion.php');
// echo $mois;


$sql = 'SELECT * FROM lignefraisforfait WHERE idVisiteur = ' . $_SESSION["idVisiteur"] . ' AND mois = ' . $mois . '';
// echo $sql;
$res = $bdd->query($sql) or die("erreur avec la requete SQL!2");


// EXPLICATION DE LA DEMARCHE 
// parcours les resultats retournés 

// Si la ligne du mois actuel n'existe pas, alors il faut en créer une initialisé à 0 et cloturer le mois précédent
if (!$ligne = $res->fetch()) {
    $moisPrec = $mois - 1;
    if ($mois == 1) {
        $moisPrec = 12;
    }
    // cloture la fiche de frais du mois précédent
    $sql2 = 'UPDATE fichefrais set idEtat = "CL" WHERE idVisiteur = ' . $_SESSION["idVisiteur"] . ' AND mois = ' . $moisPrec . '';
    $res2 = $bdd->exec($sql2);

    // CREATION DE LA FICHE DE FRAIS DU MOIS ACTUEL
    $sql3 = 'INSERT INTO fichefrais VALUES (' . $_SESSION["idVisiteur"] . ',' . $mois . ',0,NULL,NULL,"CR")';
    $res3 = $bdd->exec($sql3) or die("erreur avec la requete SQL!3");

    $idVisiteur = $_SESSION["idVisiteur"];
    $send1 = "INSERT INTO `lignefraisforfait`(`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES ($idVisiteur, $mois, 'KM', 0)";
    $resSend1 = $bdd->exec($send1) or die("erreur 2");
    $send2 = "INSERT INTO `lignefraisforfait`(`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES ($idVisiteur, $mois, 'ETP', 0)";
    $resSend2 = $bdd->exec($send2) or die("erreur 2");
    $send3 = "INSERT INTO `lignefraisforfait`(`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES ($idVisiteur, $mois, 'NUI', 0)";
    $resSend3 = $bdd->exec($send3) or die("erreur 2");
    $send4 = "INSERT INTO `lignefraisforfait`(`idVisiteur`, `mois`, `idFraisForfait`, `quantite`) VALUES ($idVisiteur, $mois, 'REP', 0)";
    $resSend4 = $bdd->exec($send4) or die("erreur 2");
}

// si la ligne du mois en cours à déjà été créer, alors on assigne les valeurs reçu dans tous les input
else {
    $id = "";
    $type = $ligne['idFraisForfait'];
    $qte = $ligne['quantite'];
    if ($type === "ETP") {
        $id = "FRA_ETAP";
    }
    if ($type === "KM") {
        $id = "FRA_KM";
    }
    if ($type === "NUI") {
        $id = "FRA_NUIT";
    }
    if ($type === "REP") {
        $id = "FRA_REPAS";
    }
?>
    <script>
        var docut = document.getElementById('<?php echo $id; ?>');
        docut.setAttribute('value', "<?php echo $qte ?>");
    </script>
    <?php
}

// continuité du parcours des lignes retourné   
while ($ligne = $res->fetch()) {

    $mois = $ligne['mois'];
    $type = $ligne['idFraisForfait'];
    $qte = $ligne['quantite'];
    if ($type === "ETP") {
    ?>
        <script>
            var doc1 = document.getElementById('FRA_ETAP');
            doc1.setAttribute('value', "<?php echo $qte ?>");
        </script>

    <?php
    }

    if ($type === "KM") {
    ?>
        <script>
            var doc2 = document.getElementById('FRA_KM');
            doc2.setAttribute('value', "<?php echo $qte ?>");
        </script>

    <?php
    }

    if ($type === "NUI") {
    ?>
        <script>
            var doc3 = document.getElementById('FRA_NUIT');
            doc3.setAttribute('value', "<?php echo $qte ?>");
        </script>

    <?php
    }

    if ($type === "REP") {
    ?>
        <script>
            var doc4 = document.getElementById('FRA_REPAS');
            doc4.setAttribute('value', "<?php echo $qte ?>");
        </script>

<?php
    }
}

?>




</html>