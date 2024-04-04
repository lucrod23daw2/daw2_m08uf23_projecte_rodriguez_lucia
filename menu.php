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
		<h2> MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP</h2>
		<a href="https://zends-dacomo/m08uf23/afegir.php">Afegir usuari</a><br>
		<a href="https://zends-dacomo/m08uf23/modificar.php">Modificar usuari</a><br>
		<a href="https://zends-dacomo/m08uf23/esborrar.php">Esborrar usuari</a><br>
		<a href="https://zends-dacomo/m08uf23/visualitzar.php">Visualitzar dades d'usuari</a><br><br>
		<a href="https://zends-dacomo/m08uf23/logout.php">Tanca la sessió</a>
	</body>
</html>
