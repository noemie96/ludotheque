<?php
session_start();
if(!isset($_SESSION['login'])){
    header("LOCATION:403.php");
}

if(isset($_POST['nom'])){
    $err=0;
    // gestion des erreurs
    if(!empty($_POST['nom'])){
        $nom=htmlspecialchars($_POST['nom']);
    }else{
        $err=1;
    }
    if(!empty($_POST['type'])){
        $type=htmlspecialchars($_POST['type']);
    }else{
        $err=2;
    }
    if(!empty($_POST['editeur'])){
        $editeur=htmlspecialchars($_POST['editeur']);
    }else{
        $err=3;
    }
    if(!empty($_POST['support'])){
        $support=htmlspecialchars($_POST['support']);
    }else{
        $err=4;
    }
    if(!empty($_POST['synopsis'])){
        $synopsis=htmlspecialchars($_POST['synopsis']);
    }else{
        $err=5;
    }



    // gestion d'insertion 
    if($err==0){
        require "../connexion.php";
        if(empty($_FILES['image']['tmp_name'])){
            $insert = $bdd->prepare("INSERT INTO jeux(nom,type,editeur,support,synopsis) VALUES(:nom,:tp,:edit,:suppo,:synop)");
            $insert->execute([
                ":nom"=>$nom,
                ":tp"=>$type,
                ":edit"=>$editeur,
                ":suppo"=>$support,
                ":synop"=>$synopsis
            ]);
            $insert->closeCursor();
            header("LOCATION:articles.php?insert=success");
        }else{
            //traitement du fichier
            $dossier = '../images/';
            $fichier = basename($_FILES['image']['name']);
            $taille_maxi = 2000000;
            $taille = filesize($_FILES['image']['tmp_name']);
            $extensions = array('.png','.jpg','.jpeg');
            $extension = strrchr($_FILES['image']['name'], '.'); 
            
            
            
            if(!in_array($extension, $extensions)) // on test si l'extension du fichier uploadé correspond aux extensions autorisées
            {
                $erreur = 'Vous devez uploader un fichier de type png, jpg, jpeg';
               
            }
            if($taille>$taille_maxi)		// on test la taille de notre fichier 
            {
                $erreur = 'Le fichier dépasse la taille autorisée';
            }
            
            if(!isset($erreur)) // Si tout les tests sont OK on passe à l'étape de l'upload sur notre serveur
            {
                //On formate le nom du fichier, strtr remplace tout les KK speciaux en normaux suivant notre liste 
                $fichier = strtr($fichier, 
                    'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                    'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); // preg_replace remplace tout ce qui n'est pas un KK normal en tiret 
                $fichiercptl=rand().$fichier;
                if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichiercptl)) // la fonction renvoie True si l'upload à été realisé 
                {
                    $insert = $bdd->prepare("INSERT INTO jeux(nom,type,image,editeur,support,synopsis) VALUES(:nom,:tp,:image,:edit,:suppo,:synop)");
                    $insert->execute([
                        ":nom"=>$nom,
                        ":tp"=>$type,
                        ":image"=>$fichiercptl,
                        ":edit"=>$editeur,
                        ":suppo"=>$support,
                        ":synop"=>$synopsis
                    ]);
                    $insert->closeCursor();

                    if($extension==".png"){ // je verifie si c'est un png ou un jpg
                        header("LOCATION: redimpng.php?image=".$fichiercptl);
                    }else{
                        header("LOCATION: redim.php?image=".$fichiercptl);
                    }
                    
                        
                }
                else //Sinon (la fonction renvoie FALSE).
                {
                    header("LOCATION:addProduct.php?error=1&upload=echec");
                }
            }
            else
            {
                header("LOCATION:addProduct.php?error=1&fich=".$erreur);
            }	


        }
    }else{
        header("LOCATION:addProduct.php?err=".$err);
    }




}else{
    header("LOCATION:addProduct.php");
}




//vu que ce n'est qu'une page de php, sans html je ne suis pas obligé de mettre le signe de fin du php
?> 