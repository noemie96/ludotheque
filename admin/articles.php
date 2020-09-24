<?php
 session_start();
 if(!isset($_SESSION['login'])){
     header("LOCATION:403.php");
 }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jeux</title>
</head>
<body>
    <h1>Administration des jeux</h1>
    <a href="addProduct.php">Ajouter un jeux</a>
    <table border="1">
    <tr>
        <th>id</th>
        <th>nom</th>
        <th>support</th>
    </tr>

   
    <?php
    require "../connexion.php";
        $req = $bdd->query("SELECT * FROM jeux");
        while($don = $req->fetch()){
            echo "<tr>";
                echo "<td>".$don['id']."</td>";
                echo "<td>".$don['nom']."</td>";
                echo "<td>".$don['support']."</td>";
                echo "<td>";
                    echo " <a href='updateProduct.php?id=".$don['id']."'>Modifier</a>";
                    echo " <a href='deleteProduct.php?id=".$don['id']."'>Supprimer</a>";
               echo "</td>";
            echo "</tr>";
        }
        $req->closeCursor();
    ?>
     </table>
     <br>
<a href="index.php">retour</a>
</body>
</html>