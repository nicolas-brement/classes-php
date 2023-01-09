<?php

// Les Attributs de la classe User
class User {
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;

// Le constructeur
public function __construct() {
    $servername = 'localhost';
    $username = 'root';
    $password = 'root';
    $dbname = 'classes';
        
    //On établit la connexion
    $this->db = new mysqli($servername, $username, $password, $dbname);
    if(!$this->db) {
        die("Connexion lost");
    }else{
        echo"Connexion etablie";
    }
  }



// Les méthodes de la classe User
public function register($login, $password, $email, $firstname, $lastname) {

    $this->login = $login;
    $this->email = $email;
    $this->firstname = $firstname;
    $this->lastname = $lastname;
    $this->password = $password;

    //Ajout d'un nouvel utilisateur
    $bdd = "INSERT INTO utilisateurs (login, password, email, firstname, lastname) VALUES ('$login', '$password', '$email', '$firstname', '$lastname')";
    $this->db -> query($bdd);
    if(!$this->db){
        echo "fail";
    }
    header('location: connexion.php');
}

public function connect($login, $password) {
    $this->login = $login;
    $this->password = $password;

    //Connexion au profil
    $bdd2 = "SELECT * FROM utilisateurs WHERE login='$login'";
    $result = $this->db -> query($bdd2);
    $userInfos = $result -> fetch_assoc();
    var_dump($userInfos);
    if($login = $userInfos['login'] && $password = $userInfos['password']){
        echo "connecté";
        session_start();
        $_SESSION['login'] = $login;
        $_SESSION['id'] = $userInfos['id'];
        if(isset($_SESSION['login'])){
        echo "connecté en tant que " . $_SESSION['login'];
        header('Location: profil.php');
    }
}
}

public function disconnect() {
    session_start();
    if(isset($_SESSION['login'])){
        session_destroy();
        header('Location: connexion.php');
    }
}

public function delete() {
   $login=$_SESSION['login'];
   $req="DELETE FROM utilisateurs WHERE login='$login'";
   $del_req=mysqli_query($this->db,$req);
    session_unset();
    header('location: inscription.php');

}

public function update($login, $password) {
    $req1 = "SELECT * FROM utilisateurs WHERE login='$login'";
    $del_req1=mysqli_query($this->db,$req1);
    $result1 = $del_req1->fetch_assoc(); 

    $login_bdd = $result1['login']; 
    $password = $result1['password'];
    $login=$_SESSION['login'];
    
    if ($login != $_POST['login']) {
    $req2="UPDATE `utilisateurs` SET login='{$_POST['login']}' WHERE login='$login'";
    $del_req2=mysqli_query($this->db,$req2);
    echo "Votre login a bien été changé par:" . $_POST['login'] . "<br>"; }

    $password=$_SESSION['password'];
    if ($password != $_POST['password']) {
    $req3="UPDATE `utilisateurs` SET login='{$_POST['password']}' WHERE password='$password'";
    $del_req3=mysqli_query($this->db,$req3);
    echo "Votre mot de passe a bien été changé par:" . $_POST['password'] . "<br>";

}
}

// Méthode pour récupérer le login
public function getLogin(){
    return $_SESSION['user1']->login;
}

// Méthode pour récupérer l'email
public function getEmail(){
    return $_SESSION['user1']->email;
}

// Méthode pour récupérer prénom
public function getFirstname(){
    return $_SESSION['user1']->firstname;
}

// Méthode pour récupérer le nom
public function getLastname(){
    return $_SESSION['user1']->lastname;
}
}


