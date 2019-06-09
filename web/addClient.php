<?php
require("db.php");

$conn = getConnection();

if($_POST['name']) {
	// protection contre injection SQL via des string
	$testInjectionSQL = array(
		'Id' => ($_POST['Id']),
		'name' => ($_POST['name']),
		'mail' => ($_POST['mail']),
		'address' => ($_POST['address']),
		'password' => ($_POST['password']),
		'news' => ($_POST['news'])
	);

	unset($testInjectionSQL); // efface l'array
	// evite un autre type d'injection sql
	$Id =$conn->quote($_POST['Id']);
	$name =$conn->quote($_POST['name']);
	$mail=$conn->quote($_POST['mail']);
	$address =$conn->quote($_POST['address']);
	$password =$conn->quote($_POST['password']);
	$news =($_POST['news']) ? 1 : 0;
	// création d'une requête pour éviter des injection sql
	$inscriptUtilisateur = $conn->prepare('INSERT INTO CLIENT(ONSS, NOM, ADRESSE, LOCALITE, PASSWORD, NEWS) VALUES(:ONSS, :NOM, :ADRESSE, :LOCALITE, :PASSWORD, :NEWS)') or die(print_r($conn->errorInfo()));
	// excecution de la requête
	$inscriptUtilisateur->execute(array(
		':ONSS' => $Id,
		':NOM' => $name,
		':ADRESSE' => $mail,
		':LOCALITE' => $address,
		':PASSWORD' => $password,
		':NEWS' => $news)) or die(print_r($conn->errorInfo()));
	$inscriptUtilisateur->closeCursor(); //on ferme la requête
}

header("Location: /");

?>
