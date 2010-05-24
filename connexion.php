<?php
/*
-----------------------------------
------ SCRIPT DE PROTECTION -------
          DBProtect V1.2
-----------------------------------
*/
// Paramètres de connexion
$hostname_dbprotect = "localhost"; // nom ou ip de votre serveur
$database_dbprotect = "dbprotect"; // nom de votre base de données
$username_dbprotect = "root"; // nom d'utilisateur (root par défaut) !!! ATTENTION, en utilisant root, vos visiteurs on tout les droits sur la base
$password_dbprotect = "to629or"; // mot de passe (aucun par défaut mais il est fortement recommandé d'en mettre un ... sinon, à quoi bon la sécurité ?)
$dbprotect = mysql_ppconnect($hostname_dbprotect, $username_dbprotect, $password_dbprotect) or trigger_error(mysql_error(),E_USER_ERROR); 

?>
