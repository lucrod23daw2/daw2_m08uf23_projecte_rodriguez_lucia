<html>
<head>
<title>
MODIFICANT DADES D'USUARIS A LA BASE DE DADES LDAP
</title>
</head>
<body>
<h2>Formulari de modificació d'usuaris</h2>
<form action="http://zend-luroin.fjeclot.net/projecte/modificar.php" method="POST">
UID: <input type="text" name="uid" required><br>
Unitat organitzativa:
<select name="ou" required>
  <option value="administradors">Administradors</option>
  <option value="desenvolupadors">Desenvolupadors</option>
  <option value="usuaris">Usuaris</option>
</select><br><br>
<label><b>Marca el camp que vols modificar i introdueix el nou valor:</b></label><br>
<input type="radio" name="atribut[]" value="uidNumber">UID Number: <input type="text" name="uidNumber"><br>
<input type="radio" name="atribut[]" value="gidNumber">GID Number: <input type="text" name="gidNumber"><br>
<input type="radio" name="atribut[]" value="dir">Direcrori personal: <input type="text" name="dir"><br>
<input type="radio" name="atribut[]" value="shell">Shell: <input type="text" name="shell"><br>
<input type="radio" name="atribut[]" value="cn">CN: <input type="text" name="cn"><br>
<input type="radio" name="atribut[]" value="sn">SN: <input type="text" name="sn"><br>
<input type="radio" name="atribut[]" value="givenName">Given name: <input type="text" name="givenName"><br>
<input type="radio" name="atribut[]" value="postalAdress">Postal adress: <input type="text" name="postalAdress"><br>
<input type="radio" name="atribut[]" value="mobile">Mobile: <input type="text" name="mobile"><br>
<input type="radio" name="atribut[]" value="telf">Telefon: <input type="text" name="telf"><br>
<input type="radio" name="atribut[]" value="title">Title: <input type="text" name="title"><br>
<input type="radio" name="atribut[]" value="description">Description: <input type="text" name="description"><br>
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
    #Dades de la nova entrada
    #
    if ($_POST['uid']){
        $uid=$_POST['uid'];
        $ou=$_POST['ou'];
        $atribut = $_POST['atribut'][0];
        $nou_contingut = $_POST[$atribut];
        #
        #Opcions de la connexió al servidor i base de dades LDAP
        $dn = 'uid='.$uid.',ou='.$ou.',dc=fjeclot,dc=net';
        $opcions = [
            'host' => 'zend-luroin.fjeclot.net',
            'username' => 'cn=admin,dc=fjeclot,dc=net',
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];
        #
        # Modificant l'entrada
        #
        $ldap = new Ldap($opcions);
        $ldap->bind();
        $entrada = $ldap->getEntry($dn);
        if ($entrada){
            if(!empty($nou_contingut)) {
                Attribute::setAttribute($entrada, $atribut, $nou_contingut);
                $ldap->update($dn, $entrada);
                echo "<b>Atribut modificat correctament<b>";
            } else {
                echo "<b>Introdueix un valor per al camp<b>";
            }
        }else{
            echo "<b>Aquesta entrada no existeix</b><br><br>";	
        }
    }
?>