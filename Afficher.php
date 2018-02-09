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
 
