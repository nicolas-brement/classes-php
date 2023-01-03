<?php
        $servername = 'localhost';
        $username = 'root';
        $password = 'root';
        $dbname = 'classes';
            
        //On établit la connexion
        $bdd = mysqli_connect($servername, $username, $password, $dbname);

        $request2 = $bdd->query("SELECT * FROM utilisateurs");       // On lance la requête pour récupérer la table `reservations`
        $reserv = $request2->fetch_all();
?>