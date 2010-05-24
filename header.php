<html>
<body>
<?php
if (!empty($_GET["semence"])) {
echo '<ul class="nav main">
		  <li><a href="plant.php?semis=0" >Semis</a></li>
		  <li><a href="plant.php?pot=0" >Pots</a></li>
		  <li><a href="plant.php?plan=0" >Planches</a></li>
	</ul>';
}
else
{
	echo '<ul class="nav main">
		  <li><a href="gest.php?semis=0" >Semis</a></li>
		  <li><a href="gest.php?pot=0" >Pots</a></li>
		  <li><a href="gest.php?plan=0" >Planches</a></li>
	</ul><br>';
}
?>
<?php
include('bastide.php');
#$categ,$sorteg,$vareg,$semence,$sachet;
// Premier tri ordonné du semis à la planche si un semis est sélectionné

if (!empty($_GET["categ"])) {
					$categ = $_GET["categ"];
				    $cat = pg_query ($dbconn, "SELECT nom FROM categories where nr_cat = '$categ'");
              	    if (!$cat) {
              	    echo "An error 1 occured.\n";
              	    exit;}
				    $rcat = pg_fetch_row($cat);
				    echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?categ=0#\" id=\"toggle-section-menu\">Catégories:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">
							<li>
								<a class=\"menuitem current\" href=?categ=$categ>$rcat[0]</a></li></ul></div></div></div>";
				    $sort = pg_query ($dbconn, "SELECT nr_sorte,nom FROM sortes WHERE cat = '$categ' order by nom");
				    if (!$sort) {
              			echo "An error occured.\n";
              			exit;}
     			
//// Tri des sortes
				   if (!empty($_GET["sorteg"])) {
				   $sorteg = $_GET["sorteg"];
				   $sorte = pg_query ($dbconn, "SELECT nom FROM sortes WHERE nr_sorte = '$sorteg' AND cat = '$categ'");
				   if (!$sorte) {
              	   echo "An error 2 occured.\n";
              	   exit;}
				   $rsorte = pg_fetch_row($sorte);
				   $sort = "$rsorte[0]";
				   echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?sorteg=0#\" id=\"toggle-section-menu\">Sortes:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">
							<li>
								<a class=\"menuitem current\" href=?categ=$categ&sorteg=$sorteg>$rsorte[0]</a></li></ul></div></div></div>";
				   $var = pg_query ($dbconn, "SELECT nr_var,nom FROM varietes WHERE sorte = '$sorteg' order by nom");
	   			   if (!$var) {
              			echo "An error occured.\n";
              			exit;}
////// Tri des variétés	
						if (!empty($_GET["vareg"])) {
						$vareg = $_GET["vareg"];
				   		$vari = pg_query ($dbconn, "SELECT nom FROM varietes WHERE nr_var = '$vareg' AND sorte = '$sorteg'");
				   		if (!$vari) {
              	   		echo "An error occured.\n";
              	   		exit;}
				   		$rvar = pg_fetch_row($vari);
						$vare = "$rvar[0]";
				   		echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?vareg=0#\" id=\"toggle-section-menu\">Variétés:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">
							<li>
								<a class=\"menuitem current\" href=?categ=$categ&sorteg=$sorteg&vareg=$vareg>$rvar[0]</a></li></ul></div></div></div>";
				   		$sem = pg_query ($dbconn, "SELECT nr_sachet FROM semences WHERE var = '$vareg' AND solde > '0'");
	   			   		if (!$sem) {
              					echo "An error occured.\n";
              					exit;}
//////// Tri des semences		
								if (!empty($_GET["semence"])) {
								$semence = $_GET["semence"];
				   				$seme = pg_query ($dbconn, "SELECT * FROM semences WHERE nr_sachet = '$semence'");
				   				if (!$seme) {
              	   				echo "An error occured.\n";
              	   				exit;}
								$sold = pg_fetch_result ($seme,$i,5);
								$refab = pg_fetch_result ($seme,$i,7);
				   				$rsem = pg_fetch_row($seme);
				   				echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?semence=0#\" id=\"toggle-section-menu\">Semences:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">
							<li>
								<a class=\"menuitem current\" href=?categ=$categ&sorteg=$sorteg&vareg=$vareg&semence=$semence>$semence</a></li></ul></div></div></div>";
				   				$plakes = pg_query ($dbconn, "SELECT * from plaques where fin is null order by creation desc");
	   			   				if (!$plakes) {
              					echo "An error occured.\n";
              					exit;}
								
////////// Tri des plaques
										if (!empty($_GET["plak"])) {
										$plak = $_GET["plak"];
				   						$plaq = pg_query ($dbconn, "SELECT * FROM plaques WHERE nr_plak = '$plak'");
				   						if (!$plaq) {
              	   						echo "An error occured.\n";
              	   						exit;}
										$rplak = pg_fetch_row($plaq);
				   						echo "<div id=\"grid\" class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?semis=0#\" id=\"toggle-section-menu\">Semis:</a>
					</h2>
					<div style=\"margin: 0px; overflow: hidden; position: static;\"><div style=\"margin: 0px;\" class=\"block\" id=\"section-menu\">
						<ul class=\"section menu\">
							<li>
								<a class=\"menuitem current\" href=?categ=$categ&sorteg=$sorteg&vareg=$vareg&semence=$semence&semis=$plak>$plak</a></li></ul></div></div></div>";
				   						$plaks = pg_query ($dbconn, "SELECT * from plaques where fin is null order by creation desc");
	   			   						if (!$plaks) {
              							echo "An error occured.\n";
              							exit;}

											}
										}
											else {
	                      					while ($r3 = pg_fetch_row($sem)){
											echo "<li> <a href=?categ=$categ&sorteg=$sorteg&vareg=$vareg&semence=$r3[0]>$r3[0]</a>" ;
	  	  							 			 }
			 								}
										}
									
	   								else {
	                      			while ($r2 = pg_fetch_row($var)){
									echo "<li> <a href=?categ=$categ&sorteg=$sorteg&vareg=$r2[0]>$r2[1]</a>" ;
	  	  							 	 }
			 						}
								}
								else {
	                      		while ($r1 = pg_fetch_row($sort)){
								echo "<li> <a href=?categ=$categ&sorteg=$r1[0]>$r1[1]</a>" ;
	  	  							 }
			 					}
						}
						else {
						echo "<div class=\"box menu\">
					<h2>
						<a style=\"cursor: pointer;\" href=\"?categ=0#\" id=\"toggle-section-menu\">Catégories:</a>
					</h2></div>";
	          			$result = pg_query ($dbconn, "SELECT nr_cat,nom FROM categories order by nom");
              			if (!$result) {
              			echo "An error occured.\n";
              			exit;}
     					 

						while ($r = pg_fetch_row($result)){
						echo "<li> <a href=?categ=$r[0]>$r[1]</a></li>" ;
	  	  				}
		}
?>
<br clear="all">
</body>
</html>
