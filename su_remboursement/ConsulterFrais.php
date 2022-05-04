<html>

<head>
    <link rel="icon" href="logo.jpg" />
    <title>Suivi des frais de visite</title>
    <meta charset="utf-8">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- css  -->
    <link href="ConsulterFrais.css" rel="stylesheet">

</head>
<?php


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

?>

<body>
    <div name="droite">

        <div class="pos_button"><a href="../gestion-frais/gestion_frais.php">
                <button class="button_round">
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z" />
                    </svg>
                </button></a>
        </div>
        <div class="pos_logout_button">
            <button class="logout_button"><a href="../connexion/logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M6 12.5a.5.5 0 0 0 .5.5h8a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5h-8a.5.5 0 0 0-.5.5v2a.5.5 0 0 1-1 0v-2A1.5 1.5 0 0 1 6.5 2h8A1.5 1.5 0 0 1 16 3.5v9a1.5 1.5 0 0 1-1.5 1.5h-8A1.5 1.5 0 0 1 5 12.5v-2a.5.5 0 0 1 1 0v2z" />
                        <path fill-rule="evenodd" d="M.146 8.354a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L1.707 7.5H10.5a.5.5 0 0 1 0 1H1.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3z" />
                    </svg>
                </a>
            </button>
        </div>
        <div class="pad-top">
        </div>
        <div name="haut">
            <h1 class="principal-title">Suivi de remboursement des Frais</h1>
        </div>

        <form name="formConsultFrais" method="post" action="ConsulterFrais.php">
            <div class="modal-periode">
                <h1>Période</h1>
                <hr>
                <label>Mois :</label>
                <select class="form-select" name="mois">
                    <option></option>
                    <option value="1">01</option>
                    <option value="2">02</option>
                    <option value="3">03</option>
                    <option value="4">04</option>
                    <option value="5">05</option>
                    <option value="6">06</option>
                    <option value="7">07</option>
                    <option value="8">08</option>
                    <option value="9">09</option>
                    <option value="10">10</option>
                    <option value="11">11</option>
                    <option value="12">12</option>
                </select>
                <label>Année :</label>
                <select class="form-select" name="annee">
                    <option>2021</option>
                    <option>2020</option>
                    <option>2019</option>
                    <option>2018</option>
                    <option>2017</option>
                </select>

                <input type="submit" value="Rechercher" class="btn btn-primary">
            </div>
        </form>




        <?php if (isset($_POST['mois'])) { ?>
            <div name="bas" class="container">
                <div>
                    <h2 class="little-title">Frais au forfait </h2>
                    <table class="table-follow" border="1">
                        <!-- <tr>
                            <th>Repas midi</th>
                            <th>Nuitée </th>
                            <th>Etape</th>
                            <th>Km </th>
                        </tr> -->

                        <?php
                        include('../connexion/connexion.php');
                        $repas = "";
                        $nuit = "";
                        $KM = "";
                        $Date = "";
                        $etape = "";
                        if (isset($_POST['mois'])) {
                            $sql = "SELECT DISTINCT idFraisForfait, mois, quantite FROM lignefraisforfait WHERE mois =" . $_POST['mois'] . " AND idVisiteur = " . $_SESSION["idVisiteur"] . ";";
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


                            // echo "<td>$repas</td>";
                            // echo "<td>$nuit</td>";
                            // echo "<td>$etape</td>";
                            // echo "<td>$KM</td>";
                            // echo "<td></td>";
                            // echo "<td></td>";
                            // echo "<td></td>";

                            // echo "</tr>";
                        }

                        ?>
                    </table>
                </div>
                <div>
                    <h2 class="little-title">Hors Forfait</h2>
                </div>
                <table class="table-follow" border="1">
                    <tr>
                        <th>Date</th>
                        <th>Libellé </th>
                        <th>Montant</th>
                        <!-- <th>Situation</th> -->
                    </tr>
                    <tr>
                        <?php

                        if (isset($_POST['mois'])) {
                            $sql = "SELECT * FROM lignefraishorsforfait WHERE mois =" . $_POST['mois'] . " AND idVisiteur = " . $_SESSION["idVisiteur"] . ";";
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

                <br>
                <table class="table-statut" border="1">
                    <tr>
                        <td>Statut du remboursement</td>
                        <?php

                        $request = "SELECT DISTINCT idEtat FROM fichefrais WHERE mois =" . $_POST['mois'] . " AND idVisiteur = " . $_SESSION["idVisiteur"] . ";";
                        $etat = $bdd->query($request);
                        $ligne = $etat -> fetch();
                        $state = $ligne['idEtat'];
                        $ecrito = "";
                        if($state == "CL"){
                            $ecrito = "Saisie cloturée";
                            echo "<td style='background: ##5c5c5c; color: white'>$ecrito</td>";
                        }
                        if($state == "CR"){
                            $ecrito = "Fiche créer, saisie en cours";
                            echo "<td style='background: #b3b3b3'>$ecrito</td>";
                        }
                        if($state == "RB"){
                            $ecrito = "Remboursée";
                            echo "<td style='background: #00ff0d'>$ecrito</td>";
                        }
                        if($state == "VA"){
                            $ecrito = "Validée et mise en paiement";
                            echo "<td style='background: #00bbff'>$ecrito</td>";
                        }
                        ?>
                    </tr>
                </table>


                <!-- <div class="nb-justif">Nb Justificatifs fournis: <span>4</span></div> -->
            </div>
        <?php } 
        else{
            ?>
            <div>
                <img class="img-no-select" src="selection.png">
                <p class="title-no-select">Selectionnez une période pour visualiser les données</p>
            </div>
            <?php
        } ?>
    </div>

</body>

</html>