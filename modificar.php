<?php
session_start();
if (!isset($_SESSION['adm'])){
    header("Location: error_acces.php");
}
?>
<html>
<head>
<title>
MODIFICANT DADES D'USUARIS A LA BASE DE DADES LDAP
</title>
</head>
<body>
<h2>Formulari de modificació d'usuaris</h2>
<form action="http://zend-luroin.fjeclot.net/projecte/modificar.php" method="POST">
<input type="hidden" name="metode" value="PUT" />
Unitat organitzativa:
<select name="ou" required>
  <option value="administradors">Administradors</option>
  <option value="desenvolupadors">Desenvolupadors</option>
  <option value="usuaris">Usuaris</option>
</select><br>
UID: <input type="text" name="uid" required><br><br>
<label><b>Marca el camp que vols modificar i introdueix el nou valor:</b></label><br>
<input type="radio" name="atribut" value="uidNumber">UID Number<br>
<input type="radio" name="atribut" value="gidNumber">GID Number<br>
<input type="radio" name="atribut" value="homeDirectory">Directori personal<br>
<input type="radio" name="atribut" value="loginShell">Shell<br>
<input type="radio" name="atribut" value="cn">CN<br>
<input type="radio" name="atribut" value="sn">SN<br>
<input type="radio" name="atribut" value="givenName">Given name<br>
<input type="radio" name="atribut" value="postalAddress">Postal address<br>
<input type="radio" name="atribut" value="mobile">Mobile<br>
<input type="radio" name="atribut" value="telephoneNumber">Telefon<br>
<input type="radio" name="atribut" value="title">Title<br>
<input type="radio" name="atribut" value="description">Description<br>
Nou valor:<input type="text" name="valorModif" required><br>
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
    if( $_POST["metode"] == "PUT" ){
        if ($_POST['uid']){
            $uid=$_POST['uid'];
            $ou=$_POST['ou'];
            $atribut = $_POST['atribut'];
            $valorModif = $_POST['valorModif'];
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
                if(!empty($valorModif)) {
                    Attribute::setAttribute($entrada, $atribut, $valorModif);
                    $ldap->update($dn, $entrada);
                    echo "<b>Atribut modificat correctament<b>";
                }
            }else{
                echo "<b>Aquesta entrada no existeix</b><br><br>";	
            }
        }
    }
?>