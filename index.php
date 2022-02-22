<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Exo complet lecture SQL.</title>
    <link rel="stylesheet" href="index.css">
</head>
<body>
<?php
try {
    $server = 'localhost';
    $db = 'exo_197';
    $user = 'root';
    $pswd = '';

    $bdd = new PDO("mysql:host=$server;dbname=$db;charset=utf8", $user, $pswd);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    echo "<div class='title'> Liste des clients</div> <br>";
    $stm = $bdd->prepare("SELECT * FROM clients");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user){
            echo "<p> Info du client : " . "nom : " . $user['lastName'] . " / " .
                "prénom : " . $user['firstName'] . "</p>";
        }
    }

    $stm = $bdd->prepare("SELECT * FROM clients");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user){
            echo "<p> Info du client : " . "nom : " . $user['lastName'] . " / " .
                "prénom : " . $user['firstName'] . "</p> <br>";
        }
    }

    echo "<div class='title'> Liste des shows</div><br>";

    $stm = $bdd->prepare("SELECT * FROM showtypes");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user){
            echo "<p> show disponible : " . $user['type'] . "</p><br>";
        }
    }

    echo "<div class='title'> 20 premiers clients</div><br>";
    $stm = $bdd->prepare("SELECT * FROM clients LIMIT 20");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user){
            echo "<p> Info du client : " . "nom : " . $user['lastName'] . " / " .
                "prénom : " . $user['firstName'] . "</p> <br>";
        }
    }

    echo "<div class='title'> Clients ayant une carte fidélité</div><br>";
    $stm = $bdd->prepare("SELECT * FROM clients WHERE card = 1");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user){
            echo "<p> Client avec une carte fidéltié " . "nom : " . $user['lastName'] . " / Prenom : "  . $user['firstName']."</p> <br>";
        }
    }

    echo "<div class='title'> Clients dont le nom commence par la lettre M</div><br>";
    $stm = $bdd->prepare("SELECT * FROM clients WHERE lastName LIKE 'M%' ORDER BY lastName ASC ");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user){
            echo "<p>" . "nom : " . $user['lastName'] . "  <br> Prenom : "  . $user['firstName']."</p> <br>";
        }
    }

    echo "<div class='title'> Les spectacles</div><br>";
    $stm = $bdd->prepare("SELECT * FROM shows ORDER BY title ASC ");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user){
            echo "<p>" . $user['title'] . "  <br> par : "  . $user['performer']. "<br> le ". " " . $user['date'] . " " . "à : ".
                $user['startTime'] . "</p> <br>";
        }
    }

    echo "<div class='title'> Toutes les données client</div><br>";
    $stm = $bdd->prepare("SELECT * FROM clients");
    if($stm->execute()){
        foreach ($stm->fetchAll() as $user){
            echo "<p> Nom : " . $user['lastName'] . "  <br> Prénom : "  . $user['firstName']. "<br> Date de naissance :  ".
                $user['birthDate'] ."</p> <br>";

            if($user['card'] === '1') {
                echo "<p>Carte de fidélité : oui</p>" . "<p>numéro de carte : $user[cardNumber]</p>";
            }
            else {
                echo "<p>Carte de fidélité : non</p>";
            }
        }
    }
}
catch(PDOException $e){
    echo $e->getMessage();
}

?>
</body>
</html>
