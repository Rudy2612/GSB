<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="icon" href="logo.jpg" />

</head>


<meta charset="utf-8">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

<title>Validations des frais</title>
<link type="text/css" rel="stylesheet" href="validation.css">
<link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


<body>

    <?php
    include('../connexion/connexion.php');
    ?>

    <!-- // Le reste -->
    <div name="droite" class="tout">



        <button class="follow_button">
            <a href="../validation-frais/suivi_paiement.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" style=" color: #FA521C " class="bi bi-file-bar-graph-fill" viewBox="0 0 16 16">
                    <path d="M12 0H4a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2zm-2 11.5v-6a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-.5.5h-1a.5.5 0 0 1-.5-.5zm-2.5.5a.5.5 0 0 1-.5-.5v-4a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-.5.5h-1zm-3 0a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v2a.5.5 0 0 1-.5.5h-1z" />
                </svg>
            </a>
        </button>




        <div class="pad-top"></div>
        <div name="haut" class="titre" style="width: 100%">
            <h1 class="principal-title">Validation des frais</h1>
        </div>


        <div class="bas" name="bas">
            <form name="formSaisieFrais" method="post" action="validation_frais.php">
                <h1 class="little" style='padding-top: 0px;'>PERIODE D'ENGAGEMENT</h1> </br>
                <div>
                    <select name="nameUser" class="form-select align-select">
                        <option selected>Utilisateurs</option>
                        <?php
                        $requestUser = "SELECT nom, prenom, id FROM visiteur WHERE id IN (Select idVisiteur FROM fichefrais WHERE idEtat = 'CL' OR idEtat = 'CR');";
                        $res = $bdd->query($requestUser);
                        while ($ligne = $res->fetch()) {
                            echo '<option value="' . $ligne["id"] . '">' . $ligne["nom"] . " - " . $ligne["prenom"] . '</option>';
                        }
                        ?>
                    </select>
                    <?php
                    $dateM = Date('M');
                    $date = Date('m');
                    $pos = strpos($date, "0");
                    if ($pos === 0) {
                        $date = str_replace("0", "", $date);
                    }
                    echo '<select class="form-select align-select" value="' . $date . '" name="mois">';
                    echo '<option selected name="mois" value="' . $date . '">' . $dateM . '</option>';
                    ?>

                    </select>
                    <button class="btn btn-compta" style="vertical-align: bottom">Rechercher</button>

                </div>
                <br><br>
            </form>
        </div>
        <div class="container">

            <form name="formSaisieFrais" method="post" action="validation_des_frais.php">
                <div>
                    <h3 class="little">Frais au forfait</h3>
                </div>
                <div name="tableau" class="tableau">
                    <table class="tableview">
                        <?php
                        // echo $_POST["nameUser"];
                        // echo $_POST["mois"];
                        if (isset($_POST["nameUser"]) && isset($_POST["mois"])) {
                            $idUser = $_POST["nameUser"];
                            $mois = $_POST["mois"];
                            echo '<input style="visibility: hidden;" type="text" name="idUser" value="'.$idUser.'">';
                            echo '<input style="visibility: hidden;" type="text" name="mois" value="'.$mois.'">';
                            $sqlSearch = "SELECT * FROM lignefraisforfait WHERE idVisiteur = $idUser AND mois = $mois";
                            // echo $sqlSearch;
                            $resu = $bdd->query($sqlSearch);
                            while ($ligne = $resu->fetch()) {
                                if ($ligne["idFraisForfait"] === "REP") {
                        ?>
                                    <tr>
                                        <td><label class="titre">Repas midi : </label></td>
                                        <td style="text-align: left;"><input type="text" size="2" name="FRA_REPAS" class="zone" id="FRA_REPAS" value="<?php echo $ligne["quantite"] ?>" /><button onclick="javascript: return refuseClick(this.id);" id="FRA_REPAS" class="button-refuse">Refuser</button></td>
                                    </tr>
                                <?php
                                }

                                if ($ligne["idFraisForfait"] === "NUI") {
                                ?>
                                    <tr>
                                        <td><label class="titre">Nuitees : </label></td>
                                        <td style="text-align: left;"><input type="text" size="2" name="FRA_NUI" class="zone" id="FRA_NUI" value="<?php echo $ligne["quantite"] ?>" /><button onclick="javascript: return refuseClick(this.id);" id="FRA_NUI" class="button-refuse">Refuser</button></td>
                                    </tr>
                                <?php
                                }

                                if ($ligne["idFraisForfait"] === "ETP") {
                                ?>
                                    <tr>
                                        <td><label class="titre">Etape : </label></td>
                                        <td style="text-align: left;"><input type="text" size="2" name="FRA_ETAPE" class="zone" id="FRA_ETAPE" value="<?php echo $ligne["quantite"] ?>" /><button onclick="javascript: return refuseClick(this.id);" id="FRA_ETAPE" class="button-refuse">Refuser</button></td>
                                    </tr>
                                <?php
                                }

                                if ($ligne["idFraisForfait"] === "KM") {
                                ?>
                                    <tr>
                                        <td><label class="titre">Km : </label></td>
                                        <td style="text-align: left;"><input type="text" size="2" name="FRA_KM" class="zone" id="FRA_FM" value="<?php echo $ligne["quantite"] ?>" /><button onclick="javascript: return refuseClick(this.id);" id="FRA_FM" class="button-refuse">Refuser</button></td>

                                    </tr>
                        <?php
                                }
                            }
                        }
                        ?>

                    </table>


                    <br>
                </div>
                <p class="titre" />
                <div>
                    <h3 class="little">Hors Forfait</h3>
                </div>
                <?php
                if (isset($_POST["nameUser"]) && isset($_POST["mois"])) {
                    $idUser = $_POST["nameUser"];
                    $mois = $_POST["mois"];
                    $sqlSearch = "SELECT * FROM lignefraishorsforfait WHERE idVisiteur = $idUser AND mois = $mois";
                    // echo $sqlSearch;
                    $resu = $bdd->query($sqlSearch);
                    $e = 1;
                    while ($ligne = $resu->fetch()) {
                ?>
                        <div id="lignes">
                            <label class=""><?php echo $e . " : "; ?></label>
                            <input type="text" size="12" name="FRA_AUT_DAT1" class="zone" placeholder="Date" aria-label="Date" value="<?php echo $ligne["date"] ?>" />
                            <input type="text" size="30" id="FRA_AUT_LIB<?php echo $e; ?>" name="FRA_AUT_LIB1" class="zone" placeholder="Libelle" aria-label="Libelle" value="<?php echo $ligne["libelle"] ?>" />
                            <input class="zone" size="9" id="saut" name="FRA_AUT_MONT1" type="text" placeholder="Montant" aria-label="Montant" value="<?php echo $ligne["montant"] ?>" />
                            <svg onClick="refuse(this.id)" id="FRA_AUT_LIB<?php echo $e; ?>" xmlns="http://www.w3.org/2000/svg" width="25" style="vertical-align: text-top; cursor: pointer; color: red" height="25" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                                <path id="FRA_AUT_LIB<?php echo $e; ?>" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z" />
                            </svg>
                            <br>
                        </div>

                <?php
                        $e++;
                    }
                }
                ?>


                <br>
                <button type="submit" class="btn btn-primary " style="background:#FA521C; border:none">Valider les modifications</button>
                <br>
                <br>

            </form>
        </div>
    </div>



    <div class="logout_button">
        <a href="../connexion/logout.php">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
            </svg>
        </a>
    </div>


</body>

<script>
    function refuse(e) {
        var id = e;
        var refuse = document.getElementById(e).value = "REFUSE";
    }

    function refuseClick(e) {
        var id = e;
        var refuse = document.getElementById(e).value = "0";
        return false;
    }
</script>


<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>