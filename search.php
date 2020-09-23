<?php
if(isset($_GET['search'])){
    $search=htmlspecialchars($_GET['search']);
    
        
}else{
    $search="";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Recherche</h1>
    <form action="search.php" method="GET">
    <div>
        <label for="search">Recherche: </label>
        <input type="text" id="search" name="search" value="<?= $search ?>">
    </div>
</form>
<h3>Résultat de la recherche</h3>
<?php
    if(!empty($search)){
        require "connexion.php";
        $req= $bdd->prepare("SELECT * FROM jeux WHERE nom=?");
        $req->execute([$search]);
        $row = $req->rowCount();// permet de connaitre le nombre de résultat avec ma requete
        if($row!=0){
             while($don=$req->fetch()){
            echo "<a href='jeux.php?id=".$don['id']."'>".$don['nom']."</a>";
        }
        }else{
            echo "aucun résultat pour ".$search; 
        }
        $req->closeCursor();
    }

?>
</body>
</html>