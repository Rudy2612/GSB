
<!-- //se connecte a la base de données -->
<head>
<link rel="icon" href="logo.jpg" />
</head>
<?php
   try{
      $bdd=new PDO("mysql:host=localhost;dbname=gsb_frais_structure","root","");
   }
   catch(PDOException $e){
      echo $e->getMessage();
   }
?>