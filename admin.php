<?php require_once('connexion.php'); ?>
<?php
/*
-----------------------------------
------ SCRIPT DE PROTECTION -------
          DBProtect V1.2
-----------------------------------
*/

session_start(); // On relaye la session
if (session_is_registered("authentification") && $_SESSION['privilege'] == "admin"){ // vérification sur la session authentification (la session est elle enregistrée ?)
// On vérifie également si la session ouverte est bien une session admin et on place ici les éventuelles actions en cas de réussite de la connexion
}
else {
header("Location:index.php?erreur=intru"); // redirection en cas d'echec
}
?>
<?php 
// ------ AJOUT D'UN UTILISATEUR --------
if(isset($_POST['login'])){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	if(($_POST['login'] == "") || ($_POST['pass'] == "")){ // si login ou mot de passe non spécifiés >> message d'erreur
		header("Location:admin.php?erreur=empty");
	}
	else if($_POST['pass'] == $_POST['pass2']){ // on vérifie si le mot de passe et le mot de passe confirmé ont la même valeur
		// on passe toutes les variables $POST en variables
		$login = $_POST['login'];
		$pass = md5($_POST['pass']); // ici, on crypte le mot de passe à l'aide de MD5 (c'est tout simple non ? :)
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$privilege = $_POST['privilege'];
		// on fait l'INSERT dans la base de données
		$add_user = sprintf("INSERT INTO utilisateurs (login, pass, nom, prenom, privilege) VALUES ('$login', '$pass', '$nom', '$prenom', '$privilege')");
  		mysql_select_db($database_dbprotect, $dbprotect);
  		$result = mysql_query($add_user, $dbprotect) or die(mysql_error());
		header("Location:admin.php?add=ok"); // redirection si création réussie
	}
	else{
		header("Location:admin.php?erreur=pass"); // redirection si le pass1 est différent du pass2
	}
}

// ------ SUPPRESSION D'UN UTILISATEUR --------
// on fait la requête sur tous les utilisateurs de la base pour alimenter notre sélecteur (on fait un tri par nom)
mysql_select_db($database_dbprotect, $dbprotect);
$query_users = "SELECT * FROM utilisateurs ORDER BY nom ASC"; // ORDER BY renvoi les données triées (ici par nom croissant)
$users = mysql_query($query_users, $dbprotect) or die(mysql_error());
$row_users = mysql_fetch_assoc($users);

if(isset($_POST['suppr']) && ($_POST['suppr'] != "1")){ // on vérifie la présence des variables de formulaire (si le formulaire a été envoyé)
	$id = $_POST['suppr'];
    $delete_user = sprintf("DELETE FROM utilisateurs WHERE id_user='$id'");

  mysql_select_db($database_dbprotect, $dbprotect);
  $result = mysql_query($delete_user, $dbprotect) or die(mysql_error());
  header("Location:admin.php?delete=ok"); // url qui servira pour afficher le message de réussite
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
<title>ADMINISTRATION - Utilisateurs</title>
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
<!--/div>
</div-->
<div class="grid_8">
<div class="box">
<div id="grid" class="box menu">
					<h2>
						<a style="cursor: pointer;" href="admin.php" id=\"toggle-section-menu\">: : : ESPACE ADMINISTRATION : : :</a>
					</h2>
<p>
    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "pass")) { // Affiche l'erreur  ?>
    <span class="erreur">Veuillez entrer deux fois votre mot de passe SVP</span>
    <?php } ?>
    <?php if(isset($_GET['add']) && ($_GET['add'] == "ok")) { // Affiche l'erreur ?>
    <span class="reussite">L'utilisateur a &eacute;t&eacute; cr&eacute;&eacute; avec succ&egrave;s !</span>
    <?php } ?>
    <?php if(isset($_GET['erreur']) && ($_GET['erreur'] == "empty")) { // Affiche l'erreur  ?>
    <span class="erreur">Un petit oubli non ? Veuillez renseigner au moins un login et un mot de passe SVP</span>
    <?php } ?>
</p>
<div id="forms" class="box" >
<form action="admin.php" method="post" name="add">
<fieldset>
  <legend>Cr&eacute;er un utilisateur</legend>
  <p>
  <label>Login</label>
      <input name="login" type="text" id="login"></p>
      <p><label>Mot de passe</label>
      <input name="pass" type="password" id="pass"></p>
      <p><label>R&eacute;p&eacute;ter mot de passe</label>
      <input name="pass2" type="password" id="pass2"></p>
      <p><label>NOM</label>
      <input name="nom" type="text" id="nom"></p>
      <p><label>Pr&eacute;nom</label>
      <input name="prenom" type="text" id="prenom"></p>
      <p><label>Privil&egrave;ge</label>
      <select name="privilege" id="privilege">
          <option value="user">Utilisateur</option>
          <option value="admin">Administrateur</option>
        </select></p>
      <input class="register-button" type="submit" name="Submit" value="Cr&eacute;er cet utilisateur">
      </fieldset>
</form>
</div>
<p><strong>
  <?php 
if(isset($_GET['delete']) && ($_GET['delete'] == "ok")) { // Affiche l'erreur  ?>
  <span>L'utilisateur a &eacute;t&eacute; supprim&eacute; avec succ&egrave;s</span>
  <?php } ?>
  <?php 
if(isset($_POST['verif']) && (!isset($_POST['suppr']))) { // Affiche l'erreur  ?>
</strong><span>Veuillez s&eacute;lectionner un utilisateur &agrave; supprimer </span><strong>
<?php } ?>
<?php 
if(isset($_POST['suppr']) && ($_POST['suppr'] == "1")) { // Affiche l'erreur  ?>
</strong><span>Vous ne pouvez pas supprimer l'utilisateur par d&eacute;faut toto.<br>
Pour tester la fonction de supression, ajoutez un utilisateur.<br>
Pour s&eacute;curiser votre script, il est fortement recommand&eacute; de le supprimer manuellement dans votre BDD ... </span><strong>
<?php } ?></strong></p>
<div id="forms" class="box" >
<form action="admin.php" method="post" name="suppr">
<fieldset>
  <legend>Supprimer un utilisateur</legend>
  <p><label>Sélectionner l'utilisateur</label>
            <select name="suppr" size="5" id="select2">
              <?php
	do {  
?>
              <option value="<?php echo $row_users['id_user']?>">
              <?php if($row_users['privilege']== "admin") echo ">> "; echo $row_users['nom']." ".$row_users['prenom']." (".$row_users['login'].")"; if($row_users['privilege']== "admin") echo " <<"?>
              </option>
              <?php
	} while ($row_users = mysql_fetch_assoc($users));
 		$rows = mysql_num_rows($users);
  		if($rows > 0) {
      		mysql_data_seek($users, 0);
	  		$row_users = mysql_fetch_assoc($users);
		}
?>
            </select></p>
            <input name="verif" type="hidden" id="verif">
<input class="register-button" type="submit" name="Submit2" value="Supprimer cet utilisateur">
    <p><a href="accueil.php"><strong>&lt; Retour accueil</strong></a></p>
    </fieldset>
  </form>
  </div>
  </div>
  </body>
</html>
