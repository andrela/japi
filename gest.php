<?php require_once('connexion.php'); ?>
<?php
/*
-----------------------------------
------ SCRIPT DE PROTECTION -------
          DBProtect V1.2
-----------------------------------
*/

session_start(); // On relaye la session
if (session_is_registered("authentification")){ // vérification sur la session authentification (la session est elle enregistrée ?)
// ici les éventuelles actions en cas de réussite de la connexion
}
else {
header("Location:index.php?erreur=intru"); // redirection en cas d'echec
}
?>
<DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
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
<!--div class="grid_6">		
<h1 id="branding">Bienvenue <span style="color: #c91616"><?php echo $_SESSION['prenom']; ?></span> <span style="color: #c91616"><?php echo $_SESSION['nom']; ?></span></h1>
<h5 id="branding"><span>
Vous &ecirc;tes connect&eacute; en tant que &quot;<?php echo $_SESSION['login']; ?>&quot; avec le privil&egrave;ge &quot;<?php echo $_SESSION['privilege']; ?>&quot;.</h5>
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
						<a href="../bastide/">Bienvenue  <span class="donnee" style="color: #c91616"><? echo $_SESSION['login']; ?></span></a>
					</li>
		</ul>
				
</div>

<div class="clear"></div>
<div class="grid_2">
<div class="box">
<h2>
						<a href="#" id="toggle-login-forms">Connexion</a>
					</h2>
					<div class="block" id="login-forms">
<?php 
/*
--- AFFICHAGE CONDITIONNEL OU REDIRECTION EN FONCTION DU PRIVILEGE ---
	Config actuelle : le script gère un affichage conditionnel
	Pour rediriger l'utilisateur en fonction de son privilege, ajoutez les lignes suivantes aux endroits indiqués
	Dans la zone d'affichage admin : 
			header("Location:URL SI ADMIN")
	Dans la zone d'affichage admin : 
			header("Location:URL SI USER SIMPLE")
			
Note: pour ajouter des privilèges, editez ce fichier en rajoutant une condition d'affichage
et editez le fichier admin.php en ajoutant à la liste "select" un privilege.
*/
  
  
  // si l'utilisateur est connecté comme admin ...
  if($_SESSION['privilege'] == "admin") { // Affichage conditionnel : si et seulement si l'utilisateur est connecté avec le privilege administrateur ?>
<span class="donnee">
Vous &ecirc;tes connect&eacute; en tant que &quot;<span class="donnee"><?php echo $_SESSION['login']; ?></span>&quot;
 avec le privil&egrave;ge &quot;<span class="donnee"><?php echo $_SESSION['privilege']; ?></span>&quot;.<br>
<strong><u>En tant qu'administrateur vous pouvez effectuer les actions suivantes : </u></strong></p>
<p class="Style4">- <a href="admin.php">G&eacute;rer les utilisateurs</a>
  <?php } // fin de l'affichage conditionnel?>
</p>
<p>
  <?php 
  // si l'utilisateur est connecté comme simple utilisateur ...
  if($_SESSION['privilege'] == "user") { // Affichage conditionnel : si et seulement si l'utilisateur est connecté avec le privilege utilisateur simple ?>
  <strong><u>En tant qu'utilisateur simple vous ne pouvez pas effectuer d'actions</u></strong>
<?php } // fin de l'affichage conditionnel?>
</p>
<p align="center"><a href="index.php?erreur=logout"><strong>Vous d&eacute;connecter</strong></a></p>
</div>
</div>
<div class="box">
<h2>
	<a href="#" id="toggle-meteo">M&eacute;t&eacute;o</a>
</h2>
<div class="block">
<a href="http://perso0.free.fr/cgi-bin/meteopl?dep=46"><img src="http://perso0.free.fr/cgi-bin/meteo.pl?dep=46"></a>
	</div>
</div>
</div>
</div>
<!--div class="grid_10"-->
<div class="grid_4">
<div class="box" >
<h2><a href="#">GESTION</a></h2>	
<div class="block" >
<h3>Des semences au jardin</h3>	
<h5>
<?php
setlocale (LC_ALL, "fr_FR.UTF-8");
setlocale (LC_TIME, "fr_FR.UTF-8");
echo strftime("%A %d %B %Y == %H:%M:%S");
?>
</h5>
<?php
include('header.php');
?>
</div>
</div>
</div>
<?php
if (!empty($_POST["nrsanew"])) {
include('ajoutsach.php');
include('semences1.php');
}
elseif (!empty($_POST["nrvarnew"])) {
include('ajoutvar.php');
include('vareg.php');
}
elseif (!empty($_POST["nrsortnew"])) {
include('ajoutsort.php');
include('sorteg.php');
}
elseif (!empty($_POST["nr_famnew"])) {
include('ajoutfam.php');
include('sorteg.php');
}
elseif (!empty($_POST["nrcatnew"])) {
include('ajoutcat.php');
include('categ.php');
}
elseif ($_GET["plan"] >= '0') {
include('pot3.php');
}
elseif ($_GET["pot"] >= '0') {
include('pot3.php');
}
elseif ($_GET["semis"] >= '0') {
include('pot3.php');
}
elseif (!empty($_GET["plak"])) {
include('plak.php');
}
// Si une semence est sélectionnée, on se prépare à semer et on voit les sachets disponibles
// La première partie se termine ici et on quitte gest.php pour plant.php pour les actions
// de semer en plein champ, dans les pots, dans les plaques ou dans la poubelle
elseif (!empty($_GET["semence"])) {
include('sachet1.php');
}
// Si une variété est sélectionnée, on va sur les semences
elseif (!empty($_GET["vareg"])) {
include('semences1.php');
}
// Si une sorte est sélectionnée, on va sur les variétés
elseif (!empty($_GET["sorteg"])) {
include('vareg.php');
}
// Si une catégorie est sélectionnée, on va sur les sortes et familles
elseif (!empty($_GET["categ"])) {
include('sorteg.php');
}
// Si aucune conditions remplies, on affiche les catégories
else {
include('categ.php');
}
?>
</div>	
</body>
</html>
