<?php
require_once "User.php";

if (isset($_SESSION['login']))
{ echo "Connecté(e) en tant que " . $_SESSION['login']; } 
if (isset($_POST['deconnexion'])) {

    $disconnect = new User();
    $disconnect->disconnect();
    
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Connexion</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatinble" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="style.css">
    <title>Connexion</title>
</head>

<form action="" method="post">
<button type="submit" name="deconnexion" value="Deconnexion">DECONNEXION</button>
</form>
</body>
</html>
