<html>
<body>
<div class="grid_4" >
<div class="box" >
<h2><a href="#" >Une nouvelle famille est arrivée</a></h2>

<p><b><font color="#FF0000" >Les valeurs suivantes ont été ajoutées à la table des Familles</font></b>
<div style="margin: 0px; overflow: hidden; position: static;">
<div style="margin: 0px;" class="block" id="tables">
<table>
<tbody><tr><th>Numéro de catégories</th>
			<th>Nom</th>
			<th>Nom Latin</th>
			<th>Origine</th></tr>
			<tr><td><?php echo $_POST["nr_famnew"];?></td>
			<td><?php echo $_POST["nom"];?></td>
			<td><?php echo $_POST["latin"];?></td>
			<td><?php echo $_POST["orig"];?></td></tr>
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
$nr_famnew = $_POST["nr_famnew"];
$nom = $_POST["nom"];
$latin = $_POST["latin"];
$orig = $_POST["orig"];
pg_query ($dbconn, "INSERT INTO familles
                      VALUES (
					  '$nr_famnew', '$nom', '$latin', '$orig')");
					  ?>
				 </div>
	  </body>
</html>
