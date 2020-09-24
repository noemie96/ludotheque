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
    <title>Ajout jeux</title>
</head>
<body>
    <h1>Ajouter un jeux</h1> 
    <form action="treatmentAddProduct.php" method="POST" enctype="multipart/form-data">  
    <div>
    <label for="nom">Nom: </label>
    <input type="text" name="nom" id="nom" value="">
    </div>
    <div>
    <label for="type">Type: </label>
    <input type="text" name="type" id="text" value="">
    </div>
    <div>
    <label for="editeur">Editeur: </label>
    <input type="text" name="editeur" id="editeur" value="">
    </div>
    <div>
    <label for="support">Support: </label>
    <select class="form-control" id="support"  name="support">
            <option value="PC">PC</option>
             <option value="PS3">PS3</option>
             <option value="PS4">PS4</option>
             <option value="PS5">PS5</option>
             
     </select>
    </div>
    <div>
    <label for="synopsis">Synopsis: </label>
    <textarea type="text" name="synopsis" id="synopsis" cols="30" rows="10"></textarea>
    </div>
    <div>
    <label for="image">Image: </label>
    <input type="file" name="image" id="image" 
    </div>
    <div>
    <input type="submit" value="Ajouter">
    </div>
    </form>
    <br>
<a href="articles.php">retour</a>
</body>
</html>