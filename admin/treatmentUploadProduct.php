<?php 
    session_start();
    // copie de treatmentAddProduct.php avec modifications

    if(!isset($_SESSION['login'])){
        header("LOCATION:403.php");
    }
    
    // tester si le présence de l'id (obligatoire de savoir qui on modifie)
    if(isset($_GET['id'])){
        $id=htmlspecialchars($_GET['id']); // protection de la valeur
    }else{
        header("LOCATION:articles.php");
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
                // modification de l'entrée
                $upload = $bdd->prepare("UPDATE jeux SET nom=:nom, type=:tp, editeur=:edit, support=:suppo, synopsis=:synop WHERE id=:myid");
                $upload->execute([
                    ":nom"=>$nom,
                    ":tp"=>$type,
                    ":edit"=>$editeur,
                    ":suppo"=>$support,
                    ":synop"=>$synopsis,
                    ":myid"=>$id
                ]);
                $upload->closeCursor();
                header("LOCATION:articles.php?update=success");
            }else{
                // il faut modifier l'image du produit, donc il faut supprimer l'ancienne
                // on récupère les information de l'image
                $reqImg = $bdd->prepare("SELECT image FROM jeux WHERE id=?");
                $reqImg->execute([$id]);
                $donImg=$reqImg->fetch();

                if(!empty($donImg['image'])){
                    unlink("../images/".$donImg['image']); // unlink supprimer un fichier  
                    unlink("../images/mini_".$donImg['image']); // unlink supprimer un fichier  
                }

                //traitement du fichier
                $dossier = '../images/';
                $fichier = basename($_FILES['image']['name']);
                $taille_maxi = 2000000;
                $taille = filesize($_FILES['image']['tmp_name']);
                $extensions = array('.png','.jpg','.jpeg');
                $extension = strrchr($_FILES['image']['name'], '.'); 
                
                
                
                if(!in_array($extension, $extensions))
                {
                    $erreur = 'Vous devez uploader un fichier de type png, jpg, jpeg';
                   
                }
                if($taille>$taille_maxi)
                {
                    $erreur = 'Le fichier dépasse la taille autorisée';
                }
                
                if(!isset($erreur)) 
                {
                     
                    $fichier = strtr($fichier, 
                        'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ', 
                        'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
                    $fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $fichier); 
                    $fichiercptl=rand().$fichier;
                    if(move_uploaded_file($_FILES['image']['tmp_name'], $dossier . $fichiercptl)) 
                    {
                        $upload = $bdd->prepare("UPDATE jeux SET nom=:nom, type=:tp, editeur=:edit, support=:suppo, synopsis=:synop WHERE id=:myid");
                        $upload->execute([
                            ":nom"=>$nom,
                            ":tp"=>$type,
                            ":edit"=>$editeur,
                            ":suppo"=>$support,
                            ":synop"=>$synopsis,
                            ":myid"=>$id
                        ]);
                        $upload->closeCursor();
                        if($extension==".png"){
                            header("LOCATION:redimpng.php?image=".$fichiercptl);
                        }else{
                            header("LOCATION:redim.php?image=".$fichiercptl);
                        }
                            
                    }
                    else 
                    {
                        header("LOCATION:updateProduct.php?id=".$id."&error=1&upload=echec");
                    }
                }
                else
                {
                    header("LOCATION:updateProduct.php?id=".$id."&error=1&fich=".$erreur);
                }	


            }
        }else{
            header("LOCATION:updateProduct.php?id=".$id."&err=".$err);
        }




    }else{
        header("LOCATION:updateProduct.php?id=".$id);
    }




?>