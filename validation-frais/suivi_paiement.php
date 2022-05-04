<!DOCTYPE html>
<html lang="en">

<head>

    <link rel="icon" href="logo.jpg" />

    <head>


        <meta charset="utf-8">

        <title>Suivre le paiement fiche de frais</title>
        <link type="text/css" rel="stylesheet" href="suivi_paiement.css">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

    <body>

        <!-- <div name="gauche">
            <div name="coin" class="logo"><img src="logo.jpg" width="300" height="200" /></div>
        </div> -->




        <!-- // Le reste -->
        <div name="droite" class="tout">
            <div class="pad-top"></div>
            <div name="haut" class="titre">
                <h1 class="principal-title">Suivre le paiement fiche de frais</h1>
            </div>
            <div class="home_button">
                <a href="../validation-frais/validation_frais.php"><svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-house-door-fill" viewBox="0 0 16 16">
                        <path d="M6.5 14.5v-3.505c0-.245.25-.495.5-.495h2c.25 0 .5.25.5.5v3.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5z" />
                    </svg></a>
            </div>
            <div class="pos_logout_button">
                <button class="logout_button">
                    <a href="../connexion/logout.php">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#FA521C" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                            <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                        </svg>
                    </a>
                </button>
            </div>

            <div class="bas" name="bas">
                <form name="formSaisieFrais" method="post" action="suivi_paiement.php">
                    <div class="h3">
                        <h3 class="gros_title"> Choix d'une fiche de frais </h3>
                        <hr>
                    </div>
                    <select class="form-select" style="width: 50%; display: inline; vertical-align: middle;" name='idVisiteur'>

                        <?php
                        include('../connexion/connexion.php');

                        $sql1 = "SELECT nom, prenom, mois, idVisiteur FROM fichefrais, visiteur WHERE idEtat = 'VA' AND fichefrais.idVisiteur = visiteur.id";
                        $res1 = $bdd->query($sql1);
                        while ($ligne = $res1->fetch()) {
                            $nom = $ligne['nom'];
                            $prenom = $ligne['prenom'];
                            $mois = Date('M');
                            $idVisiteur = $ligne['idVisiteur'];
                            echo "<option name='idVisiteur' value='$idVisiteur'>$nom $prenom - $mois</option>";
                        }

                        ?>
                    </select>
                    <button type="submit" class="btn btn-primary" style="background: #FA521C; border:none;">Afficher</button>
                    <br>
                    <br>

                </form>
            </div>

            <div class="container">
                <form action="mise_en_paiement.php" method="POST">
                    <input style="visibility: hidden" name="idVisiteur" type="text" value="<?php echo $_POST['idVisiteur'];?>">
                <h2 class="little-title">Frais au forfait </h2>
                <table class="table-follow" border="1">
                    <?php
                    $mois = Date("n");
                    $repas = "";
                    $nuit = "";
                    $KM = "";
                    $Date = "";
                    $etape = "";
                    if (isset($_POST['idVisiteur'])) {
                        $sql = "SELECT DISTINCT idFraisForfait, mois, quantite FROM lignefraisforfait WHERE mois =" . $mois . " AND idVisiteur = " . $_POST['idVisiteur'] . ";";
                        $res = $bdd->query($sql) or die("erreur avec la requete SQL!");
                        while ($ligne = $res->fetch()) {
                            $mois = $ligne['mois'];
                            $qte = $ligne['quantite'];
                            $id = $ligne['idFraisForfait'];
                            if ($id == "REP") {
                                $repas = $qte;
                                echo "<tr>";
                                echo "<th class='line-sign'>Repas Restaurant</th>";
                                echo "<th class='line-qte'>$repas repas ($repas x 25€)</th>";
                                echo "</tr>";
                            }
                            if ($id == "NUI") {
                                $nuit = $qte;
                                echo "<tr>";
                                echo "<th class='line-sign'>Nuitée Hôtel  </th>";
                                echo "<th class='line-qte'>$nuit nuités ($nuit x 80€)</th>";
                                echo "</tr>";
                            }
                            if ($id == "ETP") {
                                $etape = $qte;
                                echo "<tr>";
                                echo "<th class='line-sign'>Forfait Etape</th>";
                                echo "<th class='line-qte'>$etape étape ($etape x 110€)</th>";
                                echo "</tr>";
                            }
                            if ($id == "KM") {
                                $KM = $qte;
                                echo "<tr>";
                                echo "<th class='line-sign'>Frais Kilométrique</th>";
                                echo "<th class='line-qte'>$KM KM ($KM x 0.62€)</th>";
                                echo "</tr>";
                            }
                        }
                    }

                    ?>
                </table>


                <h2 class="little-title">Frais hors-forfait </h2>
                <table class="table-forfais">
                    <tr>
                        <td class="title-table">Date</td>
                        <td class="title-table">Libellé</td>
                        <td class="title-table">Montant</td>
                    </tr>
                    <tr>
                        <?php

                        if (isset($_POST['idVisiteur'])) {
                            $sql = "SELECT * FROM lignefraishorsforfait WHERE mois =" . $mois . " AND idVisiteur = " . $_POST["idVisiteur"] . ";";
                            $res = $bdd->query($sql) or die("erreur avec la requete SQL!");
                            while ($ligne = $res->fetch()) {
                                echo "<tr>";
                                echo '<td width="100">' . $ligne['date'] . '</td>';
                                echo '<td width="100">' . $ligne['libelle'] . '</td>';
                                echo '<td width="100">' . $ligne['montant'] . '</td>';
                                echo "</tr>";
                            }
                        }

                        ?>
                    </tr>
                </table>

                <div class="double-button">
                    <button type="submit" class="btn btn-primary" style="background: #FA521C; border:none;">Mise en paiement</button>
                </div>
                    </form>
            </div>
        </div>






    </body>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</html>