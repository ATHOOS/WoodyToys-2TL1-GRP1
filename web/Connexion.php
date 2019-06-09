<?php
$servername = "172.16.1.2";
$username = "web";
$password = "xxx";
//connexion à la base de donnée
try {
    $conn = new PDO("mysql:host=$servername;dbname=WTdb", $username, $password, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
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

$req = $conn->prepare('SELECT NCLI, ONSS, NOM, ADRESSE, LOCALITE, NEWS FROM CLIENT WHERE ONSS not like ""');
$req->execute();

echo '<table>';
echo '<tr>';
echo '<th>'."NCLI".'</th>';
echo '<th>'."ONSS".'</th>';
echo '<th>'."NOM".'</th>';
echo '<th>'."ADRESSE".'</th>';
echo '<th>'."LOCALITE".'</th>';
echo '<th>'."NEWS".'</th>';
echo '<tr>';

while ($donnees = $req->fetch())
{
    echo '<tr>';
    echo '<th>'.$donnees['NCLI'].'</th>';
    echo '<th>'.$donnees['ONSS'].'</th>';
    echo '<th>'.$donnees['NOM'].'</th>';
    echo '<th>'.$donnees['ADRESSE'].'</th>';
    echo '<th>'.$donnees['LOCALITE'].'</th>';
    echo '<th>'.$donnees['NEWS'].'</th>';
    echo '</tr>';
}

echo '</table>';
$req->closeCursor();

?>
