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
<!--div class="grid_6">		
<h1 id="branding">Bienvenue <span class="donnee" style="color: #c91616"><?php echo $_SESSION['prenom']; ?></span> <span class="donnee" style="color: #c91616"><?php echo $_SESSION['nom']; ?></span><br></h1>
<h5 id="branding"><span class="donnee">
Vous &ecirc;tes connect&eacute; en tant que &quot;<span class="donnee"><?php echo $_SESSION['login']; ?></span>&quot; avec le privil&egrave;ge &quot;<span class="donnee"><?php echo $_SESSION['privilege']; ?></span>&quot;.<br></h5>
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
<div class="grid_8">
<div class="box">
<h2><a href="#">Le LOT, une surprise &agrave; chaque pas</a></h2>
<div class="block">
<h3><span>Bienvenue, Welcome, y gracias por su visita</span></h3>
			<p>Vous venez d'entrer sur le site et vous souhaitez en savoir plus sur l'&eacute;diteur et ses activit&eacute;es</p>
			<p>Je suis <b><a href="mailto:andre.lasfargues@wanadoo.fr" title="andre lasfargues">Andr&eacute; Lasfargues</a></b>, natif du Lot (46-FRANCE), un d&eacute;partement ou il fait bon vivre</p>
			<p>Mes activit&eacute;es se concentrent autour des logiciels et documents libres et en particulier :
			<ul class="submenu"><li><a class="navlink" href="http://www.debian.org">DEBIAN GNU/LINUX</a>, mon syst&egrave;me d'exploitation </li>
			<li><a href="http://alternative46.3wcom.com">Alternatives 46</a>, Une association pour faire connaitre les logiciels libres dans le LOT</li>
			<li><a href="http://www.univ-metz.fr/iut/moselle-est/">L'IUT de Moselle-est</a>, de 2006 &agrave; 2009 ou j'ai &eacute;t&eacute; Technicien informatique avec Sambaedu3 </li>
			<li><a href="http://www.univ-orleans.fr">L'Universit&eacute; d'Orl&eacute;ans</a>, depuis 2010 et ou je suis Assistant ing&eacute;nieur pour la gestion du parc informatique de l'UFR Sciences </li>
			<li><a href="http://www.ifapte.org">L'IFAPTE</a>, Une autre association qui fait de la formation et pour laquelle j'intervennais </li>
			<li><a href="http://www.lotabne.com/">Agriculture biologique</a>, je viens de l&agrave; et continue un jardin bio sur mon temps libre</li>
			<li>Mes loisirs se concentrent autour du Football &agrave; l'ESVD, de la musique, et des amis</li></ul></p>
			<br>
<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style">
<a href="http://www.addthis.com/bookmark.php?v=250&amp;username=xa-4b71ad0879e4758f" class="addthis_button_compact">Share</a>
<span class="addthis_separator">|</span>
<a class="addthis_button_facebook"></a>
<a class="addthis_button_google"></a>
<a class="addthis_button_twitter"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#username=xa-4b71ad0879e4758f"></script>
<!-- AddThis Button END -->		
</div>
</div>
</div>
</body>
</html>
