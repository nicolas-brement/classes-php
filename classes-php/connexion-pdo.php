<?php
include "src/Userpdo.php";
include "includes/header.html";

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];

    $new_connect = new Userpdo();
    $new_connect->connect($login, $password);

    $connected = new Userpdo();
    $connected->isConnected();
}
?>

<h2>Se connecter</h2>

<form action="" name='register' method='POST'>

    <label for="login">Votre login </label> <br>
    <input type="text" name="login" id="login" placeholder="votre login" required> <br>

    <label for="password">Mot de passe</label> <br>
    <input type="password" name="password" id="password" placeholder="votre mot de passe" required> <br>

    <button type="submit" name="submit" value="submit">Se connecter</button>
</form>