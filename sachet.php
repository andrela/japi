<html>
<head>
<title>Semences au Choix</title>
</head>
<body>
<H2>SEMER, je sème, tu sèmes, il sème, nous semons, vous semez, ils s'aiment"</H2>
<table>
<tr><div align="center">
<?php 
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   $dateheure=strftime( "Aujourdhui,le %A %d %B %Y à %H:%M:%S");
   echo $dateheure;
   $date=strftime("%d/%m/%Y");

$conn_string = "host=localhost port=5432 dbname=bastide user=andre password=loboG69";
		$dbconn = pg_pconnect($conn_string);

		if (!$dbconn) {
		echo "An error occured.\n";
		exit;
		}
echo "<a href=http://debian/cultures/filtres/semences.php>Retour</a>";
?>
<div align="center">
<b> Le sachet de <font color=\"#FF0000\"> <?php echo $_POST["sorteg"];?></font><font color=\"#f91616\">  <?php echo $_POST["vareg"];?>!!</font><br>
porte le numéro <strong><?php echo $_POST["nr_sachet"];?></strong> et la référence <strong><?php echo $_POST["refab"];?></strong><br>
Il y a actuelement <strong><font color=\"#FF0000\"><?php echo $_POST["sold"];?></font></strong> graines dans le sachet.<br>
</div>
<div align = center >
<p><form method="POST" ACTION="pot.php">
    <tr>
	<td>	
    <input type="hidden" name="vareg" value="<?php echo $_POST["vareg"];?>">
	<input type="hidden" name="sorteg" value="<?php echo $_POST["sorteg"];?>">
	<input type="hidden" name="nr_sachet" value="<?php echo $_POST["nr_sachet"];?>">
	<input type="hidden" name="sold" value="<?php echo $_POST["sold"];?>">
    <input type="hidden" name="refab" value="<?php echo $_POST["refab"];?>">
    <input type="submit" name="pot" value="Je Sème dans des pots!">
	</form>
	</td>
	<td>
	<form method="POST" ACTION="planche.php"
	<input type="hidden" name="vareg" value="<?php echo $_POST["vareg"];?>">
    <input type="hidden" name="sorteg" value="<?php echo $_POST["sorteg"];?>">
	<input type="hidden" name="nr_sachet" value="<?php echo $_POST["nr_sachet"];?>">
	<input type="hidden" name="sold" value="<?php echo $_POST["sold"];?>">
    <input type="hidden" name="refab" value="<?php echo $_POST["refab"];?>">
    <input type="submit" name="pla" value="Je Sème dans les champs!">
	</form>
	</td>
	</tr>
	</p>
		<p><form method="POST" ACTION="plak.php">
		
		<?php
             $num_nrp = pg_query ($dbconn, "SELECT nr_plak FROM plaques order by nr_plak desc");
			 $num = pg_num_rows($num_nrp);
			 $i = 0;
			 $r = pg_fetch_result($num_nrp, $i, 0);
			 $nr= ++$r;
			 
			 $vareg = $_POST["vareg"];
			 $sorteg = $_POST["sorteg"];
			 $nr_sachet = $_POST["nr_sachet"];
		?>
		 <font face="Comic Sans MS"><b>&nbsp;Choisir une plaque avant l'action&nbsp;:</b></font></p>
		 <p><table border="0">
		 <tr>
			<td>
			<li><label>nr_plak :</label></li></td>
			<td align = center><input type="text" name="nrplaknew" value="<?php echo $nr;?>" maxlength="8" size=20 >
		 </tr>
		 <tr>
			<td>
			<li><label>Plak_id :</label></li></td>
			<td align = center><input type="text" name="plak_id" maxlength="4" size=20 >
			<td>
		 </tr>
		 <tr>	
		    <td>
			<li><label>Semences :</label></li></td>
			<td align = center><input type="text" name="sem_id" value="<?php echo $nr_sachet;?>"size=20 >
			</td>
		 </tr>
		 <tr>	 
			 <td>
			 <li><label>Nom :</label></li><td>
			 <td><input type="text" name="nom" value="<?php echo $sorteg, $vareg;?>" size=40 >
			 </td>
		 </tr>
		 <tr>	
		    <td>
			<li><label>Date :</label></li></td>
			<td align = center><input type="text" name="date" value="<?php echo $date;?>"size=20 >
			</td>
		 </tr>
		 <tr>	 
			 <td>
			 <li><label>Nombre_gr :</label></li><td>
			 <td><input type="text" name="nb_gr" size=20 >
			 </td>
		 </tr>
		 <tr>	
			<td>
			<li><label>Type de plak:</label></li></td>
			<td align = center><select name="type" size="3">
			<?php
			$type =  pg_query ($dbconn, "SELECT * FROM types ORDER BY nr_type ");
				   $num2 = pg_num_rows($type);
				   $i=0;
				   while ($i < $num2) {
				   $nr_type = pg_fetch_result($type, $i, 0);
				   $nom = pg_fetch_result($type, $i, 1);

				   
				   echo "<option value=\"$nom\" selected>$nom</option>\n";
				$i++;		  
						  }
	         ?>
			   </select>
			 </td>
		 </tr>
			 <tr>	 
			 <td>
			 <li><label>Graines / trou :</label></li><td>
			 <td><input type="text" name="gr_trou" size=20 >
			 </td>
		 </tr>
			 <tr>	 
			 <td>
			 <li><label>Profondeur :</label></li><td>
			 <td><input type="text" name="prof" size=20 >
			 </td>
		 </tr>
			 <tr>	  
			 <td>
			 <li><label>Lieu :</label></li><td>
			 <td><select name="lieu" size="3">
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
			 </select>
			 </td>
		 </tr>
			 <tr>
			 <td>
			 <li>
			 <label>Destination :</label></li><td>
			 <td><select name="client" size="3">
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
			 </select>
			 </td>
		 </tr>
		 <tr>
			 <td>
			 <li>
			 <label>Travail :</label></li><td>
			 <td><select name="trav" size="3">
			 <?php
			 $travail =  pg_query ($dbconn, "SELECT * FROM travaux ");
				   $num5 = pg_num_rows($travail);
				   $i=0;
				   while ($i < $num5) {
				   $nr_trav = pg_fetch_result($travail, $i, 0);
				   $nom3 = pg_fetch_result($travail, $i, 2);

				   
				   echo "<option value=\"$nom3\" selected>$nom3</option>\n";
				$i++;		  
						  }
			   ?>
			 </select>
			 </td>
		 </tr>
		 <tr>	 
			 <td>
			 <li><label>Temps passé :</label></li><td>
			 <td><input type="text" name="temps" size=20 >
			 </td>
		 </tr>
		 <tr>
			 <td>
			 <li><label>Comentaires :</label></li><td>
			 <td><input type="text" name="coment" size=(50,3) >
			 </td>
		 </tr>
		 </p>
		 <p>
		 <TFOOT>
		 <tr>
		 <td align = center>
		 <INPUT type="submit" value="Valider"><INPUT type="reset">
		 </td>	
		 </tr>
		 </TFOOT>
				 </form>
			 </p>
		 </div>
	</body>
</html>
