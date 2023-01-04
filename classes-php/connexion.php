<?php require_once "User.php" ;
session_start();

if(isset($_POST["envoi"])){
    $login = htmlspecialchars($_POST["login"]);
    $password = htmlspecialchars($_POST["password"]);

    $user=new User($login, $password); 
    $user->connect($login, $password);

    if(isset($_SESSION['login'])){
    $_SESSION['login'] = $login;
    $_SESSION['id'] = $userInfos['id'];
    }
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

<body>

    <div class="message_connexion">

    <?php
    if (isset($_SESSION['login']))
    { echo "Connecté(e) en tant que " . $_SESSION['login']; } 
    ?>
    </div>

    <div id="form_connexion">
    <form method="POST" action="">
        <div class="connexion"><h6><strong>Connexion</strong></h6></div>
        <br>

        <label for="pseudo" name="login" class="form-label">Pseudo:</label><br>
      
        <input type="text" placeholder="Login" name="login">
        <br>
        <label for="password" name="password" class="form-label">Password:</label><br>
   
        <input type="password" placeholder="Mdp" name="password">
        <br>
        
        <input type="submit" id="connect" name="envoi" value="Connexion">
</div>
    </form>
</body>

<footer>
    <a href="https://github.com/nicolas-brement?tab=repositories"><img id="github" src="images/git.png"></a>
</footer>
</html>