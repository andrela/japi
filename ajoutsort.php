<html>
<body>
<div class="grid_4" >
<div class="box" >
<h2><a href="#" >Une nouvelle sorte est arrivée</a></h2>

<p><b><font color="#FF0000" >Les valeurs suivantes ont été ajoutées à la table des Sortes</font></b>
<div style="margin: 0px; overflow: hidden; position: static;">
<div style="margin: 0px;" class="block" id="tables">
<table>
<tbody><tr><th>Numéro de sortes</th>
<th>Nom</th>
<th>Catégorie</th>
<th>Famille</th>
<th>Un petit poème</th></tr>
<tr><td><?php echo $_POST["nrsortnew"];?></td>
<td><?php echo $_POST["nom"];?></td>
<td><?php echo $_POST["nr_cat"];?></td>
<td><?php echo $_POST["nr_fam"];?></td>
<td><?php echo $_POST["coment"];?></td></tr>
</tbody>
</table>
</p>
<?php
$conn_string = "host=localhost port=5432 dbname=bastide user=andre password=loboG69";
		$dbconn = pg_connect($conn_string);

		if (!$dbconn) {
		echo "An error occured.\n";
		exit;
		}
$nrsortnew = $_POST["nrsortnew"];
$nom = $_POST["nom"];
$nr_cat= $_POST["nr_cat"];
$nr_fam = $_POST["nr_fam"];
$coment = $_POST["coment"];
pg_query ($dbconn, "INSERT INTO sortes
                      VALUES (
					  '$nrsortnew', '$nom', '$nr_cat', '$nr_fam', '$coment')");
					  ?>
				 </div>
	  </body>
</html>
