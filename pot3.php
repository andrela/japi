<html>
<div class="grid_3">
<div class="box">
<h2><a href="#">SEMEZ ...ils s'aiment"</a></h2>
<?php 
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   $dateheure=strftime( "Aujourdhui,le %A %d %B %Y à %H:%M:%S");
   $date=strftime("%d/%m/%Y");
include('bastide.php');
// Test pour savoir si on sème dans le pot direct
if ( isset ($_GET["pot"])) {
// Test pour savoir si pot est à 0, on veut tous les pots en cours 
if ( $_GET["pot"] == 0) {
$pott = pg_query ($dbconn, "SELECT * from pots where fin is null");
				if (!$pott) {
              		echo "An error occured.\n";
              		exit;}
              		echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?semis=0#\" id=\"toggle-section-menu\">Les pots en cours:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
					while ($res2 = pg_fetch_row($pott)){
						  echo "<li> <a class=\"menuitem current\" href=?semis=$res2[3]&pot=$res2[0]>$res2[0]-$res2[1]-$res2[3]-$res2[5]-$res2[6]</a></li>" ;
	  	  				 	 			}
	  	  				echo "</ul></div></div></div>"; 	 			
					}
					else {					
$pot = 	$_GET["pot"];			
$pott = pg_query  ($dbconn, "SELECT * from pots where pot_nr = '$pot'");
	   			   	if (!$pott) {
              		echo "An error occured.\n";
              		exit;}
		$nr_pot = pg_fetch_result ($pott,$i,0);			
		$id_pot = pg_fetch_result ($pott,$i,1);
		$id_sem = pg_fetch_result ($pott,$i,2);
		$nom = pg_fetch_result ($pott,$i,5);
		$dat_crea = pg_fetch_result ($pott,$i,4);
		$num = pg_fetch_result ($pott,$i,6);
		$sold = pg_fetch_result ($pott,$i,12);
		
		$autre = pg_query ("SELECT * from pots where sem_id = '$id_sem' and fin is null ");
				 		while ($res = pg_fetch_row($autre)){
						echo "<li> <a href=?semis=$res[2]&pot=$res[0]>$res[0]-$res[1]-$res[4]</a> <br clear = \"all\">";
	  	  				 	 								}
		
		echo "<b> Les pots <font color=\"#FF0000\">$id_pot</font> de <font color=\"#f91616\">$nom!!</font><br>
 provienent du semis numéro <strong>$semis</strong>, il y en a $sold <br clear = \"all\">";
		
		}
		}
		else {
// Test pour savoir si semis est à 0, on veut tous les semis en cours			
if ( $semis == 0) {
$plaque = pg_query  ($dbconn, "SELECT * from plaques where fin is null");
	   			   	if (!$plaque) {
              		echo "An error occured.\n";
              		exit;}
              		echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?semis=0#\" id=\"toggle-section-menu\">Les plaques en cours:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">";
						while ($res1 = pg_fetch_row($plaque)){
						echo "<li> <a class=\"menuitem current\" href=http://localhost/bastide/plant.php?semis=$res1[0]>$res1[0]-$res1[1]-$res1[3]</a></li>" ;
	  	  				 	 			}
	  	  			echo "</ul></div></div></div>";
					}
					else {
$semis = $_GET["semis"];				
$plaque = pg_query  ($dbconn, "SELECT * from plaques where nr_plak = '$semis'");
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
		
		$autre = pg_query ("SELECT * from plaques where plak_id = '$id_pla' and fin is null ");
				 		while ($res = pg_fetch_row($autre)){
						echo "<li> <a href=?semis=$res[0]>$res[0]-$res[1]-$res[3]</a> <br clear = \"all\">";
	  	  				 	 			}
		
		echo "<b> La plaque de semis <font color=\"#e1451b\">$id_pla</font> de <font color=\"#f91616\">$nom!!</font><br>
contient le semis numéro <strong>$semis</strong> <br clear = \"all\">";
		}
	}
?>
</div>
<div id="forms" class="box" >
		
<form method="POST" ACTION="gest.php">
<fieldset>
    <input type="hidden" name="pot" value="<?php echo $nr_pot;?>">
	<input type="hidden" name="sem_id" value="<?php echo $id_sem;?>">
	<input type="hidden" name="semis" value="<?php echo $idplak;?>">
	<input type="hidden" name="sold" value="<?php echo $sold;?>">
    <input class="register-button" type="submit" name="poubelle" value="Je modifie !">
    </fieldset>
	</form>
	
	<form method="POST" ACTION="gest.php">
	<fieldset>
	<input type="hidden" name="plante" value="<?php echo $idplak;?>">
	<input type="hidden" name="pot" value="<?php echo $nr_pot;?>">
	<input type="hidden" name="semens" value="<?php echo $id_sem;?>">
	<input type="hidden" name="num" value="<?php echo $num;?>">
	<input type="hidden" name="sold" value="<?php echo $sold;?>">
    <input class="register-button" type="submit" name="plant" value="Je Plante!">
    </fieldset>
	</form>
