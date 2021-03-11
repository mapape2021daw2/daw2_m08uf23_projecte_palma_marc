<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
    use Laminas\Ldap\Ldap;

    ini_set('display_errors', 0);
    
    if($_POST['uo'] && $_POST['uid']){
        $uo = $_POST['uo'];
        $uid = $_POST['uid'];
        
        $dn = 'uid='.$uid.',ou='.$uo.',dc=fjeclot,dc=net';
        
        $opcions = [
            'host' => 'zend-mapape.fjeclot.net',
            'username' => 'cn=admin,dc=fjeclot,dc=net',
            'password' => 'fjeclot',
            'bindRequiresDn' => true,
            'accountDomainName' => 'fjeclot.net',
            'baseDn' => 'dc=fjeclot,dc=net',
        ];
        
        $ldap = new Ldap($opcions);
        $ldap->bind();
        if ($ldap->delete($dn))	echo "<b>Entrada esborrada</b><br>";
        else echo "<b>Aquesta entrada no existeix</b><br>";	
    }
?>

<html>
	<head>
		<title>
			ESBORRANT USUARIS DE LA BASE DE DADES LDAP
		</title>
	</head>
	<body>
		<form action="http://zend-mapape.fjeclot.net/daw2_m08uf23_projecte_palma_marc/esborrarUsuari.php" method="POST">
			UID: <input type="text" name="uid"><br>
			Unitat organitzativa: <input type="text" name="uo"><br>
			<input type="submit"/>
			<input type="reset"/>
		</form>
	</body>
</html>