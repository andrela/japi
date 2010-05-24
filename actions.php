<html>
<body>
<?php 
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   $dateheure=strftime( "Aujourdhui,le %A %d %B %Y à %H:%M:%S");
   $date=strftime("%d/%m/%Y");

echo '<ul class="nav main">
		  <li>
		  <a href="gest.php?categ=0">Cat&eacute;gories</a></li>
		  <li><a href="gest.php?sorteg=0">Sortes</a></li>
		  <li><a href="gest.php?vareg=0" >Vari&eacute;t&eacute;s</a></li>
		  <li><a href="gest.php?semence=0" >Semences</a></li>
		  </ul>
		  <br>
<ul class="nav main">
		  <li>		  
		  <a href="plant.php?semis=0">Semis</a></li>
		  <li><a href="plant.php?pot=0">Pots</a></li>
		  <li><a href="plant.php?plan=0">Planches</a></li>
		  </ul>
<br>';
?>
<?php
$conn_string = "host=localhost port=5432 dbname=bastide user=andre password=loboG69";
$dbconn = pg_pconnect($conn_string);

if (!$dbconn) {
    echo "An error occured.\n";
    exit;
}
// Premier tri ordonné du semis à la planche si un semis est sélectionné
// Le semis est soit sélectionné donc supérieur à 0, soit on le force à 0 pour voir les plaques en cours
if (isset($_GET["semis"])) {
					if ($_GET["semis"] != 0) {
					$semer = $_GET["semis"];
					$plaque = pg_query ($dbconn, "SELECT * from plaques where nr_plak = '$semer'");
	   			   	if (!$plaque) {
              		echo "An error occured.\n";
              		exit;}
		
					$idplak = pg_fetch_result ($plaque,$i,0);		
					$id_pla = pg_fetch_result ($plaque,$i,1);
					$id_sem = pg_fetch_result ($plaque,$i,2);
					$nom = pg_fetch_result ($plaque,$i,3);
					$dat_crea = pg_fetch_result ($plaque,$i,4);
					$num = pg_fetch_result ($plaque,$i,5);
					$id_lieu = pg_fetch_result ($plaque,$i,10);
		
					$var = pg_query ("SELECT * from semences WHERE nr_sachet = '$id_sem'");
					$vare = pg_fetch_result ( $var,$i,1);
					$sachets = pg_query ( "SELECT semences.var,semences.nr_sachet,plaques.sem_id,plaques.nr_plak,plaques.nom,plaques.plak_id from semences,plaques WHERE var = '$vare' AND semences.nr_sachet = plaques.sem_id" );
					echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?semis=0#\" id=\"toggle-section-menu\">Semis:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
					while ($res = pg_fetch_row($sachets)){
						
					echo "<li><a class=\"menuitem current\" href=?semis=$res[3]>$res[3]-$res[5]-$res[4]</a></li>";
	  	  				 	 			}
					echo "</ul></div></div></div>";
					
						echo "<b> La plaque de semis <font color=\"#FF0000\">$id_pla</font> de <font color=\"#f91616\">$nom!!</font><br>
						contient le semis num&eacute;ro <strong>$semer</strong>;<br>
						Il y a actuelement <strong><font color=\"#FF0000\">$num</font></strong> plantes sur la plaque.";
					}
					else 
					{
					$plaque1 = pg_query ($dbconn, "SELECT * from plaques where fin is null");
					include 'plak1.php';
					}
				}
						
if (isset($_GET["pot"])) {
					if ($_GET["pot"] != 0) {
					$pots = $_GET["pot"];
					$pott = pg_query  ($dbconn, "SELECT * from pots where pot_nr = '$pots'");
	   			   	if (!$pott) {
              		echo "An error occured.\n";
              		exit;}
					$nr_pot = pg_fetch_result ($pott,$i,0);			
					$id_pot = pg_fetch_result ($pott,$i,1);
					$id_sem = pg_fetch_result ($pott,$i,2);
					$id_plak = pg_fetch_result ($pott,$i,3);
					$nom = pg_fetch_result ($pott,$i,5);
					$dat_crea = pg_fetch_result ($pott,$i,4);
					$num = pg_fetch_result ($pott,$i,6);
					$sold = pg_fetch_result ($pott,$i,12);
					
					$varp = pg_query ("SELECT * from semences WHERE nr_sachet = '$id_sem'");
					$vares = pg_fetch_result ( $varp,$i,1);
					$potez = pg_query ( "SELECT semences.var,semences.nr_sachet,pots.sem_id,pots.pot_nr,pots.nom,pots.pot_id from semences,pots WHERE var = '$vares' AND semences.nr_sachet = pots.sem_id" );
					echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?pot=0#\" id=\"toggle-section-menu\">Pots:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
					while ($resp = pg_fetch_row($potez)){
						
					echo "<li><a class=\"menuitem current\" href=?pot=$resp[3]>$resp[3]-$resp[5]-$resp[4]</a></li>";
					}
					echo "</ul></div></div></div>";
					
						echo "<b> Les pots <font color=\"#FF0000\">$id_pot</font> de <font color=\"#f91616\">$nom!!</font><br>
						provienent du semis numéro <strong>$id_plak</strong>, il y en a $sold <br>
						Il y a actuelement <strong><font color=\"#FF0000\">$sold</font></strong> pots sur la planche.";
		
					}
					else
					{
					$pott = pg_query ($dbconn, "SELECT * from pots where fin is null");
					include 'pot2.php';
					}
				}
if (isset($_GET["plan"])) {
					if ($_GET["plan"] != 0) {
					$planches = $_GET["plan"];
					$parce = pg_query  ($dbconn, "SELECT * from planches where nr_planche = '$planches'");
	   			   	if (!$parce) {
              		echo "An error occured.\n";
              		exit;}
					$nr_planche = pg_fetch_result ($parce,$i,0);			
					$id_pot = pg_fetch_result ($parce,$i,3);
					$id_sem = pg_fetch_result ($parce,$i,2);
					$nom = pg_fetch_result ($parce,$i,5);
					$dat_crea = pg_fetch_result ($parce,$i,4);
					$dessin = pg_fetch_result ($parce,$i,6);
					$recolte = pg_fetch_result ($parce,$i,12);
					
					$varp = pg_query ("SELECT * from planches WHERE sem_id = '$id_sem'");
					$vares = pg_fetch_result ( $varp,$i,2);
					$plantes = pg_query ( "SELECT planches.nr_planche,semences.var,semences.nr_sachet,planches.sem_id,planches.pot_nr,planches.nom,planches.parc_id from semences,planches WHERE sem_id = '$vares' AND semences.nr_sachet = planches.sem_id" );
					echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?plan=0#\" id=\"toggle-section-menu\">Planches :</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
					while ($resp = pg_fetch_row($plantes)){
						
						echo "<li><a class=\"menuitem current\" href=?plan=$resp[0]>$resp[0]-$resp[1]-$resp[5]</a></li>";
					}
						echo "</ul></div></div></div>";
						
						echo "<b> La planche <font color=\"#FF0000\">$id_planche</font> de <font color=\"#f91616\">$nom!!</font><br>
						provienent des semences numéro <strong>$id_sem</strong>, sa surface est de $dessin<br>
						la r&eacute;colte actuelle est de <strong><font color=\"#FF0000\">$recolte</font></strong> sur la planche.";
		
					}
					else
					{
					$parcelle = pg_query ($dbconn, "SELECT * from planches where fin is null");
					include 'parcelle.php';
					}
				}				
else {
	$plaque1 = pg_query ($dbconn, "SELECT * from plaques where fin is null");
	}
?>
</body>
</html>
