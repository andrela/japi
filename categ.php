<html>
<body>
<div class="grid_4">
   <div id="forms" class="box" >
		<form method="POST" ACTION="gest.php">
		<fieldset>
		<?php
		$conn_string = "host=localhost port=5432 dbname=bastide user=andre password=loboG69";
		$dbconn = pg_pconnect($conn_string);

		if (!$dbconn) {
		echo "An error occured.\n";
		exit;
		}
             $num_nrs = pg_query ($dbconn, "SELECT nr_cat FROM categories order by nr_cat desc");
			 $num = pg_num_rows($num_nrs);
			 $i = 0;
			 $r = pg_fetch_result($num_nrs, $i, 0);
			 $nr= ++$r;
		?>
		 <legend>&nbsp;AJOUTER une Catégorie&nbsp;:</legend>
		 <p>
		 <label>nr_cat :</label>
			<input type="text" name="nrcatnew" value="<?php echo $nr;?>" maxlength="8" size=20 ></p>
		 	<p>
		 	<label>Nom :</label>
			<input type="text" name="nom"  size=20 ></p>
			<p>
			<label>Comentaires :</label>
			<input type="text" name="coment" size=(20,3) ></p>
		 
		    <INPUT class="register-button" type="submit" value="Valider"><INPUT class="register-button" type="reset">
		    
		    </fieldset>
		 </form>
				 </div>
				 </div>
		 </body>
</html>
