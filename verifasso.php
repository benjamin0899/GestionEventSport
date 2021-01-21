<?php
require("./fonctions.php");
$base=connectBase();
extract($_POST);
$id=$_POST["id"];
$email=$_POST["email"];
if(isset($_POST["id"])){
	$actualiser = "UPDATE sportif SET etatmembre = $id where email='$email'";
	pg_query($base, $actualiser) or die('Erreur SQL !'.$actualiser.'<br>');
	echo "C'est noté. L'usager fait bien partie d'une association";
}
else {
	echo "Erreur. Veuillez réessayer";
}
?>