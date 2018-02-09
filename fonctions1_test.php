<?php

/* Déclaration des variables */

$date = date("l d F Y"); // Déclaration d'une variable $date qui prend pour valeur la fonction date avec les paramètres le jour (nom + numéro) le mois et l'année
$heure = date("H"); // Déclaration d'une variable $heure qui prend pour valeur la fonction date avec le paramètre Heure
$minutes  = date("i"); // Déclaration d'une variable $minutes qui prend pour valeur la fonction date avec le paramètre minutes
// $boissons = array("Thé Menthe","Chocolat","Café","Expresso"); // Déclaration d'une variable $boissons qui prend pour valeur la fonction tableau comprenant les paramètres des 4 boissons
$messageAttente = "Vous voulez un café ou bien ?"; // Déclaration d'un variable $messageAttente qui prend pour valeur la chaine de caractères du message d'attente
$argentInsere = 0; // Déclaration de la variable $argentInsere qui prend pour valeur 0
//$bdd = new PDO('mysql:host=localhost;dbname=machine_php;charset=utf8', 'root', '');
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
  "Thé" => array(
    "The" => 2,
    "Eau" => 3
   
  ),
  "Moccha" => array(
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
    WHERE boissons.id=:idBoisson" );

  $req ->execute(array('idBoisson'=>$choixBoisson));
  

// On affiche chaque entrée une à une
  echo "votre Boisson qui contient " . "<br>";
  $nomBoisson='';

  while ($donnees = $req->fetch())
  {
    $nomBoisson=$donnees['Libelle'];
    echo  $donnees['Nom'] . ' x ' . $donnees['Qty'] . "<br>" ;
    
  }
  if ($nbSucres >0) {
    $sugar = $nbSucres;
    echo  $sugar. " Sucre(s) " ;
  } 


  echo "<br><br> ** Affichage avec le tableau : <br>";
  
  // Code affichage avec le tableau

//afficher nom boisson selectionee//
  echo  $nomBoisson . ' qui contient ' . "<br>";
//je parcours le tableau boisson jusqu'a la boisson selectionnee//
  foreach ($boissonsTab as $boisson => $recette) {
//si boisson ok//    
    if ($boisson === $nomBoisson){
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

  echo  $nomBoisson . ' qui contient ' . "<br>";

  
//($boissonsTab[$choixboisson]) equivaut a $recette et permet d'acceder au tableau d'ingredients directement//   
  foreach ($boissonsTab[$nomBoisson] as $ingredients => $quantite){
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
// 	foreach($recette as $ingredient => $quantite){
// 	
//    $liste .= $ingredient . " x " . $quantite . "<br/>";	
//   }
//   return $liste;
// }

// function prepareBoisson($boisson, $nbSucres){
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
//$choixBoisson,$nbSucres
//Fonction permettant d'ajouter une vente dans la BDD suite à une commande
    function ajouterVente(){
        $bdd=connectBdd();
        
        /*Récupérer la date de la BDD
        $requetes = $bdd->prepare('SELECT now() as "DateJour"');
        while ($donnees = $requetes->fetch()) {
          $date= $donnees["DateJour"];
        }*/
        
        if (isset($_POST['choixBoisson']) AND isset($_POST['nbSucre'])) {
            $sugar = $_POST['nbSucre'];
            $boisson = $_POST['choixBoisson'];
            $requete = $bdd->prepare('INSERT INTO vente (date_heure,Sucre, Boissons_id) 
                                      VALUES (now(),?,?)');
            $requete->execute(array($sugar, $boisson));
        }
            //$requetes->closeCursor();
    }

    //Fonction pour déduire du stock la quantité de sucre utilisée dans la commande
    function updateStock(){
      $bdd=connectBdd();
      if (isset($_POST['choixBoisson']) AND isset($_POST['nbSucre'])) 
      {
        $sugar = $_POST['nbSucre'];
        $requete= $bdd->prepare('UPDATE ingredients
                  SET Qty_Stock = Qty_Stock - ?
                  WHERE id = "SUC"');
          $requete->execute(array($sugar));
      }
    }

/*function makeAnOrder($data, $codeBoisson, $sucres) {
        $addCommand = $data->prepare("INSERT INTO sales (drinks_code, id, sugar, date) VALUES ( ?, NULL, ?, NOW());");
        $addCommand->execute(array($codeBoisson, $sucres));
        $addCommand->closeCursor();
    }
    function decrementStock($data, $drinkRecipe, $sugar) {
        $decrementIngredients = $data->prepare('UPDATE ingredients SET quantity = quantity - ? WHERE ingredients.id = ? ;');
        
        foreach($drinkRecipe as $ing) {
            $decrementIngredients->execute(array($ing['recipeqty'], $ing['ingredients_id']));
        }
        if($sugar > 0) {
            $decrementIngredients->execute(array($sugar, 6));
        }
        $decrementIngredients->closeCursor();
    }*/

function formulaireBoisson(){
  //je cree le lien avec ma bdd
  $bdd=connectBdd();
  //variable monformulaire contient resultat fonction
  $monFormulaire= "";
  //je recupere dans ma bdd les infos sur boissons
  $req=$bdd->query('SELECT id, Libelle 
    FROM boissons');
  //req Fetch me creer le tableau $mes Boissons contenant le résultat de ma requete
  while ($mesBoissons = $req->fetch()) 
  {
    //constituer formulaire
    $monFormulaire=$monFormulaire . '<option value="'. $mesBoissons["id"].'" > '. $mesBoissons["Libelle"] .'</option>';
  } 
  return $monFormulaire;

}

?>