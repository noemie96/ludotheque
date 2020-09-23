<?php
session_start();

	
$source = imagecreatefrompng("../images/".$_GET['image']); // La photo est la source




// getimagesize renvoie une array contenant la largeur [0] et la hauteur [1]

$TailleImageChoisie = getimagesize("../images/".$_GET['image']);

// je définis la largeur de ma future image.

$NouvelleLargeur = 400;

 

//  je calcule le pourcentage de réduction qui correspond au quotient de l'ancienne largeur par la nouvelle.

$Reduction = ( ($NouvelleLargeur * 100)/$TailleImageChoisie[0] );

 

//  je détermine la hauteur de la nouvelle image en appliquant le pourcentage de réduction à l'ancienne hauteur.

$NouvelleHauteur = ( ($TailleImageChoisie[1] * $Reduction)/100 );


$destination =  imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur"); // On crée la miniature vide


/* Pour garder la transparance du fichier png */
imagealphablending( $destination, false );
imagesavealpha( $destination, true );


// On crée la miniature

imagecopyresampled($destination, $source, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);


// On enregistre la miniature sous le nom "mini_"

$rep_nom="../images/mini_".$_GET['image'];

imagepng($destination,$rep_nom);

// redirection
if(isset($_GET['upload'])){
    header("LOCATION:index.php?update=success&id=".$_GET['upload']);
}else{
    header("LOCATION:index.php?add=succes");
}

?>