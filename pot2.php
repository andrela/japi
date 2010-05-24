<html>
<?php 
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   $dateheure=strftime( "Aujourdhui,le %A %d %B %Y à %H:%M:%S");
   $date=strftime("%d/%m/%Y");

include('bastide.php');

if (!empty($_GET["pot"])) {
echo '
<b> Les pots de <font color=\"#FF0000\"> <?php echo $_GET["nom"];?></font><br>
portent le numéro <strong><?php echo $semence;?></strong> et la référence <strong><?php echo $_GET["refab"];?></strong><br>
Il y a actuelement <strong><font color=\"#FF0000\"><?php echo $sold;?></font></strong> graines dans le sachet.<br></b>';
}
echo '<H3>S&eacute;lectionner des pots en cours !!</H3><br>';
?>


<form method="POST" ACTION="plant.php">
<select name="potte"> <?php $num4 = pg_num_rows($pott);
										$i=0; 
										while ($i < $num4) {
										$nr_pot = pg_fetch_result($pott, $i, 0);
										$nom1 = pg_fetch_result($pott, $i, 5);
																							   
										echo "<option value=\"$nr_pot\" SELECTED>$nr_pot-$nom1</option>\n";
										$i++;
										}
										?>
										</select>
	<input type="submit" name="pote" value="Action sur Pots!">
</form>
</div>
</html>
