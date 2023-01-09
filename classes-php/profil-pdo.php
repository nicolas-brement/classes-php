<?php
include "src/Userpdo.php";
include "includes/header.html";

session_start();

$user_display = new Userpdo();
$user_display->getAllInfos();

$login_display = new Userpdo();
$login_display->getLogin();

$email_display = new Userpdo();
$email_display->getEmail();

$firstname_display = new Userpdo();
$firstname_display->getFirstname();

$lastname_display = new Userpdo();
$lastname_display->getLastname();


if(isset($_POST['supprimer'])){
    $user_delete = new Userpdo();
    $user_delete->delete();

}

if(isset($_POST['deconnexion'])) {
    $user_deconnexion = new Userpdo();
    $user_deconnexion->disconnect();
}

if(isset($_POST['modifier'])){
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $lastname = $_POST['lastname'];
    $firstname = $_POST['firstname'];
    $user_modification = new Userpdo();
    $user_modification->update($login, $password, $email, $lastname, $firstname);
}

?>


<form method="POST">
<table>
    <thead>
        <tr>
            <td>Login</td>
            <td>Password</td>
            <td>Email</td>
            <td>Prénom</td>
            <td>Nom</td>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td><input type="text" name="login" value="<?php echo $user_display->login; ?>"</td>
            <td><input type="text" name="password" value="<?php echo $user_display->password; ?>"</td>
            <td><input type="text" name="email" value="<?php echo $user_display->email; ?>"</td>
            <td><input type="text" name="firstname" value="<?php echo $user_display->firstname; ?>"</td>
            <td><input type="text" name="lastname" value="<?php echo $user_display->lastname; ?>"</td>

        </tr>
    </tbody>

</table>
    <button type="submit" value="modifier" name="modifier">Modifier</button>
</form>

<table>
    <thead>
    <tr>
        <td>Login</td>
        <td>Email</td>
        <td>Prénom</td>
        <td>Nom</td>
    </tr>
    </thead>
    <tbody>
    <tr>
        <td><?php echo $login_display->login; ?></td>
        <td><?php echo $email_display->email; ?></td>
        <td><?php echo $firstname_display->firstname; ?></td>
        <td><?php echo $lastname_display->lastname; ?></td>

    </tr>
    </tbody>
</table>

<form method="POST">
    <button type="submit" value="supprimer" name="supprimer">Supprimer</button>
    <button type="submit" value="deconnexion" name="deconnexion">Déconnexion</button>
</form>