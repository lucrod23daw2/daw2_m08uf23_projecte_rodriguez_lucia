<?php
session_start();
if (!isset($_SESSION['adm'])){
    header("Location: error_acces.php");
}

require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);

$uid="sysadmin";
$ou="administradors";
$dn = 'uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
#
#Opcions de la connexió al servidor i base de dades LDAP
$opcions = [
    'host' => 'zend-luroin.fjeclot.net',
    'username' => 'cn=admin,dc=fjeclot,dc=net',
    'password' => 'fjeclot',
    'bindRequiresDn' => true,
    'accountDomainName' => 'fjeclot.net',
    'baseDn' => 'dc=fjeclot,dc=net',
];
#
# Esborrant l'entrada
#
$ldap = new Ldap($opcions);
$ldap->bind();
try{
    $ldap->delete($dn);
    echo "<b style='color: red;'>Esborrat correctament</b><br>";
} catch (Exception $e){
    echo "<b style='color: red;'>No es pot esborrar ja que no existeix</b><br>";
}
?>
<html>
<head>
<title>
ELIMINANT SYSADMIN DE LA BASE DE DADES LDAP
</title>
</head>
<body>
<a href="https://zends-dacomo/m08uf23/menu.php">Torna al menú</a><br><br>
</body>
</html>