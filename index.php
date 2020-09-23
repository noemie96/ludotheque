<?php
    require "connexion.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>voici la liste de vos jeux !</h1>
    <?php
    $req = $bdd->query("SELECT * FROM jeux");
    while($don = $req->fetch()){
        echo "<div><a href='jeux.php?id=".$don['id']."'>".$don['nom']."</a></div>";
    }
    $req->closeCursor();
    ?>

    <form action="search.php" method="GET">
    <div>
        <label for="search">Recherche: </label>
        <input type="text" id="search" name="search">
    </div>
    <input type="submit" value="Rechercher">
    </form>
</body>
</html>