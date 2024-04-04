<?php
session_start();
if (!isset($_SESSION['adm'])){
    header("Location: error_acces.php");
}
?>
<html>
	<head>
		<title>
			PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP
		</title>
	</head>
	<body>
		<h2> ESTAS SEGUR DE VOLER ESBORRAR L'USUARI 'SYSADMIN'?</h2>
		<a href="https://zends-dacomo/m08uf23/esborrarSysadmin.php">Sí</a><br>
		<a href="https://zends-dacomo/m08uf23/menu.php">No</a><br>
	</body>
</html>