<html>
<body>
<div class="grid_4" >
<div class="box" >
<h2><a href="#" >Une nouvelle catégorie est crée</a></h2>

<p><b><font color="#FF0000" >Les valeurs suivantes ont été ajoutées à la table des Catégories</font></b>
<div style="margin: 0px; overflow: hidden; position: static;">
<div style="margin: 0px;" class="block" id="tables">
						<table><tbody><tr><th>Numéro de sortes</th>
							     <th>Nom</th>
								 <th>Un petit poème</th>
								 <tr><td><?php echo $_POST["nrcatnew"];?></td>
								 <td><?php echo $_POST["nom"];?></td>
								 <td><?php echo $_POST["coment"];?></td>
							</tr>
							</tbody>
							</table>
</p>
</div>
<?php
include('bastide.php');
$nrcatnew = $_POST["nrcatnew"];
$nom = $_POST["nom"];
$coment = $_POST["coment"];
pg_query ($dbconn, "INSERT INTO categories VALUES ('$nrcatnew', '$nom', '$coment')");
?>
</body>
</html>
