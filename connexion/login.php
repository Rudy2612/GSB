<!-- //script qui est exécutable sur l'envoie du formulaire de connexion -->

<head>
  <link rel="icon" href="logo.jpg" />
</head>
<?php

include('../connexion/connexion.php');


$login = $_POST["login"];
$pass = $_POST["pass"];


$sql = 'SELECT * FROM login WHERE login="' . $login . '"';
// echo $res;

$res = $bdd->query($sql) or die("erreur avec la requete SQL!");
$row = $res->fetch();

// erreur de mot de passe ou de login
if (empty($row) || $row['login'] != $login) {
  echo "<div class='alert alert-danger error'>le mot de passe ou le login est faux</div>";
  include('../index.php');
// } elseif ($row['mdp'] != $pass) {
} elseif (!password_verify($pass, $row['mdp'])) {
  echo "<div class='alert alert-danger error'>le mot de passe ou le login est faux</div>";
  include('../index.php');

  // connexion réussi
} else {
  // pour VISITEURS
  if ($row['statut'] == 'Visiteur' && password_verify($pass, $row['mdp']) && $row['login'] == $login) {
    session_start();
    $_SESSION["idVisiteur"] = $row['id'];
    echo $_SESSION["idVisiteur"];
    header("Location:../su_remboursement/ConsulterFrais.php");
  }
  // pour COMPTABLE
  if ($row['statut'] == 'Comptable' && password_verify($pass, $row['mdp']) && $row['login'] == $login) {
    session_start();
    $_SESSION["idVisiteur"] = $row['id'];
    header("Location:../validation-frais/validation_frais.php");
  }
}
?>