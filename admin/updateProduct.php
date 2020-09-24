<?php
session_start();

if(!isset($_SESSION['login'])){
    header("LOCATION:403.php");
}

if(isset($_GET['id'])){
    $id=htmlspecialchars($_GET['id']);
    require "../connexion.php";
    $req=$bdd->prepare("SELECT * FROM jeux WHERE id=?");
    $req->execute([$id]);
    
    if(!$don=$req->fetch()){
        header("LOCATION:articles.php");
    }

    $req->closeCursor();    
    
}else{
    header("LOCATION:articles.php");
}



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modification</title>
</head>
<body>
    <h1>Modifier le jeu: <?= $don['nom']?></h1> 
    <form action="treatmentUploadProduct.php?id=<?= $don['id'] ?>" method="POST" enctype="multipart/form-data">  
    <div>
    <label for="nom">Nom: </label>
    <input type="text" name="nom" id="nom" value="<?= $don['nom']?>">
    </div>
    </div>
    <div>
    <label for="type">Type: </label>
    <input type="text" name="type" id="type" value="<?= $don['type']?>">
    </div>
    <div>
    <label for="editeur">Editeur: </label>
    <input type="text" name="editeur" id="editeur" value="<?= $don['editeur']?>">
    </div>
    <div>
    <label for="support">Support: </label>
    <select fro="support" name="support" id="support">
    <?php
                    if($don['support']=="Pc"){
                        echo '<option value="PC" selected>PC</option>';
                        echo '<option value="PS3">PS3</option>';
                        echo '<option value="PS4">PS4</option>';
                        echo '<option value="PS5">PS5</option>';
                    }elseif($don['support']=="PS3"){
                        echo '<option value="PC" >PC</option>';
                        echo '<option value="PS3" selected>PS3</option>';
                        echo '<option value="PS4">PS4</option>';
                        
                        echo '<option value="PS5">PS5</option>';
                     
                    }elseif($don['support']=="PS4"){
                        echo '<option value="PC" >PC</option>';
                        echo '<option value="PS3">PS3</option>';
                        echo '<option value="PS4" selected>PS4</option>';
                        
                        echo '<option value="PS5">PS5</option>';
                    
                        
                    }else{
                        echo '<option value="PC" >PC</option>';
                        echo '<option value="PS3">PS3</option>';
                        echo '<option value="PS4">PS4</option>';
                        echo '<option value="PS5" selected>PS5</option>';
                      
                    }

                ?>
					
					
				
				</select>
    </div>
    <div>
    <label for="synopsis">Synopsis: </label>
    <textarea type="text" name="synopsis" id="synopsis" cols="30" rows="10"><?= $don['synopsis']?></textarea>
    </div>
    <div>
    <p>Nom de l'image: <?= $don['image']?></p>
    <label for="image">Image: </label>
    <input type="file" name="image" id="image" 
    </div>
    <div>
    <input type="submit" value="Modifier">
    </div>
    </form>
    <br>
<a href="articles.php">retour</a>
</body>
</html>