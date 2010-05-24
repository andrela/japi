<?php require_once('connexion.php'); ?>
<?php
/*
-----------------------------------
------ SCRIPT DE PROTECTION -------
          DBProtect V1.2
-----------------------------------
*/

session_start(); // début de session

if (isset($_POST['login'])){ // execution uniquement apres envoi du formulaire (test si la variable POST existe)
	$login = addslashes($_POST['login']); // mise en variable du nom d'utilisateur
	$pass = addslashes(md5($_POST['pass'])); // mise en variable du mot de passe chiffré à l'aide de md5 (I love md5)
	
// requete sur la table administrateurs (on récupère les infos de la personne)
mysql_select_db($database_dbprotect, $dbprotect);
$verif_query=sprintf("SELECT * FROM utilisateurs WHERE login='$login' AND pass='$pass'"); // requête sur la base administrateurs
$verif = mysql_query($verif_query, $dbprotect) or die(mysql_error());
$row_verif = mysql_fetch_assoc($verif);
$utilisateur = mysql_num_rows($verif);

	
	if ($utilisateur) {	// On test s'il y a un utilisateur correspondant
	
	    session_register("authentification"); // enregistrement de la session
		
		// déclaration des variables de session
		$_SESSION['privilege'] = $row_verif['privilege']; // le privilège de l'utilisateur (permet de définir des niveaux d'utilisateur)
		$_SESSION['nom'] = $row_verif['nom']; // Son nom
		$_SESSION['prenom'] = $row_verif['prenom']; // Son Prénom
		$_SESSION['login'] = $row_verif['login']; // Son Login
		$_SESSION['pass'] = $row_verif['pass']; // Son mot de passe (à éviter)
		
		header("Location:accueil.php"); // redirection si OK
	}
	else {
		header("Location:index.php?erreur=login"); // redirection si utilisateur non reconnu
	}
}


// Gestion de la  déconnexion
if(isset($_GET['erreur']) && $_GET['erreur'] == 'logout'){ // Test sur les paramètres d'URL qui permettront d'identifier un contexte de déconnexion
	$prenom = $_SESSION['prenom']; // On garde le prénom en variable pour dire au revoir (soyons polis :-)
	session_unset("authentification");
	header("Location:index.php?erreur=delog&prenom=$prenom");
}
?>
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<!--link rel="stylesheet" href="global.css" type="text/css" media="screen"-->
<link rel="stylesheet" type="text/css" href="css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/grid.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/layout.css" media="screen" />
<link rel="stylesheet" type="text/css" href="css/nav.css" media="screen" />
<title></title>
</head>
<body>
<div class="container_12">
<div class="grid_12">
<div class="grid_4" style="float: right; margin-top:20px;">
				<div class="box">
					<h2>
						<a href="#" id="toggle-search">Recherche</a>
					</h2>
					<div class="block" id="search">
						<form method="get" action="" class="search">
							<p>
								<input class="search text" name="value" type="text" onfocus="if (this.value=='recherche...') this.value=''" />
								<input class="search button" value="Chercher" type="submit" />
							</p>
						</form>
					</div>
				</div>
			</div>
	
<div class="grid_2">
<img src="images/pochoir_002.jpg" width="200" height="134" border="0" usemap="#map" />
			<map name="map">
			<!-- #$-:Image Map file created by GIMP Imagemap Plugin -->
			<!-- #$-:GIMP Imagemap Plugin by Maurits Rijk -->
			<!-- #$-:Please do not edit lines starting with "#$" -->
			<!-- #$VERSION:2.0 -->
			<!-- #$AUTHOR:andre -->
			<area shape="rect" coords="5,4,193,128" alt="logo pochoir" href="../bastide/index.php" />
			</map>
</div>
<!--div class="grid_6"style="float: left; margin-left:220px;">		
<h1 id="branding">			
Bienvenue <? echo $_SESSION['username']; ?>
</h1>
</div-->

</div>
		        				
<div class="clear"></div>

<div class="grid_12">			
			 		<ul class="nav main">
					<li>
						<a href="../bastide/gest.php">Gestion</a>	
					</li>
					<li>
						<a href="../bastide/ll.php">Logiciels Libres</a>
					</li>
					<li>
						<a href="../bastide/ba.php">Bastide</a>
					</li>
					<li>
						<a href="../bastide/asso.php">Associations</a>
					</li>
					<li class="secondary">
						<a href="../bastide/">Bienvenue <? echo $_SESSION['username']; ?></a>
					</li>
		</ul>
				
