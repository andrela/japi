<html>
<div class="grid_4">
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
?>
<div class="box">
<b> Le sachet de <font color=\"#e1451b\"> <?php echo trim($sort);?></font><font color=\"#f91616\">  <?php echo trim($vare);?>!!</font><br>
porte le numéro <strong><?php echo $semence;?></strong> et la référence <strong><?php echo $refab;?></strong><br>
Il y a actuelement <strong><font color=\"#e1451b\"><?php echo $sold;?></font></strong> graines dans le sachet.<br></b>
<div id="forms" class="box">
<form method="POST" ACTION="plant.php">
<fieldset>
	<input type="hidden" name="vare" value="<?php echo $vareg;?>">
	<input type="hidden" name="sort" value="<?php echo $sorteg;?>">
	<input type="hidden" name="semens" value="<?php echo $semence;?>">
	<input type="hidden" name="nom" value="<?php echo trim($sort);?> <?php echo trim($vare);?>">
	<input type="hidden" name="sold" value="<?php echo $sold;?>">
    <input type="hidden" name="refab" value="<?php echo $refab;?>">
    <input class="register-button" type="submit" name="pot" value="Je Sème dans des pots!">
    </fieldset>
</form>
	
<form method="POST" ACTION="plant.php">
<fieldset>
   <input type="hidden" name="vare" value="<?php echo $vare;?>">
   <input type="hidden" name="sort" value="<?php echo $sort;?>">
   <input type="hidden" name="semens" value="<?php echo $semence;?>">
   <input type="hidden" name="nom" value="<?php echo trim($sort);?> <?php echo trim($vare);?>">
   <input type="hidden" name="sold" value="<?php echo $sold;?>">
   <input type="hidden" name="refab" value="<?php echo $refab;?>">
   <input type="hidden" name="semis" value= '0'>
   <input class="register-button" type="submit" name="plad" value="Je Sème dans les champs!">
   </fieldset>
</form>

<form method="POST" ACTION="plant.php">
<fieldset>
		<?php
          $num_nrp = pg_query ("SELECT nr_plak FROM plaques order by nr_plak desc");
			 $num = pg_num_rows($num_nrp);
			 $i = 0;
			 $r = pg_fetch_result($num_nrp, $i, 0);
			 $nr= ++$r;
		?>
		 <legend>&nbsp;Choisir une plaque avant l'action&nbsp;:</legend>
		 <p><label>nr_plak :</label><input type="text" name="plak" value="<?php echo $nr;?>" maxlength="8" size=20 ></p>
		 <p><label>Plak_id :</label><input type="text" name="plak_id" maxlength="4" size=20 ></p>
		 <p><label>Semences :</label><input type="text" name="sem_id" value="<?php echo $semence;?>"size=20 ></p>
		 <p><label>Nom :</label><input type="text" name="nom" value="<?php echo trim($sort);?> <?php echo trim($vare);?>" size=20 ></p>
		 <p><label>Date :</label><input type="text" name="date" value="<?php echo $date;?>"size=20 ></p>
		 <p><label>Nombre_gr :</label><input type="text" name="nb_gr" size=20 ></p>
		 <p><label>Type de plak:</label><select name="type">
			<?php
			$type =  pg_query ("SELECT * FROM types WHERE nr_type BETWEEN 30 AND 99 ORDER BY nr_type  ");
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
		 <p><label>Graines / trou :</label><input type="text" name="gr_trou" size=20 ></p>
		 <p><label>Profondeur :</label><input type="text" name="prof" size=20 ></p>
		 <p><label>Lieu :</label><select name="lieu">
			 <?php
			 $lieu =  pg_query ("SELECT * FROM loger ");
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
		 <p><label>Destination :</label><select name="client">
			 <?php
			 $client =  pg_query ("SELECT * FROM clients ");
				   $num5 = pg_numrows($client);
				   $i=0;
				   while ($i < $num5) {
				   $nr_client = pg_result($client, $i, 0);
				   $nom3 = pg_result($client, $i, 1);

				   
				   echo "<option value=\"$nom3\" selected>$nom3</option>\n";
				$i++;		  
						  }
			   ?>
			 </select></p>
		 <p><label>Travail :</label><select name="trav">
			 <?php
			 $travail =  pg_query ("SELECT * FROM travaux ");
				   $num5 = pg_num_rows($travail);
				   $i=0;
				   while ($i < $num5) {
				   $nr_trav = pg_fetch_result($travail, $i, 0);
				   $nom3 = pg_fetch_result($travail, $i, 2);

				   
				   echo "<option value=\"$nom3\" selected>$nom3</option>\n";
				$i++;		  
						  }
			   ?>
			 </select></p>
		 <p><label>Temps passé :</label><input type="text" name="temps" size=20 ></p>
		 <p><label>Comentaires :</label><input type="text" name="coment" maxlength="30"></p>
		
		 <INPUT class="register-button" type="submit" name="pot" value="Valider"><INPUT class="register-button" type="reset">
		 </fieldset>
				 </form>
		</div>
		</div>
		</div>	 
</html>
