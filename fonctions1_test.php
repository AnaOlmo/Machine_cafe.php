<?php

/* Déclaration des variables */

$date = date("l d F Y"); // Déclaration d'une variable $date qui prend pour valeur la fonction date avec les paramètres le jour (nom + numéro) le mois et l'année
$heure = date("H"); // Déclaration d'une variable $heure qui prend pour valeur la fonction date avec le paramètre Heure
$minutes  = date("i"); // Déclaration d'une variable $minutes qui prend pour valeur la fonction date avec le paramètre minutes
// $boissons = array("Thé Menthe","Chocolat","Café","Expresso"); // Déclaration d'une variable $boissons qui prend pour valeur la fonction tableau comprenant les paramètres des 4 boissons
$messageAttente = "Vous voulez un café ou bien ?"; // Déclaration d'un variable $messageAttente qui prend pour valeur la chaine de caractères du message d'attente
$argentInsere = 0; // Déclaration de la variable $argentInsere qui prend pour valeur 0

// Création d'un tableau multidimentionnel avec les recettes
$boissonsTab = array(
  "Café Long" => array(
    "Café" => 2,
    "Eau"  => 2
  ),
  "Expresso" => array(
    "Café" => 1,
    "Eau"  => 1
  ),
  "Thé" => array(
    "Thé" => 1,
    "Eau" => 1
  )
);
function prisedeTete(){

try
{// On se connecte à MySQL//
	$bdd = new PDO('mysql:host=localhost;dbname=machine_cafe;charset=utf8', 'root', '');
}
catch (Exception $e)
{// En cas d'erreur, on affiche un message et on arrête tout
        
        die('Erreur : ' . $e->getMessage());
}return $bdd;
}
// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table Machine_cafe
//$reponse = $bdd->query("SELECT `Ingredients_id`,`Qty`,`Boissons_id` FROM `ingredients_has_boissons` INNER JOIN ingredients ON id = Ingredients_id WHERE `Boissons_id`='LAT'");

function burnOut($nbSucres){
$bdd=prisedeTete();
$diabete = '';    
$req = $bdd->prepare(
    " SELECT `Ingredients_id`,`Qty`, `Boissons_id`, `Libelle`
     FROM `ingredients_has_boissons`
      INNER JOIN boissons
       ON id = Boissons_id 
       WHERE libelle=:nomBoisson ");

$req ->execute(array('nomBoisson'=>$_POST['choixBoisson']));


// On affiche chaque entrée une à une
echo $_POST['choixBoisson'] . ' qui contient ' . "<br>";

   while ($donnees = $req->fetch())
	{
		
		echo  $donnees['Ingredients_id'] . ' x ' . $donnees['Qty'] . "<br>" ;
		
    }
    if ($nbSucres >0) {
        $diabete = $nbSucres;
        echo  $diabete. " Sucre(s) " ;
      } 
       
      
}



//echo "LAT" . "<br>";
//	while ($donnees = $reponse->fetch())
	//{
		
	//	echo ' qui contient ' . $donnees['Ingredients_id'] . ' x ' . $donnees['Qty'] . "<br>" ;
		
	//}
//	$reponse->closeCursor();


// }

// Fonction qui permet d'éviter de répéter le code
// Affichage selon le nombre de sucres
function ajouterSucre($recetteTab, $nbSucres) {
  if ($nbSucres == 1) {
    array_push($recetteTab, " Sucre x " . $nbSucres);
  } else if ($nbSucres > 1) {
    array_push($recetteTab, " Sucres x " . $nbSucres);
  } else if ($nbSucres == 0) {
    array_push($recetteTab, " Sans sucre");
  }

  return $recetteTab;
}






// Affiche la recette d'UNE SEULE boisson
function prepare($recette) {
	$liste = "";
	foreach($recette as $ingredient => $quantite)
	{
    $liste .= $ingredient . " x " . $quantite . "<br/>";	
  }
  return $liste;
}

function prepareBoisson($boisson, $nbSucres) {
  global $boissonsTab;

  if ($boisson === "Café Long") {
    $recette = $boissonsTab["Café Long"];
  } else if ($boisson === "Expresso") {
    $recette = $boissonsTab["Expresso"];
  } else if ($boisson === "Thé") {
    $recette = $boissonsTab["Thé"];
  }

  if ($nbSucres > 0) {
    $recette["Sucre"] = $nbSucres;
  }
  
  return prepare($recette);
} 

?>