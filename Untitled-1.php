<?php
	include "fonctions1.php";

try
{// On se connecte à MySQL//
	$bdd = new PDO('mysql:host=localhost;dbname=machine_cafe;charset=utf8', 'root', '');
}
catch (Exception $e)
{// En cas d'erreur, on affiche un message et on arrête tout
        
        die('Erreur : ' . $e->getMessage());
}// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table Machine_cafe
$req = $bdd->prepare("SELECT `Ingredients_id`,`Qty`,`Boissons_id` FROM `ingredients_has_boissons` INNER JOIN ingredients ON id = Ingredients_id WHERE `Boissons_id`='?'");
$req ->execute(array($_GET['Boissons_id']));


// On affiche chaque entrée une à une

echo "Boissons_id" . "<br>";
    while ($donnees = $req->fetch())
	{
		
		echo ' qui contient ' . $donnees['Ingredients_id'] . ' x ' . $donnees['Qty'] . "<br>" ;
		
	}
	$reponse->closeCursor();	
?>