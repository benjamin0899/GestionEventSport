<?php
require("./fonctions.php");
$base=connectBase();
extract($_POST);
$email=$_POST["email"];
$idevenement=$_POST["idevenement"];
$goodies=$_POST["goodies_fourni"];
if(isset($_POST["goodies_fourni"])){
	$actualiser = "UPDATE inscription SET goodies_fourni = $goodies where refsportif='$email' and refevenement='$idevenement'";
	echo $actualiser;
	pg_query($base, $actualiser) or die('Erreur SQL !'.$actualiser.'<br>');
	echo "C'est noté, l'adhérent a bien reçu ses goodies";
}
else{
	echo "Erreur dans la validation de la fourniture des goodies. Veuillez réessayer";
}
?>