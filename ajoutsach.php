<html>
<body>
<div class="grid_4" >
<div class="box" >
<h2><a href="#" >Un nouveau sachet est arriv�</a></h2>
<br>
<p><b><font color="#FF0000" >Les valeurs suivantes ont �t� ajout�es � la table des semences</font></b>
<?php
include('bastide.php');
if (!empty($_POST["fourg"])) {
					$fourg = $_POST["fourg"];
                   $result = pg_query ($dbconn, "SELECT nr_four 
				                       FROM fournisseurs
									   WHERE nom ='$fourg'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_result($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $nr_four = "$r[$j]";
				   }
	}
if (!empty($_POST["$lieu"])) {
					$lieu = $_POST["$lieu"];
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
if (!empty($_POST["$traitement"])) {
					$traitement = $_POST["$traitement"];
                   $result = pg_query ($dbconn, "SELECT nr_trait 
				                       FROM traitements
									   WHERE nom ='$traitement'");
		           $num = pg_num_rows($result);
				   for ($i=0; $i < $num; $i++) {
				   $r = pg_fetch_result($result, $i);

				   for ($j=0; $j < count ($r); $j++) 
				   if($i >= 0)
				   
				   $nr_trait = "$r[$j]";
				   }
	}
if (!empty($_POST["$client"])) {
				   $client = $_POST["$client"];
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
if (!empty($_POST["$prix"])) {
                    $prix_gr = ($prix / $nb_gr);
				   }
				   else {
					   $prix_gr = '0';
				   }

?>
<div style="margin: 0px; overflow: hidden; position: static;">
<div style="margin: 0px;" class="block" id="tables">
<table>
<tbody><tr><th>Num�ro du sachet</th>
<th>Num�ro de vari�t�</th>
<th>La date d'entr�e</th>
<th>Num�ro du fournisseur</th></tr>
<tr><td><?php echo $_POST["nrsanew"];?></td>
<td><?php echo $_POST["nr_var"];?></td>
<td><?php echo $_POST["date"];?></td>
<td><?php echo $_POST["fourg"];?>,<?php echo $_POST["nr_four"];?></td></tr>
<tr><th>Nombre de graines</th>
<th>Le solde de graines</th>
<th>La date de validit�</th>
<th>La r�f�rence du sachet</th></tr>
<tr><td><?php echo $_POST["nb_gr"];?></td>
<td><?php echo $_POST["solde"];?></td>
<td><?php echo $_POST["valide"];?></td>
<td><?php echo $_POST["ref_fab"];?></td>
</tr>
<tr>
<th>Le lieu de stockage</th>
<th>Le prix d'une graine</th>
<th>Les traitements ou non</th>
<th>Le propri�taire</th></tr>
<tr><td><?php echo $_POST["lieu"];?>,<?php echo $_POST["nr_lieu"];?></td>
<td><?php echo $prix_gr;?></td>
<td><?php echo $_POST["traitement"];?>,<?php echo $_POST["nr_trait"];?></td>
<td><?php echo $_POST["client"];?>,<?php echo $_POST["nr_client"];?></td></tr>
<tr><th>Un petit po�me</th></tr>
<tr><td><?php echo $_POST["coment"];?></td>
</tr>
</tbody>
</table>
</p>

<?php
$conn_string = "host=localhost port=5432 dbname=bastide user=andre password=loboG69";
		$dbconn = pg_pconnect($conn_string);

		if (!$dbconn) {
		echo "An error occured.\n";
		exit;
		}
$nrsanew = $_POST["nrsanew"];
$nr_var = $_POST["nr_var"];
$date = $_POST["date"];
$nr_four = $_POST["nr_four"];
$nr_lieu = $_POST["nr_lieu"];
$nb_gr = $_POST["nb_gr"];
$solde = $_POST["solde"];
$valide = $_POST["valide"];
$ref_fab = $_POST["ref_fab"];
$nr_trait = $_POST["nr_trait"];
$nr_client = $_POST["nr_client"];
$coment = $_POST["coment"];
pg_query ($dbconn, "INSERT INTO semences
                      VALUES (
					  '$nrsanew', '$nr_var', '$date', '$nr_four', '$nb_gr', '$solde',
					  '$valide', '$ref_fab', '$nr_lieu', '$prix_gr', '$nr_trait',
					  '$nr_client', '$coment')");
					  ?>
				 </div>
	  </body>
</html>
