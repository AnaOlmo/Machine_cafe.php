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
  "Cafe Long" => array(
    "Cafe" => 2,
    "Eau" => 2
  
  ),
  "Expresso" => array(
    "Cafe" => 1,
    "Eau" => 1
  ),
  "Chocolat" => array(
    "Cacao" => 2,
    "Eau" => 3,
    "Lait" => 2
  ),
  "Latte" => array(
    "Cafe" => 2,
    "Eau" => 2,
    "Lait" => 2
  ),    
  "The" => array(
    "The" => 2,
    "Eau" => 3
   
  ),
  "Mocca" => array(
    "Cafe" => 2,
    "Eau" => 3,
    "Cacao" => 2
   
  ),        
);
function connectBdd(){

  try
  {// On se connecte à MySQL//
  	$bdd = new PDO('mysql:host=localhost;dbname=machine_php;charset=utf8', 'root', '');
  }
  catch (Exception $e)
  {// En cas d'erreur, on affiche un message et on arrête tout
          
          die('Erreur : ' . $e->getMessage());
  }
  return $bdd;
}
// Si tout va bien, on peut continuer

// On récupère tout le contenu de la table Machine_cafe
//$reponse = $bdd->query("SELECT `Ingredients_id`,`Qty`,`Boissons_id` FROM `ingredients_has_boissons` INNER JOIN ingredients ON id = Ingredients_id WHERE `Boissons_id`='LAT'");

function afficherRecette($nbSucres,$choixBoisson){
  global $boissonsTab;
  $bdd=connectBdd();
  $sugar = '';  
  $liste = ""; 
  $req = $bdd->prepare(
    " SELECT `ingredients_id`,`Qty`, `Boissons_id`, `Libelle`, `Nom`
    FROM `ingredients_has_boissons`
    INNER JOIN boissons 
    ON boissons.id = Boissons_id
    INNER JOIN ingredients
    ON ingredients.id = Ingredients_id
    WHERE Libelle=:nomBoisson" );

  $req ->execute(array('nomBoisson'=>$choixBoisson));
  

// On affiche chaque entrée une à une
  echo $choixBoisson . ' qui contient ' . "<br>";

  while ($donnees = $req->fetch())
  {
    
    echo  $donnees['Nom'] . ' x ' . $donnees['Qty'] . "<br>" ;
    
  }
  if ($nbSucres >0) {
    $sugar = $nbSucres;
    echo  $sugar. " Sucre(s) " ;
  } 


  echo "<br><br> ** Affichage avec le tableau : <br>";
  
  // Code affichage avec le tableau

//afficher nom boisson selectionee//
  echo  $choixBoisson . ' qui contient ' . "<br>";
//je parcours le tableau boisson jusqu'a la boisson selectionnee//
  foreach ($boissonsTab as $boisson => $recette) {
//si boisson ok//    
    if ($boisson === $choixBoisson){
//je parcours les ingredients//      
      foreach ($recette as $ingredients => $ing){
        echo   $ingredients . ' x ' . $ing . "<br>";//afficher ingredients et quantite//
      } 
    }
  }
//si nb sucre superieur a zero, j'affiche//  
  if ($nbSucres >0) {
    $sugar = $nbSucres;
    echo  $sugar. ' Sucre(s)' . "<br>" ;
  }        

  echo " ** Fin affichage avec le tableau <br><br><br>";   



  echo "<br><br> ** Affichage avec le tableau  plus simple: <br>";
  
  // Code affichage avec le tableau

  echo  $choixBoisson . ' qui contient ' . "<br>";

  
//($boissonsTab[$choixboisson]) equivaut a $recette et permet d'acceder au tableau d'ingredients directement//   
  foreach ($boissonsTab[$choixBoisson] as $ingredients => $quantite){
    echo   $ingredients . ' x ' . $quantite . "<br>";
  } 
  if ($nbSucres >0) {
    $sugar = $nbSucres;
    echo  $sugar. ' Sucre(s)' . "<br>" ;
  }  
   
  echo " ** Fin affichage avec le tableau  plus simple<br><br><br>"; 
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
// function prepare($recette) {
// 	$liste = "";
// 	foreach($recette as $ingredient => $quantite)
// 	{
//     $liste .= $ingredient . " x " . $quantite . "<br/>";	
//   }
//   return $liste;
// }

// function prepareBoisson($boisson, $nbSucres) {
//   global $boissonsTab;

//   if ($boisson === "Cafe Long") {
//     $recette = $boissonsTab["Cafe Long"];
//   } else if ($boisson === "Expresso") {
//     $recette = $boissonsTab["Expresso"];
//   } else if ($boisson === "Chocolat") {
//     $recette = $boissonsTab["Chocolat"];
//   }

//   if ($nbSucres > 0) {
//     $recette["Sucre"] = $nbSucres;
//   }
  
//  // return prepare($recette);
// } 

?>