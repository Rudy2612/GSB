<head>
<link rel="icon" href="logo.jpg" />
</head>
<?php
   session_start();
   session_destroy();
   header("location:../");
?>