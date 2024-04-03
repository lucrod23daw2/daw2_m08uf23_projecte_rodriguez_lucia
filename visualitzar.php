<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Ldap;
ini_set('display_errors',0);
if ($_GET['uid'] && $_GET['ou']){
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
        'host' => 'zend-luroin.fjeclot.net',
        'username' => "cn=admin,$domini",
        'password' => 'fjeclot',
        'bindRequiresDn' => true,
        'accountDomainName' => 'fjeclot.net',
        'baseDn' => 'dc=fjeclot,dc=net',
    ];
    $ldap = new Ldap($opcions);
    $ldap->bind();
    $entrada='uid='.$_GET['uid'].',ou='.$_GET['ou'].',dc=fjeclot,dc=net';
    $usuari=$ldap->getEntry($entrada);
    echo "<b><u>".$usuari["dn"]."</b></u><br>";
    foreach ($usuari as $atribut => $dada) {
        if ($atribut != "dn") echo $atribut.": ".$dada[0].'<br>';
    }
}
?>
<html>
<head>
<title>
MOSTRANT DADES D'USUARIS DE LA BASE DE DADES LDAP
</title>
</head>
<body>
<h2>Formulari de selecció d'usuari</h2>
<form action="http://zend-luroin.fjeclot.net/projecte/visualitzar.php" method="GET">
Unitat organitzativa: <input type="text" name="ou" required><br>
Usuari: <input type="text" name="uid" required><br>
<input type="submit"/>
<input type="reset"/>
</form>
<a href="http://zend-luroin.fjeclot.net/projecte/menu.php">Torna al menú</a>
</body>
</html>