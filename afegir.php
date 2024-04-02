<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
    use Laminas\Ldap\Ldap;
    
    ini_set('display_errors', 0);
    #Dades de la nova entrada
    #
    if ($_POST['uid']){
        $uid=$_POST['uid'];
        $ou=$_POST['ou'];
        $uidNumber=$_POST['uidNumber'];
        $gidNumber=$_POST['gidNumber'];
        $dir=$_POST['dir'];
        $sh=$_POST['shell'];
        $cn=$_POST['cn'];
        $sn=$_POST['sn'];
        $givenName=$_POST['givenName'];
        $mobile=$_POST['mobile'];
        $postalAdress=$_POST['postalAdress'];
        $telf=$_POST['telf'];
        $title=$_POST['title'];
        $description=$_POST['description'];
        $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
        #
        #Afegint la nova entrada
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
        $nova_entrada = [];
        Attribute::setAttribute($nova_entrada, 'objectClass', $objcl);
        Attribute::setAttribute($nova_entrada, 'uid', $ou);
        Attribute::setAttribute($nova_entrada, 'uidNumber', $uidNumber);
        Attribute::setAttribute($nova_entrada, 'gidNumber', $gidNumber);
        Attribute::setAttribute($nova_entrada, 'homeDirectory', $dir);
        Attribute::setAttribute($nova_entrada, 'loginShell', $sh);
        Attribute::setAttribute($nova_entrada, 'cn', $cn);
        Attribute::setAttribute($nova_entrada, 'sn', $sn);
        Attribute::setAttribute($nova_entrada, 'givenName', $givenName);
        Attribute::setAttribute($nova_entrada, 'mobile', $mobile);
        Attribute::setAttribute($nova_entrada, 'postalAddress', $postalAdress);
        Attribute::setAttribute($nova_entrada, 'telephoneNumber', $telf);
        Attribute::setAttribute($nova_entrada, 'title', $title);
        Attribute::setAttribute($nova_entrada, 'description', $description);
        $dn = 'uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
        if ($ldap->add($dn, $nova_entrada)) {
            echo "Usuari creat, <a href='http://zend-luroin.fjeclot.net/projecte/visualitzar.php?ou=$ou&usr=$uid'>Visualitzar dades d'usuari</a><br>";
        }
    }
?>
<html>
<head>
<title>
AFEGINT USUARIS A LA BASE DE DADES LDAP
</title>
</head>
<body>
<h2>Formulari de creació d'usuaris</h2>
<form action="http://zend-luroin.fjeclot.net/projecte/afegir.php" method="POST">
UID: <input type="text" name="uid" required><br>
Unitat organitzativa:
<select name="ou" required>
  <option value="administradors">Administradors</option>
  <option value="desenvolupadors">Desenvolupadors</option>
  <option value="usuaris">Usuaris</option>
</select><br>
UID Number: <input type="text" name="uidNumber" required><br>
GID Number: <input type="text" name="gidNumber" required><br>
Direcrori personal: <input type="text" name="dir" required><br>
Shell: <input type="text" name="shell" required><br>
CN: <input type="text" name="cn" required><br>
SN: <input type="text" name="sn" required><br>
Given name: <input type="text" name="givenName" required><br>
Postal adress: <input type="text" name="postalAdress" required><br>
Mobile: <input type="text" name="mobile"><br>
Telefon: <input type="text" name="telf" required><br>
Title: <input type="text" name="title" required><br>
Description: <input type="text" name="description" required><br>
<input type="submit"/>
<input type="reset"/>
</form>
<a href="http://zend-luroin.fjeclot.net/projecte/menu.php">Torna al menú</a>
</body>
</html>