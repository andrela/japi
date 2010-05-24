<html>
<body>
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
// Semer direct au champ à partir de sachet1.php
if (!empty ($_POST["plad"])) {
$nom = $_POST["nom"];
$semens = $_POST["semens"];
$refab = $_POST["refab"];
$sold = $_POST["sold"];
echo "<b> Le sachet de <font color=\"#FF0000\"> $nom</font><br>
porte le numéro <strong>$semens</strong> et la référence <strong>$refab</strong><br>
Il y a actuellement <strong><font color=\"#FF0000\">$sold</font></strong> graines dans le sachet.<br>";
}
// Planter à partir d'une plaque de semis 
if (!empty ($_POST["plant"])) {
if (!empty ($_POST["pot"])) {
$nom = "$sort $vare";
echo "<b> Le semis de <font color=\"#FF0000\"> $sort</font><font color=\"#f91616\"> $vare</font><br>
porte le numéro <strong>$plante</strong><br>
Il y avait <strong><font color=\"#FF0000\">$num</font></strong> graines semées.<br>";
}
else {
$pouri = pg_query ("select * from pots where pot_nr = '$pot'");
				if (!$pouri) {
              		echo "An error occured.\n";
              		exit;}
					$resu = pg_fetch_result($pouri);
					$nr_pot = $resu[0];			
					$idpot = $resu[1];
					$semens = $resu[2];
					$nom = $resu[5];
					$dat_crea = $resu[4];
					$sold1 = $resu[12];
					
if (!empty ($_POST["plante"])) {		
echo "<b> Les pots <font color=\"#FF0000\">$nr_pot</font> de <font color=\"#f91616\">$nom!!</font><br>
 proviennent du semis numéro <strong>$plante</strong>, il y en a $sold1 <br clear = \"all\">";
 }
 else {
 echo "<b> Les pots <font color=\"#FF0000\">$nr_pot</font> de <font color=\"#f91616\">$nom!!</font><br>
 proviennent du semis numéro <strong>$semis</strong>, il y en a $sold1 <br clear = \"all\">";
		}
	}
}
if (!empty($_POST["plante"])) {
					$semer = ($_POST["plante"]);
					$plaque = pg_query ($dbconn, "SELECT * from plaques where nr_plak = '$semer'");
	   			   	if (!$plaque) {
              		echo "An error occured.\n";
              		exit;}
		
					$idplak = pg_fetch_result ($plaque,$i,0);		
					$id_pla = pg_fetch_result ($plaque,$i,1);
					$semens = pg_fetch_result ($plaque,$i,2);
					$nom = pg_fetch_result ($plaque,$i,3);
					$dat_crea = pg_fetch_result ($plaque,$i,4);
					$num = pg_fetch_result ($plaque,$i,5);
					$id_lieu = pg_fetch_result ($plaque,$i,10);
		
					$var = pg_query ("SELECT * from semences WHERE nr_sachet = '$semens'");
					$vare = pg_fetch_result ( $var,$i,1);
					$sachets = pg_query ( "SELECT semences.var,semences.nr_sachet,plaques.sem_id,plaques.nr_plak,plaques.nom,plaques.plak_id from semences,plaques WHERE var = '$vare' AND semences.nr_sachet = plaques.sem_id" );
					echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?semis=0#\" id=\"toggle-section-menu\">Semis:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
					while ($res = pg_fetch_row($sachets)){
						echo "<li> <a class=\"menuitem current\" href=?semis=$res[3]>$res[3]-$res[5]-$res[4]</a></li>";
	  	  				 	 			}
					echo "</ul></div></div></div>";
						echo "<b> La plaque de semis <font color=\"#FF0000\">$id_pla</font> de <font color=\"#f91616\">$nom!!</font><br>
						contient le semis num&eacute;ro <strong>$semer</strong>;<br>
						Il y a actuelement <strong><font color=\"#FF0000\">$num</font></strong> plantes sur la plaque.<br clear=\"all\">";
				}
if (!empty($_POST["potte"])) {
	$idpot = ($_POST["potte"]);
	$pottee = pg_query ($dbconn, "SELECT * from pots where pot_nr = '$idpot'");
	   			   	if (!$pottee) {
              		echo "An error occured.\n";
              		exit;}
					$nom = pg_fetch_result($pottee, $i, 5);
					$idplak = pg_fetch_result($pottee, $i, 3);
					$semens = pg_fetch_result($pottee, $i, 2);
					$nombre = pg_fetch_result($pottee, $i, 6);
					$nomb = pg_fetch_result($pottee, $i, 12);
					$srcpot = pg_fetch_result($potte, $i, 15);
					
					$varp = pg_query ("SELECT * from semences WHERE nr_sachet = '$semens'");
					$vares = pg_fetch_result ( $varp,$i,1);
					$potes = pg_query ( "SELECT semences.var,semences.nr_sachet,pots.sem_id,pots.pot_nr,pots.nom,pots.pot_id from semences,pots WHERE var = '$vares' AND semences.nr_sachet = pots.sem_id" );
					echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?plan=0#\" id=\"toggle-section-menu\">Planches :</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
					while ($resp = pg_fetch_row($potes)){
						
						echo "<li><a class=\"menuitem current\" href=?plan=$resp[0]>$resp[0]-$resp[1]-$resp[5]</a></li>";
					}
						echo "</ul></div></div></div>";
		
						echo "<b> Les pots <font color=\"#FF0000\">$idpot</font> de <font color=\"#f91616\">$nom!!</font><br>
						proviennent du semis numéro <strong>$idplak</strong>, il y en avait $nombre <br>
						Il y a actuellement <strong><font color=\"#FF0000\">$nomb</font></strong> pots sur la planche.<br clear = \"all\">";
$sold1 = $nomb ;
}
if (!empty($_POST["parc"])) {
					$planches = $_POST["parc"];
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
					$potes = pg_query ( "SELECT planches.nr_planche,semences.var,semences.nr_sachet,planches.sem_id,planches.pot_nr,planches.nom,planches.parc_id from semences,planches WHERE sem_id = '$vares' AND semences.nr_sachet = planches.sem_id" );
					echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?plan=0#\" id=\"toggle-section-menu\">Planches :</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
					while ($resp = pg_fetch_row($potes)){
						
						echo "<li><a class=\"menuitem current\" href=?plan=$resp[0]>$resp[0]-$resp[1]-$resp[5]</a></li>";
					}
						echo "</ul></div></div></div>";
		
						echo "<b> La planche <font color=\"#FF0000\">$id_planche</font> de <font color=\"#f91616\">$nom!!</font><br>
						provienent des semences numéro <strong>$id_sem</strong>, sa surface est de $dessin<br>
						la r&eacute;colte actuelle est de <strong><font color=\"#FF0000\">$recolte</font></strong> sur la planche.<br clear = \"all\">";
		
					}
