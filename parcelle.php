<html>
<?php 
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   $dateheure=strftime( "Aujourdhui,le %A %d %B %Y à %H:%M:%S");
   $date=strftime("%d/%m/%Y");

		$conn_string = "host=localhost port=5432 dbname=bastide user=andre password=loboG69";
		$dbconn = pg_pconnect($conn_string);

		if (!$dbconn) {
		echo "An error occured.\n";
		exit;
		}

if (!empty($_GET["plan"])) {
echo '
<b> La planche de <font color=\"#FF0000\"> <?php echo ;?></font><br>
porte le numéro <strong><?php echo $semence;?></strong> et la référence <strong><?php echo $refab;?></strong><br>
Il y a actuelement <strong><font color=\"#FF0000\"><?php echo $sold;?></font></strong> graines dans le sachet.<br></b>';
}
echo '<H3>S&eacute;lectionner un planche en cours !!</H3><br>';
?>

<form method="POST" ACTION="plant.php">
   	<select name="parc"> <?php $num3 = pg_num_rows($parcelle);
										$i=0; 
										while ($i < $num3) {
										$nr_planche = pg_fetch_result($parcelle, $i, 0);
										$nom1 = pg_fetch_result($parcelle, $i, 5);
				   
										echo "<option value=\"$nr_planche\" SELECTED>$nr_planche-$nom1</option>\n";
										$i++;
										}
										?>
										</select>
	<input type="submit" name="planche" value="Action sur Planches!">
</form>
</div>
</html>
