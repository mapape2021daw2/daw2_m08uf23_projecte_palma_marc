<?php
    require 'vendor/autoload.php';
    use Laminas\Ldap\Attribute;
    use Laminas\Ldap\Ldap;
    
    ini_set('display_errors', 0);
    
    if($_POST['uid'] && $_POST['uo'] && $_POST['uidn'] && $_POST['gnum'] && $_POST['dp'] && $_POST['shell'] && $cn = $_POST['cn'] && $sn = $_POST['sn']
        && $_POST['gn'] && $_POST['pa'] && $_POST['mobile'] && $_POST['tn'] && $_POST['title'] && $_POST['description']) {

    $uid = $_POST['uid'];
    $uo = $_POST['uo'];
    $uidn = $_POST['uidn'];
    $gnum = $_POST['gnum'];
    $dp = $_POST['dp'];
    $shell = $_POST['shell'];
    $cn = $_POST['cn'];
    $sn = $_POST['sn'];
    $gn = $_POST['gn'];
    $pa = $_POST['pa'];
    $mobile = $_POST['mobile'];
    $tn = $_POST['tn'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $objcl=array('inetOrgPerson','organizationalPerson','person','posixAccount','shadowAccount','top');
    
    $domini = 'dc=fjeclot,dc=net';
    $opcions = [
    'host' => 'zend-mapape.fjeclot.net',
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
    Attribute::setAttribute($nova_entrada, 'uid', $uid);
    Attribute::setAttribute($nova_entrada, 'uidNumber', $uidn);
    Attribute::setAttribute($nova_entrada, 'gidNumber', $gnum);
    Attribute::setAttribute($nova_entrada, 'homeDirectory', $dp);
    Attribute::setAttribute($nova_entrada, 'loginShell', $shell);
    Attribute::setAttribute($nova_entrada, 'cn', $cn);
    Attribute::setAttribute($nova_entrada, 'sn', $sn);
    Attribute::setAttribute($nova_entrada, 'givenName', $gn);
    Attribute::setAttribute($nova_entrada, 'mobile', $mobile);
    Attribute::setAttribute($nova_entrada, 'postalAddress', $pa);
    Attribute::setAttribute($nova_entrada, 'telephoneNumber', $tn);
    Attribute::setAttribute($nova_entrada, 'title', $title);
    Attribute::setAttribute($nova_entrada, 'description', $description);
    $dn = 'uid='.$uid.',ou='.$uo.',dc=fjeclot,dc=net';
    if($ldap->add($dn, $nova_entrada)) echo "Usuari creat";	
    }
?>

<html>
	<head>
		<title>
			AFEGINT USUARI A LA BASE DE DADES LDAP
		</title>
	</head>
	<body>
		<form action="http://zend-mapape.fjeclot.net/daw2_m08uf23_projecte_palma_marc/afegirUsuari.php" method="POST">
			uid: <input type="text" name="uid"><br>
			Unitat organitzativa: <input type="text" name="uo"><br>
			uidNumber: <input type="number" name="uidn"><br>
			gidNumber: <input type="number" name="gnum"><br>
			Directori personal: <input type="text" name="dp"><br>
			Shell: <input type="text" name="shell"><br>
			cn: <input type="text" name="cn"><br>
			sn: <input type="text" name="sn"><br>
			givenName: <input type="text" name="gn"><br>
			PostalAdress: <input type="text" name="pa"><br>
			Mobile: <input type="tel" name="mobile"><br>
			Telephone Number: <input type="tel" name="tn"><br>
			Title: <input type="text" name="title"><br>
			Description: <input type="text" name="description"><br>
			<input type="submit"/>
			<input type="reset"/>
		</form>
	</body>
</html>