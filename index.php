<?php
    require "connexion.php";
    $reqCount=$bdd->query("SELECT * FROM jeux"); //calcule du nombre de page dont j'ai besoin
    $count = $reqCount->rowCount();
    $nbPage=ceil($count/5);  // arrondi au nb supérieur
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
                 if(isset($_GET['page']))
                {
                    $pg=$_GET['page'];
                }
                else
                {
                    $pg=1;
                }
                $offset=($pg-1)*5;//calcule de l'élément, calcule le début de la limite
                //sql l'élément commence à 0 
                echo "<div id='pagination'>";
                 if($pg>1)
                 {
                 echo "  &nbsp;<a href='index.php?page=".($pg-1)."' title='Page précédente'><</a>";
                 }
                echo "Page ".$pg." ";
                if($pg!=$nbPage)
                 {
                 echo "  &nbsp;<a href='index.php?page=".($pg+1)."' title='Page suivante'>></a>";
                 }

                 echo "</div>";

                  
                   //tu commences à 0 et tu en prends 5
                   $req = $bdd->prepare("SELECT * FROM jeux ORDER BY nom ASC LIMIT :debut, 5 ");
                   $req->bindParam(':debut', $offset, PDO::PARAM_INT);
                   $req->execute();
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