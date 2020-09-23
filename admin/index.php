<?php
    session_start();
    $error="";
    if(isset($_POST['login'])){
        if($_POST['login']=="" || $_POST['password']==""){
            $error="Veuillez remplir le formulaire, tout de suite! Merci :)";
        }else{
            require "../connexion.php";
            $login=htmlspecialchars($_POST['login']);
            $password=htmlspecialchars($_POST['password']);

            $req = $bdd->prepare("SELECT * FROM admin WHERE login=?");
            $req->execute([$login]);

            if($don=$req->fetch()){
                if(password_verify($password,$don['password'])){
                    $_SESSION['login']=$don['login'];
                    header("LOCATION:admin.php");
                }else{
                    $error="votre mdp n'existe pas";
                }
            }else{
                $error="Votre login n'existe pas";
            }
        }
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin</title>
</head>

<body>
    <form action="index.php" method="POST">
        <label for="login">Login:</label>
        <div><input type="text" name="login" id="login" value="">
        </div>
        <label for="password">Mot de passe:</label>
        <div><input type="password" name="password" id="password" value="">
        </div>
        <div><input type="submit" value="connexion">
        </div>
    </form>
    <?=$error?>
</body>

</html>