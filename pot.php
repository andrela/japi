<html>
<?php
	setlocale (LC_ALL, 'fr_FR.UTF-8');
    setlocale (LC_TIME, 'fr_FR.UTF-8');
    $dateheure=strftime( "Aujourdhui,le %A %d %B %Y à %H:%M:%S");
    $date=strftime("%d/%m/%Y");

		$conn_string = "host=localhost port=5432 dbname=bastide user=andre password=loboG69";
		$dbconn = pg_pconnect($conn_string);

		if (!$dbconn) {
		echo "An error occured.\n";
		exit;
		}
		
if (!empty($_POST["potte"])) {
	$idpot = ($_POST["potte"]);
	$pottee = pg_query ($dbconn, "SELECT * from pots where pot_nr = '$idpot'");
	   			   	if (!$pottee) {
              		echo "An error occured.\n";
              		exit;}
					$nom = pg_fetch_result($pottee, $i, 5);
					$idplak = pg_fetch_result($pottee, $i, 3);
					$id_sem = pg_fetch_result($pottee, $i, 2);
					$nombre = pg_fetch_result($pottee, $i, 6);
					$nomb = pg_fetch_result($pottee, $i, 12);
					$srcpot = pg_fetch_result($potte, $i, 15);
					
					$varp = pg_query ("SELECT * from semences WHERE nr_sachet = '$id_sem'");
					$vares = pg_fetch_result ( $varp,$i,1);
					$potes = pg_query ( "SELECT semences.var,semences.nr_sachet,pots.sem_id,pots.pot_nr,pots.nom,pots.pot_id from semences,pots WHERE var = '$vares' AND semences.nr_sachet = pots.sem_id" );
					echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?pot=0#\" id=\"toggle-section-menu\">Pots:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
					while ($resp = pg_fetch_row($potes)){
						
					echo "<li><a class=\"menuitem current\" href=?pot=$resp[3]>$resp[3]-$resp[5]-$resp[4]</a></li>";
					}
					echo "</ul></div></div></div>";
		
						echo "<b> Les pots <font color=\"#FF0000\">$id_pot</font> de <font color=\"#f91616\">$nom!!</font><br>
						proviennent du semis numéro <strong>$idplak</strong>, il y en avait $nombre <br>
						Il y a actuelement <strong><font color=\"#FF0000\">$nomb</font></strong> pots sur la planche.<br>";
}
if (!empty($_POST["semens"])) {
	$id_sem = $_POST["semens"];
	$nom = $_POST["nom"];
}
if (!empty($_POST["plake"])) {
		$semi = ($_POST["semis"]);				
		$plaque = pg_query ($dbconn, "SELECT * from plaques where nr_plak = '$semi'");
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
						echo "<li> <a class=\"menuitem current\" href=?semis=$res[3]>$res[3]-$res[5]-$res[4]</a> </li>";
	  	  				 	 			}
		echo "</ul></div></div></div>";
		echo "<br clear = \"all\"><b> La plaque de semis <font color=\"#FF0000\">$id_pla</font> de <font color=\"#f91616\">$nom!!</font><br>
		contient le semis numéro <strong>$idplak</strong><br>
		Il y a actuellement <strong><font color=\"#FF0000\">$num</font></strong> plantes sur la plaque.<br>";
		}
?>
<div id="forms" class="box" >
<form method="POST" ACTION="plant.php">
	<input type="hidden" name="plante" value="<?php echo $idplak;?>">
	<input type="hidden" name="potte" value="<?php echo $idpot;?>">
	<input class="register-button" type="submit" name="planter" value="Je Plante dans les champs!">
</form>
</div>
</div>
</div>
<div class="grid_4">
<div class="box">
<h2><a href="#">Empotons, rempotons !!</a></h2>
<div id="forms" class="box" >
<form method="POST" ACTION="plant.php">
<fieldset>
<?php
             $nrp = pg_query ("SELECT pot_nr FROM pots order by pot_nr desc");
			 $num = pg_num_rows($nrp);
			 $i = 0;
			 $r = pg_fetch_result($nrp, $i, 0);
			 $nr= ++$r;
		?>
		 <legend>&nbsp;Création de Pots&nbsp;:</legend>
		 <p><label>Numéro de pot :</label><input type="text" name="potnew" value="<?php echo $nr;?>" maxlength="8" size=20 ></p>
		 <p><label>Pots_id :</label><input type="text" name="pots_id" maxlength="4" size=20 ></p>
		 <p><label>Semences :</label><input type="text" name="semence" value="<?php echo $id_sem;?>"size=20 ></p>
		 <p><label>Plaque source :</label><input type="text" name="nr_plak" value="<?php echo $idplak;?>"size=20 ></p>
		 <p><label>Pots source :</label><input type="text" name="srcpot" value="<?php echo $idpot;?>"size=20 ></p>
		 <p><label>Date :</label><input type="text" name="date" value="<?php echo $date;?>"size=20 ></p>
		 <p><label>Nom :</label><input type="text" name="nom" value="<?php echo $nom;?>" size=40 ></p>
		 <p><label>Nombre de pots :</label><input type="text" name="nb" size=20 ></p>
		 <p><label>Type de pots:</label><select name="type" >
			<?php
			$type =  pg_query ($dbconn, "SELECT * FROM types WHERE nr_type < 30 ORDER BY nr_type ");
				   $num2 = pg_num_rows($type);
				   $i=0;
				   while ($i < $num2) {
				   $nr_type = pg_fetch_result($type, $i, 0);
				   $nom = pg_fetch_result($type, $i, 1);

				   
				   echo "<option value=\"$nom\" selected>$nom</option>\n";
				$i++;		  
						  }
	         ?>
			   </select></p>
		  <p><label>Lieu :</label><select name="lieu" >
			 <?php
			 $lieu =  pg_query ($dbconn, "SELECT * FROM loger ");
				   $num3 = pg_num_rows($lieu);
				   $i=0; 
				   while ($i < $num3) {
				   $nr_lieu = pg_fetch_result($lieu, $i, 0);
				   $nom1 = pg_fetch_result($lieu, $i, 1);

				   
				   echo "<option value=\"$nom1\" selected>$nom1</option>\n";
				$i++;
					}
			   ?>
			 </select></p>
			<p><label>Destination :</label><select name="client" >
			 <?php
			 $client =  pg_query ($dbconn, "SELECT * FROM clients ");
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
			 <p><label>Réservation :</label><select name="libre" >
				<option value="FALSE" selected="selected">NON</option>
				<option value="TRUE">OUI</option>
			 </select></p>
			<p><label>Travail :</label><select name="trav" >
			 <?php
			 $trav =  pg_query ($dbconn, "SELECT * FROM types WHERE nr_type > 99 ORDER BY nr_type  ");
				   $num2 = pg_num_rows($trav);
				   $i=0;
				   while ($i < $num2) {
				   $nr_type = pg_fetch_result($trav, $i, 0);
				   $nom = pg_fetch_result($trav, $i, 1);

				   
				   echo "<option value=\"$nom\" selected>$nom</option>\n";
				$i++;		  
			}
			   ?>
			 </select></p>
			<p><label>Temps passé :</label><input type="text" name="temps" size=20 ></p>
			<p><label>Comentaires :</label><input type="text" name="coment" size=(50,3) ></p>
			
		 <input class="register-button" type="submit" name="pot" value="Valider"><input class="register-button" type="reset">
		 </fieldset>
				 </form>
			</div> 
		 </div>
</html>
