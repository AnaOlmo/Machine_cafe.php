

<?php //creation de variable boissons, date, argent,message//
$expresso="cafe";
$latte="latte";
$tea="tea";
$chocolat="chocolat";
$time=date("j-m-y");
$monneyInsert = 0;
$message ="En attente";
?>


 
<!DOCTYPE html>
<html>
<body>
<!-- la liste des boissons disponibles -->
	<h1>Machine à café</h1>
	<p>
		<ol>
			<?="<li>".$expresso."</li>"?>
			<?="<li>".$latte."</li>"?>
			<?="<li>".$tea."</li>"?>
			<?="<li>".$chocolat."</li>"?>

		</ol>
		
	</p> 
<!-- un message « en attente »    -->
	<p>
	<?=$message;?>
</p>
<!--la date du jour (date du serveur)     -->
<p>
<?="Nous sommes le  $time "?>
</p>
<!--  la somme d’agent insérée (0 au démarrage).     -->
<p>
<?="la somme inséree :  $monneyInsert "?>
</p>
<!-- link a une page externe php     -->
	<a href="page1.php">page1<a/>
</body>
</html>