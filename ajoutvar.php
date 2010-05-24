<html>
<body>
<div class="grid_4" >
<div class="box" >
<h2><a href="#">Une nouvelle variété est arrivée</a></h2>
<br>
<p><b><font color="#FF0000" >Les valeurs suivantes ont été ajoutées à la table des Variétés</font></b>
<div style="margin: 0px; overflow: hidden; position: static;">
<div style="margin: 0px;" class="block" id="tables">
<table>
<tbody><tr><th>Numéro de sortes</th>
<th>Nom</th>
<th>Sorte</th>
<th>Graine/gr</th>
<th>Couleur</th>
<th>Un petit poème</th></tr>
<td><?php echo $_POST["nrvarnew"];?></td>
<td><?php echo $_POST["nom"];?></td>
<td><?php echo $_POST["sorteg"];?></td>
<td><?php echo $_POST["graine_gr"];?></td>
<td><?php echo $_POST["couleur"];?></td>
<td><?php echo $_POST["coment"];?></td>
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
$nrvarnew = $_POST["nrvarnew"];
$nom = $_POST["nom"];
$sorteg = $_POST["sorteg"];
$graine_gr = $_POST["graine_gr"];
$couleur = $_POST["couleur"];
$coment = $_POST["coment"];
pg_query ($dbconn, "INSERT INTO varietes VALUES ('$nrvarnew', '$nom', '$sorteg', '$graine_gr', '$couleur', '$coment')");
?>
</div>
</body>
</html>
