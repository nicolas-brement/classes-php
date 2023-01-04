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
}

   

    
        /*  echo "fail";
    } else {
        echo "Connexion établie" , header('Location: profil.php');
    }
    }
} */

