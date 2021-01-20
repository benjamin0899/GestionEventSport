<?php
require("./fonctions.php");
require("./securiteSimple.php");
$base=connectBase();
extract($_POST);
$Evenement=getEvenementSportif($base, $user);
$idevenement = $_POST["idevenement"];
if(isset($_POST["idevenement"])){
	foreach($Evenement as $id){
		$email= $_POST["email"] ;
		$desinscription = "DELETE FROM inscription WHERE refsportif = '$email' and refevenement='$idevenement'";
pg_query($base, $desinscription) or die('Erreur SQL !'.$desinscription.'<br>');
	}
	echo "Votre desinscription a bien été prise en compte";
}
else{
	echo "Erreur lors de votre desinscription, veuillez réessayer";
}
?>