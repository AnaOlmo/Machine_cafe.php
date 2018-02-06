<?php
	include "fonctions1_test.php";

	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Machine à café en php</title>
	<!-- liens vers les librairies jquery et bootstrap-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
    <!-- liens vers les librairies locales-->
    <link rel="stylesheet" href="style1.css">
    
	
</head>
<body>

	<div class="mainContener">
		<h1>Ma Machine à café en PHP</h1>
		
		<div id="afficheurInfo" class="date">
			Today is  <?= $date?> <!-- Insertion de la date du jour en php -->
			il est <?= $heure?> <!-- Insertion de l'heure en php -->
		    heures et <?=$minutes?> minutes <!-- Insertion des minutes en php -->
	</div>

		<div class="blocInfos">
			<form method="post" action="machinephp.php">
				<!-- <input type="text" name="choixBoisson" placeholder="Votre choix de boisson"/> -->
				<select name="choixBoisson">
			
					<?php
					foreach ($boissonsTab as $boisson => $recette) {
						echo "<option>" . $boisson . "</option>";
					}
					?>
				</select>

				<p>
                       
				<input type="number" min="0" max="5" name="nbSucre" placeholder="Combien de sucres ?"/>
				<input type="submit" value="Valider"/>
			</p>
			</form>
			
			
			<?php
			 //Teste si la variable existe
			if (isset($_POST["choixBoisson"]) AND isset($_POST["nbSucre"])) {
                burnOut($_POST["nbSucre"]);
				echo "Vous avez choisi '" . $_POST["choixBoisson"] . "', dont la recette est :<br>";
 				echo prepareBoisson($_POST["choixBoisson"], $_POST["nbSucre"]);
			} else {
				echo $messageAttente;
			}
			?>
			
		</div>

		<div class="blocInfos">
			Solde = 
			<?= $argentInsere ?> <!-- Insertion de l'argent inséré en php -->
			.00 €
		</div>
		
	   	<div id="pieces">
	       	<img id="btnCinqCts" class="piece" alt="0.05" src="5_cen.png">
	        <img id="btnDixCts" class="piece" alt="0.10" src="10_cen.png">
	        <img id="btnVingtCts" class="piece" alt="0.20" src="20_cen.png">
	        <img id="btnCinquanteCts" class="piece" alt="0.50" src="50_cen.png">
	        <img id="btnUnEuro" class="piece" alt="1.00" src="1_euros.png">
	        <img id="btnDeuxEuros" class="piece" alt="2.00" src="2_euros.png">
	    </div>
		    <div id="afficheurMonnaie">
		        <div id="monnayeur">Crédit : 0.00 €</div>
			</div>
			<div id="btnResetCoin"><button>Reset Coin</button></div>
	</div>
</body>
</html>

