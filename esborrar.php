<html>
<head>
<title>
ELIMINANT USUARIS DE LA BASE DE DADES LDAP
</title>
</head>
<body>
<h2>Formulari d'esborrament d'usuari</h2>
<form action="http://zend-luroin.fjeclot.net/projecte/esborrar.php" method="POST">
<input type="hidden" name="_method" value="DELETE">
Unitat organitzativa:
<select name="ou" required>
  <option value="administradors">Administradors</option>
  <option value="desenvolupadors">Desenvolupadors</option>
  <option value="usuaris">Usuaris</option>
</select><br>
Usuari: <input type="text" name="uid" required><br>
<input type="submit"/>
<input type="reset"/>
</form>
<a href="http://zend-luroin.fjeclot.net/projecte/menu.php">Torna al menú</a><br><br>
</body>
</html>
<?php
require 'vendor/autoload.php';
use Laminas\Ldap\Attribute;
use Laminas\Ldap\Ldap;

ini_set('display_errors', 0);
#
# Entrada a esborrar: usuari 3 creat amb el projecte zendldap2
#
if ($_POST['uid']){
    $uid=$_POST['uid'];
    $ou=$_POST['ou'];
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
}
?>