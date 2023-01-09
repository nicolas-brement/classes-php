<?php
include "src/Userpdo.php";
include "includes/header.html";

if (isset($_POST['submit'])) {
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $new_user = new Userpdo();
    $new_user->register($login, $password, $email, $firstname, $lastname);
}
?>
<h2>S'inscrire</h2>

<form action="" name='register' method='POST'>

    <label for="login">Votre login </label> <br>
    <input type="text" name="login" id="login" placeholder="votre login" required> <br>

    <label for="email">Votre email </label> <br>
    <input type="text" name="email" id="email" placeholder="votre email" required> <br>

    <label for="firstname">Votre prénom </label> <br>
    <input type="text" name="firstname" placeholder="votre prénom" required><br>

    <label for="lastname">Votre nom</label> <br>
    <input type="text" name="lastname" placeholder="votre nom" required><br>

    <label for="password">Mot de passe</label> <br>
    <input type="password" name="password" id="password" placeholder="votre mot de passe" required> <br>

    <br>
    <button type="submit" name="submit" value="submit">S'inscrire</button>

</form>