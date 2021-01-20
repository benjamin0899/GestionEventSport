<?php
require("./fonctions.php");
$base=connectBase();
extract($_POST);
$nomevenement= $_POST["nomevenement"] ;
if(isset($_POST["nomevenement"])){
	$idevenement = $_POST["idevenement"] ;
	$dateev = $_POST["dateev"] ;
	$siteweb = $_POST["siteweb"] ;
	$infos = $_POST["infos"] ;
	$goodies = $_POST["goodies"] ;
	$creer_eve = "INSERT INTO evenementsportif (idevenement, nomevenement, dateev, siteweb, infos, goodies) VALUES ($idevenement, '$nomevenement', '$dateev', '$siteweb', '$infos', $goodies)";
	pg_query($base, $creer_eve) or die('Erreur SQL !'.$creer_eve.'<br>');
	echo "L'événement a bien été créé";
}
else{
	echo "Echec lors de la création de l'événement";
}
?>