<?php
    if(isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']);
        require "connexion.php";
        $req=$bdd->prepare("SELECT * FROM jeux WHERE id=?");
        $req->execute([$id]);
        
        if(!$don=$req->fetch()){
            header("LOCATION:404.php");
        }

        $req->closeCursor();    
        
    }else{
        header("LOCATION:404.php");
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux: <?= $don['nom']?></title>
</head>
<body>

    <h1><?= $don['nom']?></h1>
    <h2>Type: <?= $don['type']?></h2>
    <div>Editeur: <?= ($don['editeur'])?></div>
    <div>Support: <?= ($don['support'])?></div>
    <div>Synopsis: <?= nl2br($don['synopsis'])?></div>
    <?php
    if(empty($don['image'])){
        echo "pas d'image";
    }else{
        echo "<img src='images/".$don['image']."'>";
    }
?>
</body>
</html>