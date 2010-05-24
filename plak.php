<html>
<body>
<?php
// TODO 
// Ajouter les options pour semer en plein champ et renseigner la table planches
// TODO
if (!empty($_POST["type"])) {
                   $result = pg_query ($dbconn, "SELECT nr_type 
				                       FROM types
									   WHERE nom ='$type'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_result($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $nr_type = "$r[$j]";
				   }
	}
if (!empty($_POST["lieu"])) {
                   $result = pg_query ($dbconn, "SELECT nr_lieu 
				                       FROM loger
									   WHERE nom ='$lieu'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_result($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $nr_lieu = "$r[$j]";
				   }
	}
if (!empty($_POST["client"])) {
                   $result = pg_query ($dbconn, "SELECT nr_client 
				                       FROM clients
									   WHERE nom ='$client'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_result($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $nr_client = "$r[$j]";
				   }
	}
if (!empty($_POST["trav"])) {
                   $result = pg_query ($dbconn, "SELECT trav_id FROM travaux WHERE nom ='$trav'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_result($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $trav_id = "$r[$j]";
				   }
	$num_nrtrav = pg_query ($dbconn, "SELECT nr_trav FROM travaux order by nr_trav desc");
			 $num = pg_num_rows($num_nrtrav);
			 $i = 0;
			 $r = pg_fetch_result($num_nrtrav, $i, 0);
			 $nr_trav= ++$r;
	}
?>
<div class="grid_4">
<div class="box" >
<h2><a href="#" >Un nouveau semis est éffectué</a></h2>
<br>
<p><b><font color="#FF0000" >Les valeurs suivantes ont été ajoutées à la table des plaques</font></b>
<div style="margin: 0px; overflow: hidden; position: static;">
<div style="margin: 0px;" class="block" id="tables">
<table>
<tbody><tr>
<th>Numéro de plaque</th>
<th>Id de plaque</th>
<th>Numéro du sachet</th>
<th>Nom</th>
</tr>
<tr>
<td><?php echo $_POST["plak"];?></td>
<td><?php echo $_POST["plak_id"];?></td>
<td><?php echo $_POST["sem_id"];?></td>
<td><?php echo $_POST["nom"];?></td>
</tr>
<tr>
<th>La date d'entrée</th>
<th>Nombre de graines</th>
<th>Le type de plaque</th>
<th>Le nbre de graines/trou</th>
</tr>
<tr>
<td><?php echo $_POST["date"];?></td>
<td><?php echo $_POST["nb_gr"];?></td>
<td><?php echo $_POST["nr_type"];?></td>
<td><?php echo $_POST["gr_trou"];?></td>
</tr>
<tr>
<th>La profondeur</th>
<th>Le lieu</th>
<th>Le propriétaire</th>
<th>Le travail</th></tr>
<tr>
<td><?php echo $_POST["prof"];?></td>
<td><?php echo $_POST["nr_lieu"];?></td>
<td><?php echo $_POST["client"];?>,<?php echo $nr_client;?></td>
<td><?php echo $nr_trav;?>,<?php echo $_POST["temps"];?></td>
</tr>
<tr>
<th>Un petit poème</th></tr>
<td><?php echo $_POST["coment"];?></td>
</tr>
</tbody>
</table>
</p>
<?php
$trav = $_POST["trav"];
$temps = $_POST["temps"];
$plak = $_POST["plak"];
$plak_id = $_POST["plak_id"];
$sem_id = $_POST["sem_id"];
$nom = $_POST["nom"];
$nb_gr = $_POST["nb_gr"];
$gr_trou = $_POST["gr_trou"];
$coment = $_POST["coment"];
pg_query ($dbconn, "INSERT INTO travaux
                      VALUES (
					  '$nr_trav', '$trav_id', '$trav', '$date', '$temps minute', '$nr_client')");

pg_query ($dbconn, "INSERT INTO plaques (nr_plak, plak_id, sem_id, nom, creation, nbr, type, gr_trou, profond,
                                lieu, destin, t1, coment)
                      VALUES (
					  '$plak', '$plak_id', '$sem_id', '$nom', '$date', '$nb_gr',
					  '$nr_type', '$gr_trou', '$prof', '$nr_lieu', '$nr_client',
					  '$nr_trav', '$coment')");
					  
pg_query ($dbconn, "UPDATE semences SET solde = solde - '$nb_gr' WHERE nr_sachet = '$sem_id'");

?>
				 </div>
	  </body>
</html>
