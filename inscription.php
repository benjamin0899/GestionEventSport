<?php
require("./fonctions.php");
$base=connectBase();
extract($_POST);
$Evenement=getEvenement($base);
$cpt=count($Evenement);
$evs=array() ;
foreach ($_POST as $index => $value) {
	if (is_numeric($index)) $evs[]=$index;
}
foreach ($evs as $ev){
		$email= $_POST["email"] ;
		$nom = $_POST["lname"] ;
		$prenom = $_POST["fname"] ;
		$choix_campus = $_POST["choix_campus"] ;
		$choix_asso = $_POST["choix_asso"] ;
		$inscription = "INSERT INTO inscription (refevenement, refsportif) VALUES ($ev, '$email')";
		pg_query($base, $inscription) or die('Erreur SQL !'.$inscription.'<br>');
		echo "Votre inscription a bien été prise en compte.";
}

?>