<?php
session_start();
$sessio_destruida = false;

if (isset($_SESSION['adm'])) {
    // Alliberant variables de sessió. Esborra el contingut de les variables de sessió del fitxer de sessió. Buida l'array $_SESSION. No esborra cookies
    session_unset();
    // Destrucció de la cookie de sessió dins del navegador
    $cookie_sessio = session_get_cookie_params();
    setcookie("PHPSESSID", "", time() - 3600, $cookie_sessio['path'], $cookie_sessio['domain'], $cookie_sessio['secure'], $cookie_sessio['httponly']); // Neteja cookie de sessió
    // Destrucció de la informació de sessió (per exemple, el fitxer de sessió  o l'identificador de sessió)
    session_destroy();
    $sessio_destruida = true;
}
?>
    <html>
    <head>
        <title>
            PÀGINA WEB DEL MENÚ PRINCIPAL DE L'APLICACIÓ D'ACCÉS A BASES DE DADES LDAP
        </title>
    </head>
    <body>
        <h2> SESSIÓ TANCADA CORRECTAMENT</h2>
        <a href="https://zends-dacomo/m08uf23/index.php">Torna a la pàgina inicial</a>
    </body>
    </html>
