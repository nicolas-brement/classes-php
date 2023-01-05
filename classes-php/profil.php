<?php
require_once "User.php";
session_start();

if (isset($_SESSION['login']))
{
     echo "Connecté(e) en tant que " . $_SESSION['login']; 
   } 

if (isset($_POST['deconnexion'])){ 
    $disconnect = new User();
    $disconnect->disconnect();
}  

if (isset($_POST['supprimer'])){
    $delete = new User();
    $delete->delete();
}

if (isset($_POST['modifier'])){
    var_dump($_SESSION['login']);
    $update = new User($_SESSION['login'], $_SESSION['password']);
    $update->update($login, $password);
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
<input type="submit" name="supprimer" value="supprimer">

<br>
    <section id="tableau">
        <table>
            <form method="post">
                <thead>
                <th>Login</th>
                <th>Password</th>
                </thead>
                <tbody>
                <tr>
                    <td><input id="input_profil" name="login" placeholder="<?php echo $result['login'] ?>"required></td>
                    <td><input id="input_profil" name="password" placeholder="<?php echo $result['password'] ?>"required></td>
                </tr>
                </tbody>
            <tfoot>


                <button class="modifier" type="submit" name="modifier">Modifier</button>
            </tfoot>
            </form>
        </table>
    </section>
</body>
</html>
