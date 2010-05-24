<html>
<body>
<?php
if (!empty($_POST["potnew"])) {
					$semer = $_POST["nr_plak"];
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
						
					echo "</div></div>";
				}
?>
<div class="grid_4" >
<div class="box" >
<h2><a href="#">Les Nouveaux pots arrivés</a></h2>
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
if (!empty($_POST["type"])) {
					$type = $_POST["type"];
                   $result = pg_query ($dbconn, "SELECT nr_type 
				                       FROM types
									   WHERE nom ='$type'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_row($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $nr_type = "$r[$j]";
				   }
	}
if (!empty($_POST["parc"])) {
					$parc = $_POST["parc"];
                   $result = pg_query ($dbconn, "SELECT * 
				                       FROM parcelles
									   WHERE nr_parc ='$parc'");
		           $rlieu = pg_fetch_row($result);				   
				   $nr_lieu = "$rlieu[0]";
				   }
				   else {
				   $nr_lieu = '0';
				   }
if (!empty($_POST["client"])) {
					$client = $_POST["client"];
                   $result = pg_query ($dbconn, "SELECT nr_client 
				                       FROM clients
									   WHERE nom ='$client'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_row($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $nr_client = "$r[$j]";
				   }
	}
if (!empty($_POST["trav"])) {
					$trav = $_POST["trav"];
                   $result = pg_query ($dbconn, "SELECT nr_type FROM types WHERE nom ='$trav'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_row($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $trav_id = "$r[$j]";
				   }
	       $num_nrtrav = pg_query ("SELECT nr_trav FROM travaux order by nr_trav desc");
			 $num = pg_num_rows($num_nrtrav);
			 $i = 0;
			 $r = pg_fetch_result($num_nrtrav, $i, 0);
			 $nr_trav= ++$r;
	}
	else {
	$nr_trav = '0';
}
?>
<br>
<p><b><font color="#FF0000" >Les valeurs suivantes ont été ajoutées à la table des pots</font></b>
<div style="margin: 0px; overflow: hidden; position: static;">
<div style="margin: 0px;" class="block" id="tables">
<table>
<tbody><tr><th>Numéro de pots</th>
<th>Id de pots</th>
<th>Numéro du sachet</th>
<th>Plaque source</th>
</tr>
<tr>
<td><?php echo $_POST["potnew"];?></td>
<td><?php echo $_POST["pots_id"];?></td>
<td><?php echo $_POST["semence"];?></td>
<td><?php echo $_POST["nr_plak"];?></td>
</tr>
<tr>
<th>Pots source</th>
<th>Nom</th>
<th>La date d'entrée</th>
<th>Nombre de pots</th>
</tr>
<tr>
<td><?php echo $_POST["srcpot"];?></td>
<td><?php echo $_POST["nom"];?></td>
<td><?php echo $_POST["date"];?></td>
<td><?php echo $_POST["nb"];?></td>
</tr>
<tr>
<th>Le type de pot</th></li>
<th>Le lieu</th></li>
<th>Le propriétaire</th></li>
<th>Réservation</th></li>
</tr>
<tr>
<td><?php echo $nr_type;?></td>
<td><?php echo $nr_lieu;?></td>
<td><?php echo $_POST["client"];?>,<?php echo $nr_client;?></td>
<td><?php echo $_POST["libre"];?></td>
</tr>
<tr>
<th>Le travail</th>
<th>Un petit poème</th>
</tr>
<tr>
<td><?php echo $nr_trav;?>,<?php echo $_POST["temps"];?></td>
<td><?php echo $_POST["coment"];?></td>
</tr>
</tbody>
</table>
</p>
<?php
if (($_POST["srcpot"]) > 0) {
	$idpot = ($_POST["srcpot"]);
	$sold = pg_query ($dbconn, "SELECT solde FROM pots WHERE pot_nr = '$idpot'");
	$i = 0;
	$r = pg_fetch_result($sold, $i, 0);
	$nb = $_POST["nb"];
	pg_query ($dbconn, "UPDATE pots SET solde = solde - '$nb' WHERE pot_nr = '$idpot'");
	if ( $nb > $r ) {
		pg_query ($dbconn, "UPDATE pots SET fin = '$date' WHERE pot_nr = '$idpot'");
	}
}
if (($_POST["nr_plak"]) > 0) {
$nr_plak = $_POST["nr_plak"];
$semence = $_POST["semence"];					  
pg_query ($dbconn, "UPDATE plaques SET fin = '$date' WHERE nr_plak = '$nr_plak'");
}
else {
$noplak = 0 ;
$semence = $_POST["semence"];
$nb = $_POST["nb"];
pg_query ($dbconn, "UPDATE semences SET solde = solde - '$nb' WHERE nr_sachet = '$semence'");                  
				   }
			   
if ($nr_trav > 0) {
$temps = $_POST["temps"];
pg_query ($dbconn, "INSERT INTO travaux
                      VALUES (
					  '$nr_trav', '$trav_id', '$trav', '$date', '$temps minute', '$nr_client')");
				   }
$nr_plak = $_POST["nr_plak"];
$semence = $_POST["semence"];
$potnew = $_POST["potnew"];
$pots_id = $_POST["pots_id"];
$nom = $_POST["nom"];
$nb = $_POST["nb"];
$coment = $_POST["coment"];
$libre = $_POST["libre"];
if (isset ($noplak)) {
	pg_query ($dbconn, "INSERT INTO pots ( pot_nr, pot_id, sem_id, creation, nom, nbr, type,
                                lieu, destin, t1, solde, coment, libre ) VALUES ( '$potnew', '$pots_id', '$semence', '$date','$nom', '$nb',
					  '$nr_type', '$nr_lieu', '$nr_client', '$nr_trav', '$nb', '$coment', '$libre' )");
	}
	else {
if (!isset ($_POST["srcpot"])) {
	pg_query ($dbconn, "INSERT INTO pots ( pot_nr, pot_id, sem_id, plak_nr, creation, nom, nbr, type,
                                lieu, destin, t1, solde, coment, libre ) VALUES ( '$potnew', '$pots_id', '$semence', '$nr_plak', '$date','$nom', '$nb',
					  '$nr_type', '$nr_lieu', '$nr_client', '$nr_trav', '$nb', '$coment', '$libre' )");
	}
	else
	{
$srcpot = $_POST["srcpot"];

pg_query ($dbconn, "INSERT INTO pots ( pot_nr, pot_id, sem_id, plak_nr, creation, nom, nbr, type,
                                lieu, destin, t1, solde, coment, src_pot, libre ) VALUES ( '$potnew', '$pots_id', '$semence', '$nr_plak', '$date','$nom', '$nb',
					  '$nr_type', '$nr_lieu', '$nr_client', '$nr_trav', '$nb', '$coment', '$srcpot', '$libre' )");
}
}					  
//TODO pg_query ("UPDATE parcelles SET libre = '$date' WHERE nr_parc = '$nr_lieu'");

?>
				 </div>
	  </body>
</html>