?>
</div>
</div>
<div class="grid_4">
<div class="box">
<h2><a href="#">SEMER, je sème, tu sèmes, il sème, nous semons, vous semez, ils s'aiment"</a></H2>
<div id="forms" class="box" >
<form method="POST" ACTION="plant.php">
<fieldset>
<?php
          $nrp = pg_query ("SELECT nr_planche FROM planches order by nr_planche desc");
			 $num = pg_num_rows($nrp);
			 $i = 0;
			 $r = pg_fetch_result($nrp, $i, 0);
			 $nr= ++$r;
		?>
		 <legend>&nbsp;Création d'une planche &nbsp;:</legend>
		 <p><label>nr_planche :</label><input type="text" name="planchnew" value="<?php echo $nr;?>" maxlength="8" size=20 ></p>
		 <p><label>Parcelle :</label><select name="parc">
			 <?php
			 $parc =  pg_query ("SELECT * FROM parcelles ");
				   $num5 = pg_num_rows($parc);
				   $i=0;
				   while ($i < $num5) {
				   $nr_parc = pg_fetch_result($parc, $i, 0);
				   $nom3 = pg_fetch_result($parc, $i, 2);

				   
				   echo "<option value=\"$nr_parc\" selected>$nr_parc-$nom3</option>\n";
				$i++;		  
						  }
			   ?>
			 </select></p>
		  <p><label>Semences :</label><input type="text" name="sem_id" value="<?php echo $semens;?>" size=20 ></p>
		  <p><label>Semis :</label><input type="text" name="semis_id" value="<?php echo $idplak;?>" size=20 ></p>
		  <p><label>Nombre graines plans pots :</label><input type="text" name="nb" size=20 ></p>
		  <p><label>Pots source :</label><input type="text" name="pot_id" value="<?php echo $idpot;?>" size=20 ></p>
		  <p><label>Date :</label><input type="text" name="date" value="<?php echo $date;?>"size=20 ></p>
		  <p><label>Nom :</label><input type="text" name="nom" value="<?php echo $nom;?>" size=20 ></p>
		  <p><label>Dessin :</label>
		  <p>Longueur en cm : <input type="text" name="long" size=5 >  Largeur en cm : <input type="text" name="larg" size=5 ></p>
		  <p><label>Profondeur :</label><input type="text" name="prof" size=20 ></p>
		  <p><label>Destination :</label><select name="client">
			 <?php
			 $client =  pg_query ("SELECT * FROM clients ");
				   $num5 = pg_num_rows($client);
				   $i=0;
				   while ($i < $num5) {
				   $nr_client = pg_fetch_result($client, $i, 0);
				   $nom3 = pg_fetch_result($client, $i, 1);

				   
				   echo "<option value=\"$nom3\" selected>$nom3</option>\n";
				$i++;		  
						  }
			   ?>
			 </select></p>
			<p><label>Travail :</label><select name="trav">
			 <?php
			 $trav =  pg_query ("SELECT * FROM type_trav ");
				   $num2 = pg_num_rows($trav);
				   $i=0;
				   while ($i < $num2) {
				   $nr_type = pg_fetch_result($trav, $i, 5);
				   $nom = pg_fetch_result($trav, $i, 4);

				   
				   echo "<option value=\"$nom\" selected>$nom</option>\n";
				$i++;		  
			}
			   ?>
			 </select></p>
			 <p><label>Nouveau</label><input type="text" name="newtrav" size=20 ></p>
		 	 <p><label>Temps passé :</label><input type="text" name="temps" size=20 ></p>
			 <p><label>Comentaires :</label><input type="text" name="coment" size=20 ></p>
			 
		 <input type="hidden" name="soldg" value="<?php echo $sold;?>">
		 <input type="hidden" name="sold1" value="<?php echo $sold1;?>">
		 <input class="register-button" type="submit" name="plancher" value="Valider"><input class="register-button" type="reset">
		 
				 </fieldset>
				 </form>
			</div> 
		 </div>
	</body>
</html>