</div>

<div class="clear"></div>
<!--div class="grid_12">
<h2 id="page-heading"></h2>
</div>
<div class="clear"></div-->
<div class="grid_2">
<div class="box">
					<h2>
						<a href="#" id="toggle-login-forms">Connexion</a>
					</h2>
					<div class="block" id="login-forms">
						<form action=""method="post" name="connect">
						<p align="center" >
      <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "login")) { // Affiche l'erreur  ?>
      <strong >Echec d'authentification !!! &gt; login ou mot de passe incorrect</strong>
      <?php } ?>
      <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "delog")) { // Affiche l'erreur ?>
      <strong >D&eacute;connexion r&eacute;ussie... A bient&ocirc;t <?php echo $_GET['prenom'];?> !</strong>
      <?php } ?>
      <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "intru")) { // Affiche l'erreur ?>
      <strong >Echec d'authentification !!! &gt; Aucune session n'est ouverte ou vous n'avez pas les droits pour afficher cette page</strong>
      <?php } ?>
      </p>
							<fieldset class="login">
								<legend>Login</legend>
								<p>
									<label>User: </label>
									<input type="text" name="login" />
								</p>
								<p>
									<label>Pass: </label>
									<input type="password" name="pass" />
								</p>
								<input class="login button" type="submit" name="Submit" value="Login" />
							</fieldset>
						</form>
						<form action="compte.php">
							<fieldset>
								<legend>Compte</legend>
								<p>Si vous n'avez pas de compte, merci d'en faire la demande.</p>
								<input type="submit" value="Créer Compte" />
							</fieldset>
						</form>
					</div>
				</div>
<div class="box">
<h2>
	<a href="#" id="toggle-meteo">Météo</a>
</h2>
<div class="block">
<a href="http://perso0.free.fr/cgi-bin/meteopl?dep=46"><img src="http://perso0.free.fr/cgi-bin/meteo.pl?dep=46"></a>
	</div>
</div>
</div>
<div class="grid_8">
<div id="grid" class="box">
<h2><a href="#">Le LOT, une surprise à chaque pas</a></h2>
<div class="block">
<h3><span>Bienvenue, Welcome, y gracias por su visita</span></h3>
			<p>Vous venez d'entrer sur le site et vous souhaitez en savoir plus sur l'éditeur et ses activitées</p>
			<p>Je suis <b><a href="mailto:andre.lasfargues@wanadoo.fr" title="andre lasfargues">André Lasfargues</a></b>, natif du Lot (46-FRANCE), un département ou il fait bon vivre</p>
			<p>Mes activitées se concentrent autour des logiciels et documents libres et en particulier :
			<ul class="submenu"><li><a class="navlink" href="http://www.debian.org">DEBIAN GNU/LINUX</a>, mon système d'exploitation </li>
			<li><a class="navlink" href="http://alternative46.3wcom.com">Alternatives 46</a>, Une association pour faire connaître les logiciels libres dans le LOT</li>
			<li><a class="navlink" href="http://www.ifapte.org">L'IFAPTE</a>, Une autre association qui fait de la formation et pour laquelle j'interviens </li>
			<li><a class="navlink" href="http://www.lotabne.com/">Agriculture biologique</a>, je viens de là et continue un jardin bio sur mon temps libre</li>
			<li>Mes loisirs se concentrent autour du Football à l'ESVD, de la musique, et des amis</li></ul></p>
			<br>
			<script
    type="text/javascript"
    src="http://api.ign.fr/geoportail/api?v=1.0beta4&amp;key=6845512412611277901&amp;instance=VISU">
  <!-- -->
  </script>

  <script type="text/javascript">
  <!--
    function initGeoportalMap() {
      geoportalLoadVISU("GeoportalVisuDiv", "normal", "FXX");
   
   // Exemple avec un code territoire (ici la Guadeloupe)
   // Snapshot with a territory code (here Guadeloupe island)
   // geoportalLoadVISU("GeoportalVisuDiv", "normal", "FXX");

      if (VISU) {
        VISU.getMap().setCenterAtLonLat("01° 15' 49\" E" , "44° 30' 43\" N", 15); //lon, lat, zoom
        VISU.addGeoportalLayers();
      }
    }
  -->
  </script>

  <div id="GeoportalVisuDiv" style="width:800px;height:600px;"></div>
</div>
</div>
</div>
</body>
</html>
