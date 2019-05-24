<?php
$servername = "51.77.141.217";
$username = "user";
$password = "vivelabière";
//connexion à la base de donnée
try {
    $conn = new PDO("mysql:host=$servername;dbname=WTdb", $username, $password);
    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
    }
catch(PDOException $e)
    {
    echo "Connection failed: " . $e->getMessage();
    }
// protection contre injection SQL via des string
$testInjectionSQL = array(
	'Id' => ($_POST['Id']),
	'name' => ($_POST['name']),
	'mail' => ($_POST['mail']),
	'address' => ($_POST['address']),
	'password' => ($_POST['password']),
	'news' => ($_POST['news'])
);
foreach ($testInjectionSQL as $element) {
	if (is_numeric($testInjectionSQL[$element]))
		{
			// si tout est correct, passer au suivant
		}
	else
		{
			//implémentation incorrecte : injection SQL, interruption de la requête SQL
			$conn = null;
		}
}
unset($testInjectionSQL); // efface l'array
// evite un autre type d'injection sql
$Id =mysql_real_escape_string($_POST['Id']);
$name =mysql_real_escape_string($_POST['name']);
$mail=mysql_real_escape_string($_POST['mail']);
$address =mysql_real_escape_string($_POST['address']);
$password =mysql_real_escape_string($_POST['password']);
$news =mysql_real_escape_string($_POST['news']);
// création d'une requête pour éviter des injection sql
$inscriptUtilisateur = $conn->prepare('INSERT INTO CLIENT(ONSS, NOM, ADRESSE, LOCALITE, PASSWORD, NEWS) VALUES(:ONSS, :NOM, :ADRESSE, :LOCALITE, :PASSWORD, :NEWS)') or die(print_r($conn->errorInfo()));
// excecution de la requête
$inscriptUtilisateur->execute(array(
	'ONNS' => $Id,
	'NOM' => $name,
	'ADRESSE' => $mail,
	'LOCALITE' => $address,
	'PASSWORD' => $password,
	'NEWS' => $news)) or die(print_r($conn->errorInfo()));
$inscriptUtilisateur->closeCursor(); //on ferme la requête
?>