</div>
</div>
<div class="grid_3">
<div class="box">
<p><b>Le sachet de <font color=\"#FF0000\"> <?php echo $_POST['nom'];?></font><br>
porte le numéro <strong><?php echo $_POST['semens'];?></strong><br>
Il y a actuelement <strong><font color=\"#FF0000\"><?php echo $_POST['sold'];?></font></strong> graines dans le sachet.<br></b></p>
<div id="forms" class="box">
<form method="POST" ACTION="gest.php">
<fieldset>
<?php
             $nrp = pg_query ($dbconn, "SELECT pot_nr FROM pots order by pot_nr desc");
			 $num = pg_num_rows($nrp);
			 $i = 0;
			 $r = pg_fetch_result($nrp, $i, 0);
			 $nr= ++$r;
		?>
		 <legend>&nbsp;Création de Pots&nbsp;:</legend>
		 <p><label>Numéro de pot :</label><input type="text" name="potnew" value="<?php echo $nr;?>" maxlength="8" size=20 ></p>
		 <p><label>Pots_id :</label><input type="text" name="pots_id" maxlength="4" size=20 ></p>
		 <p><label>Semences :</label><input type="text" name="semence" value="<?php echo $_POST['semens'];?>"size=20 ></p>
		 <p><label>Plaque source :</label><input type="text" name="nr_plak" value="<?php echo $semis;?>"size=20 ></p>
		 <p><label>Pots source :</label><input type="text" name="srcpot" value="<?php echo $nr_pot;?>"size=20 ></p>
		 <p><label>Pertes :</label><input type="text" name="perte" size=20 ></p>
		 <p><label>Date :</label><input type="text" name="date" value="<?php echo $date;?>"size=20></p>
		 <p><label>Nom :</label></li><input type="text" name="nom" value="<?php echo $_POST['nom'];?>" size=20></p>
		 <p><label>Nombre :</label><input type="text" name="nb" size=20 ></p>
		 <p><label>Type de pots:</label><SELECT name="type">
			<?php
			$type =  pg_query ("SELECT * FROM types ORDER BY nr_type ");
				   $num2 = pg_num_rows($type);
				   $i=0;
				   while ($i < $num2) {
				   $nr_type = pg_fetch_result($type, $i, 0);
				   $nom = pg_fetch_result($type, $i, 1);

				   
				   echo "<option value=\"$nom\" SELECTED>$nom</option>\n";
				$i++;		  
						  }
	         ?>
			   </SELECT></p>
			 <p><label>Parcelle :</label><SELECT name="parc">
			 <?php
			 $parc =  pg_query ("SELECT * FROM parcelles ");
				   $num3 = pg_num_rows($parc);
				   $i=0; 
				   while ($i < $num3) {
				   $nr_parc = pg_fetch_result($parc, $i, 0);
				   $nom1 = pg_fetch_result($parc, $i, 2);

				   
				   echo "<option value=\"$nr_parc\" SELECTed>$nr_parc-$nom1</option>\n";
				$i++;
					}
			   ?>
			 </SELECT></p>
			 <p><label>Destination :</label><SELECT name="client">
			 <?php
			 $client =  pg_query ("SELECT * FROM clients ");
				   $num5 = pg_num_rows($client);
				   $i=0;
				   while ($i < $num5) {
				   $nr_client = pg_fetch_result($client, $i, 0);
				   $nom3 = pg_fetch_result($client, $i, 1);

				   
				   echo "<option value=\"$nom3\" SELECTed>$nom3</option>\n";
				$i++;		  
						  }
			   ?>
			 </SELECT></p>
			 <p><label>Travail :</label><SELECT name="trav">
			 <?php
			 $trav =  pg_query ("SELECT * FROM types WHERE nr_type > 99 ORDER BY nr_type  ");
				   $num2 = pg_num_rows($trav);
				   $i=0;
				   while ($i < $num2) {
				   $nr_type = pg_fetch_result($trav, $i, 0);
				   $nom = pg_fetch_result($trav, $i, 1);

				   
				   echo "<option value=\"$nom\" SELECTed>$nom</option>\n";
				$i++;		  
			}
			   ?>
			 </SELECT></p>
			 <p><label>Temps passé :</label><input type="text" name="temps" size=20 ></p>
			 <p><label>Comentaires :</label><input type="text" name="coment" size=20></p>
			 
		 <input class="register-button" type="submit" value="Valider"><input class="register-button" type="reset">
		 </fieldset>
				 </form>
			 </div>
			 </div>
</html>
