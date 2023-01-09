<?php

// La Classe
class Userpdo
{
    // Attributs de la classe User
    private $id;
    public $login;
    public $email;
    public $firstname;
    public $lastname;
    private $db;

// # - - MÉTHODES - - # //

    // Construct pour la connexion à la BDD
    function __construct()
    {
        $DB_DSN = 'mysql:host=localhost; dbname=classes';
        $username = 'root';
        $password_db = 'root';

        try {
            $options =
                [
                    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // BE SURE TO WORK IN UTF8
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,//ERROR TYPE
                    PDO::ATTR_EMULATE_PREPARES => false // FOR NO EMULATE PREPARE (SQL INJECTION)
                ];
            $db = new PDO($DB_DSN, $username, $password_db, $options); // PDO CONNECT

        } catch (PDOException $e) { //CATCH ERROR IF NOT CONNECTED
            print "Erreur !: " . $e->getMessage() . "</br>";
            die();
        }
    }

    // Méthode pour que l'utilisateur puisse s'enregitrer
    public function register($login, $password, $email, $firstname, $lastname)
    {
        // on appelle l'objet dans la méthode courante
        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;

        // la requête pour insérer les données dans la BDD
        $sql_insert = "INSERT INTO utilisateurs(login, password, email, firstname, lastname) 
                       VALUES(:login, :password, :email, :firstname, :lastname)";
        $sql_insert_exe = $this->db->prepare($sql_insert);
        $sql_insert_exe->bindParam(':login', $login);
        $sql_insert_exe->bindParam(':password', $password);
        $sql_insert_exe->bindParam(':email', $email);
        $sql_insert_exe->bindParam(':firstname', $firstname);
        $sql_insert_exe->bindParam(':lastname', $lastname);
        $sql_insert_exe->execute();

        // on execute la requête et vérifie si celle-ci est executée ou non
        if ($sql_insert_exe) {
            echo "Inscription réussie";
        } else {
            echo "L'inscription a échoué";
        }
    }

    // Méthode pour que l'utilisateur puisse se connecter
    public function connect($login, $password)
    {
        $this->login = $login;
        $this->password = $password;

        $sql_verify = "SELECT * FROM utilisateurs WHERE login = '$login' AND password = '$password'";
        $sql_verify_exe = mysqli_query($this->db, $sql_verify); // Execute query on the database
        $result = $sql_verify_exe->fetch_assoc();

        if ($result['login'] && $result['password'] == $_POST['login'] && $_POST['password']) {
            session_start();
            $_SESSION['login'] = $login;
            echo "Connexion réussie" . "<br>";
            header("Refresh:3; url=profil.php");

        } else {
            echo "La connexion a échoué";
        }
    }

    // Méthode pour que l'utilisateur puisse se déconnecter
    public function disconnect()
    {
        echo "Vous êtes en train de vous déconnecter";
        unset($_SESSION['login']);
        header("Refresh:2; url=connexion.php");
    }

    // Méthode pour que l'utilisateur puisse supprimer son compte
    public function delete()
    {
        $login = $_SESSION['login'];
        // la requête pour insérer les données dans la BDD
        $sql_delete = "DELETE FROM utilisateurs WHERE login ='$login'";
        // on execute la requête et vérifie si celle-ci est executée ou non
        mysqli_query($this->db, $sql_delete);
        var_dump($sql_delete);
    }

    // Méthode pour que l'utilisateur puisse mettre à jour ses informations
    public function update($login, $password, $email, $lastname, $firstname)
    {


        $sessionLogin = $_SESSION['login'];

        $sql_update = "UPDATE utilisateurs SET login='$login', password='$password', email='$email', firstname='$firstname', lastname='$lastname' WHERE login='$sessionLogin'";
        $sql_update_exe = mysqli_query($this->db, $sql_update);

        $this->login = $login;
        $this->password = $password;
        $this->email = $email;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $_SESSION['login'] = $login;


        if ($sql_update) {
            echo "<br>";
            echo "Profil mis à jour";
        } else {
            echo "Echec de la mise à jour du profil:(";
        }

    }

    // Méthode qui retourne un booléen permettant de savoir si un utilisater est connecté ou non
    public function isConnected()
    {
        if ($_SESSION['login']) {
            echo "Vous êtes connecté en tant que {$_SESSION['login']}";
        } else {
            header("Location: connexion.php");
        }
    }

    // Méthode pour retourner les informations de l'utilisateur dans un tableau
    public function getAllInfos()
    {
        $login = $_SESSION['login'];
        $sql_info = "SELECT * FROM utilisateurs WHERE login = '$login'";
        $sql_info_exe = mysqli_query($this->db, $sql_info); // Execute query on the database
        $result_info = $sql_info_exe->fetch_assoc();
        $this->login = $result_info['login'];
        $this->password = $result_info['password'];
        $this->email = $result_info['email'];
        $this->firstname = $result_info['firstname'];
        $this->lastname = $result_info['lastname'];


    }

    // Méthode pour retourner le login de l'utilisateur
    public function getLogin()
    {
        $login = $_SESSION['login'];
        $sql_login = "SELECT login FROM utilisateurs WHERE login = '$login'";
        $sql_login_exe = mysqli_query($this->db, $sql_login);
        $result_info_login = $sql_login_exe->fetch_assoc();
        $this->login = $result_info_login['login'];
    }

    // Méthode pour retourner l'email de l'utilisateur
    public function getEmail()
    {
        $login = $_SESSION['login'];
        $sql_email = "SELECT * FROM utilisateurs WHERE login = '$login'";
        $sql_email_exe = mysqli_query($this->db, $sql_email);
        $result_info_email = $sql_email_exe->fetch_assoc();
        $this->email = $result_info_email['email'];

    }

    // Méthode pour retourner le firstname de l'utilisateur
    public function getFirstname()
    {
        $login = $_SESSION['login'];
        $sql_firstname = "SELECT * FROM utilisateurs WHERE login = '$login'";
        $sql_firstname_exe = mysqli_query($this->db, $sql_firstname);
        $result_info_firstname = $sql_firstname_exe->fetch_assoc();
        $this->firstname = $result_info_firstname['firstname'];
    }

    // Méthode pour retourner le lastname de l'utilisateur
    public function getLastname()
    {
        $login = $_SESSION['login'];
        $sql_lastname = "SELECT * FROM utilisateurs WHERE login = '$login'";
        $sql_lastname_exe = mysqli_query($this->db, $sql_lastname);
        $result_info_lastname = $sql_lastname_exe->fetch_assoc();
        $this->lastname = $result_info_lastname['lastname'];
    }
}

