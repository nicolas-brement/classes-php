<?php 
require_once "User.php";



if(isset($_POST["inscription"])){
    $login = htmlspecialchars($_POST["login"]);
    $password = htmlspecialchars($_POST["password"]);
    $email = htmlspecialchars($_POST["email"]);
    $firstname = htmlspecialchars($_POST["firstname"]);
    $lastname = htmlspecialchars($_POST["lastname"]);

    $user=new User($login, $password, $email, $firstname, $lastname); 
    $user->register($login, $password, $email, $firstname, $lastname);
}
?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8>
        <meta http-equiv="X-UA-Compatinble" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="css/style_inscription.css">
        <title>Inscription</title>
</head>

<?php 
require_once "User.php";
?>
<body>
        <form method="POST">
        <div class="inscription"><h2><strong>Inscription</strong></h2></div>
        <br>

            <label for="Votre pseudo" class="form-label">Pseudo:</label>
            <input type="text" placeholder="Login" name="login" value="" required>
            <br>

            <label for="Votre pseudo" class="form-label">Email:</label>
            <input type="text" placeholder="Login" name="email" value="" required>
            <br>

            <label for="Votre pseudo" class="form-label">Firstname:</label>
            <input type="text" placeholder="Login" name="firstname" value="" required>
            <br>

            <label for="Votre pseudo" class="form-label">Lastname:</label>
            <input type="text" placeholder="Login" name="lastname" value="" required>
            <br>

            <label for="Mot de passe" class="form-label">Mot de passe:</label>
            <input type="password" placeholder="mdp" name="password" value="" required>
            <br>

            <label for="Confirmer le mot de passe" class="form-label">Confirmer le mot de passe:</label>
            <input type="password" placeholder="Confirmer le mdp" name="confmdp" required>
            <br>

            <input type="submit"  value="S'inscrire" name="inscription">
            <br>
            <br>
            <?= @$erreur ?>
            </form>
     </body>