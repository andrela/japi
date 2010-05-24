<html>
<div class="grid_4">
<?php 
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   setlocale (LC_ALL, 'fr_FR.UTF-8');
   $dateheure=strftime( "Aujourdhui,le %A %d %B %Y à %H:%M:%S");
   $date=strftime("%d/%m/%Y");

include('bastide.php');
if (!empty($_GET["vareg"])) {
			   $vareg = $_GET["vareg"];
			   $result2 = pg_query ($dbconn, "SELECT * FROM semences
			                        WHERE var ='$vareg' 
									AND solde >'0'" );
               $num2 = pg_num_rows($result2);
			   $i = 0;
               echo "<div class=\"box\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"#\" id=\"toggle-tables\">Semences</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"tables\">
						<table><tbody><tr><th>Graines disponibles</th>
							     <th>Stock</th>
								 <th>Validité</th>
								 <th>Référence</th>
							 </tr>";
				while ($i < $num2) {
				$nrsa = pg_fetch_result ($result2,$i,0);
				$sold = pg_fetch_result ($result2,$i,5);
				$valid = pg_fetch_result ($result2,$i,6);
				$refab = pg_fetch_result ($result2,$i,7);
				?>
					  <tr><td BGCOLOR=#E0FDAA><?php  echo $nrsa;?></td>
					  <td BGCOLOR=#E0FDAA><?php echo $sold;?>
					  <td BGCOLOR=#E0FDAA><?php echo $valid;?>
					  <td BGCOLOR=#E0FDAA><?php echo $refab;?>
					 </tr>
					 <?php
					 $i++;
				 }
		  echo "</tbody></TABLE>\n";
		 }
		?>        
		</div><br>
		<div id="forms" class="box" >
		<form method="POST" ACTION="gest.php?categ=<?php echo $_GET["categ"];?>&sorteg=<?php echo $_GET["sorteg"];?>&vareg=<?php echo $_GET["vareg"];?>">
		<fieldset>
		<?php
             $num_nrs = pg_query ($dbconn, "SELECT nr_sachet FROM semences order by nr_sachet desc");
			 $num = pg_num_rows($num_nrs);
			 $i = 0;
			 $r = pg_fetch_result($num_nrs, $i, 0);
			 $nr= ++$r;
		?>
		 <legend>&nbsp;AJOUTER un Sachet&nbsp;:</legend>
		 <p><label>nr_sachet :</label><input type="text" name="nrsanew" value="<?php echo $nr;?>" maxlength="8" size=20 ></p>
		 <p><label>Variété :</label><input type="text" name="nr_var" value="<?php echo $_GET["vareg"];?>" maxlength="3" size=20 ></p>
		 <p><label>date :</label><input type="text" name="date" value="<?php echo $date;?>"size=20 ></p>
		 <p><label>Fournisseur :</label><select name="fourg" >
			<?php
			$four =  pg_query ($dbconn, "SELECT * FROM fournisseurs ORDER BY nom ");
				   $num2 = pg_num_rows($four);
				   $i=0;
				   while ($i < $num2) {
				   $nr_four = pg_fetch_result($four, $i, 0);
				   $nom = pg_fetch_result($four, $i, 1);

				   
				   echo "<option value=\"$nom\" selected>$nom</option>\n";
				$i++;		  
						  }
			   ?>
			 </select></p>
			 <p><label>Nombre_gr :</label><input type="text" name="nb_gr" size=20 ></p>
			 <p><label>Solde_gr :</label><input type="text" name="solde" size=20 ></p>
			 <p><label>Validité :</label><input type="text" name="valide" size=20 ></p>
			 <p><label>Référence :</label></li><input type="text" name="ref_fab" size=20 ></p>
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
			 <p><label>Traitement :</label><select name="traitement" >
			 <?php
			 $trait =  pg_query ($dbconn, "SELECT * FROM traitements ");
				   $num4 = pg_num_rows($trait);
				   $i=0; 
				   while ($i < $num4) {
				   $nr_trait = pg_fetch_result($trait, $i, 0);
				   $nom2 = pg_fetch_result($trait, $i, 3);

				   
				   echo "<option value=\"$nom2\" selected>$nom2</option>\n";
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
			 <p><label>Prix du sachet :</label><input type="text" name="prix" size=20 ></p>
			 <p><label>Comentaires :</label><input type="text" name="coment" size=(20,3) ></p>
			 </p>
		 <br clear="all" ></br>
		     <input type="hidden" name="nr_var" value="<?php echo $vareg;?>" >
			 <input type="hidden" name="nr_four" value="<?php echo $nr_four;?>" >
			 <input type="hidden" name="nr_trait" value="<?php echo $nr_trait;?>" >
			 <input type="hidden" name="nr_lieu" value="<?php echo $nr_lieu;?>" >
			 <input type="hidden" name="nr_client" value="<?php echo $nr_client;?>" >
			 <INPUT class="register-button" type="submit" value="Valider"><INPUT class="register-button" type="reset">
		 </fieldset>
				 </form>
				 </div>
				 </div>
</html>
