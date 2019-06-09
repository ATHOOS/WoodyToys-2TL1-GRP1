<?php
require("db.php");


function getAllClients() {
	$conn = getConnection();
	$req = $conn->prepare('SELECT * FROM CLIENT');
	$req->execute();

	$content = '<table>';
	$content .= '<tr>';
	$content .= '<th>'."NCLI".'</th>';
	$content .= '<th>'."ONSS".'</th>';
	$content .= '<th>'."NOM".'</th>';
	$content .= '<th>'."ADRESSE".'</th>';
	$content .= '<th>'."LOCALITE".'</th>';
	$content .= '<th>'."NEWS".'</th>';
	$content .= '<tr>';

	$donnees = $req->fetchAll();
	foreach($donnees as $donnee)
	{
	    $content .= '<tr>';
	    $content .= '<th>'.$donnee['NCLI'].'</th>';
	    $content .= '<th>'.$donnee['ONSS'].'</th>';
	    $content .= '<th>'.$donnee['NOM'].'</th>';
	    $content .= '<th>'.$donnee['ADRESSE'].'</th>';
	    $content .= '<th>'.$donnee['LOCALITE'].'</th>';
	    $content .= '<th>'.$donnee['NEWS'].'</th>';
	    $content .= '</tr>';
	}

	$content .= '</table>';
	$req->closeCursor();

	return $content;
}


?>
