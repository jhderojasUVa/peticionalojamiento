<?php
$config['ldap'] = array();

$config['ldap']['host'] = "157.88.25.9"; //"192.168.21.23"; //"157.88.25.9";
$config['ldap']['puerto'] = 389;
$config['ldap']['dnadmin'] = "uid=inmobiliaria_uva,ou=personal,dc=uva,dc=es";
$config['ldap']['passwdadmin'] = "Zh5k5o4m";
$config['ldap']['base'] = "ou=personal,dc=uva,dc=es";

// Atributo donde se encuentra el identificador de usuario
// Ejemplos: uid, sAMAccountName (para Active Directory)
$config['ldap']['uidattr'] = 'uid';
?>
