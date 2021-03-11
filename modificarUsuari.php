<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
    use Laminas\Ldap\Ldap;

    ini_set('display_errors', 0);
    
    if($_POST['uo'] && $_POST['uid'] && $_POST['seleccionat'] && $_POST['nou']) {
        $seleccionat = $_POST['seleccionat'];
        $nou = $_POST['nou'];
        
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
        $entrada = $ldap->getEntry($dn);
        if ($entrada){
            Attribute::setAttribute($entrada,$seleccionat,$nou);
            $ldap->update($dn, $entrada);
            echo "Atribut modificat";
        } else echo "<b>Aquesta entrada no existeix</b><br><br>";	
    }
?>

<html>
	<head>
		<title>
			MODIFICANT DADES D'USUARIS DE LA BASE DE DADES LDAP
		</title>
	</head>
	<body>
		<form action="http://zend-mapape.fjeclot.net/daw2_m08uf23_projecte_palma_marc/modificarUsuari.php" method="POST">
			UID: <input type="text" name="uid"><br>
			Unitat organitzativa: <input type="text" name="uo"><br>
			
			<input type="radio" name="seleccionat" value="uidNumber">
			<label for="uidNumber">uidNumber</label><br>
			<input type="radio" name="seleccionat" value="gidNumber">
			<label for="gidNumber">gidNumber</label><br>
			<input type="radio" name="seleccionat" value="dp">
			<label for="dp">Directori personal</label><br>
			<input type="radio" name="seleccionat" value="shell">
			<label for="shell">shell</label><br>
			<input type="radio" name="seleccionat" value="cn">
			<label for="cn">cn</label><br>
			<input type="radio" name="seleccionat" value="sn">
			<label for="sn">sn</label><br>
			<input type="radio" name="seleccionat" value="givenName">
			<label for="givenName">givenName</label><br>
			<input type="radio" name="seleccionat" value="postalAd">
			<label for="postalAd">postalAd</label><br>
			<input type="radio" name="seleccionat" value="mobile">
			<label for="mobile">mobile</label><br>
			<input type="radio" name="seleccionat" value="tn">
			<label for="tn">Telephone number</label><br>
			<input type="radio" name="seleccionat" value="title">
			<label for="tn">Title</label><br>
			<input type="radio" name="seleccionat" value="description">
			<label for="description">Description</label><br>
			
			Nou contingut: <input type="text" name="nou">
			
			<input type="submit"/>
			<input type="reset"/>
		</form>
	</body>
</html>