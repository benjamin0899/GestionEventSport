	<?php 
		session_start();
		require("./fonctions.php");
		$base=connectBase() ;
		require("./securiteSimple.php");
	?>
	<!DOCTYPE html>
	<html>
	<head>
	  <meta charset="UTF-8">
	  <title>Evénements sportifs de l'Université de Lille</title>
	  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	  <link rel="stylesheet" href="./css/bootstrap.min.css" type="text/css"/>
	  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
	  <script type="text/javascript" src="./js/jquery-3.2.1.min.js"></script>
	  <script type="text/javascript" src="./js/bootstrap.min.js"></script>
	 
	</head>
	<body style="margin-left:20px">
	  <h2 style="margin-top:20px;">Menu</h2>
	  <ul class="nav nav-tabs">
	    <li class="nav-item "><a class="nav-link active" href="index.php">Les Evénements</a></li>
	    <li class="nav-item"><a class="nav-link" href="compte.php">Mon Compte</a></li>
	    <li class="nav-item"><a class="nav-link" href="organisateur.php">Organisateur</a></li>
	    
	  </ul>
	  
	  <?php
	   if (!checkUserPass($base,$user, $pass)){
	   	echo "Vous devez vous connecter pour accéder à cette page";
	   	exit;
	   }
	  ?>
	  <h2 style="margin-top:20px;">Mes événements</h2>
	  <?php
	  $abonne=checkAbo($base, $user, $pass);
	  if ($abonne != -1){
		  $Inscrit=getInscrit($base);
		  foreach($abonne as $inscrit){?>
		  		<h3 style="text-align:center;"><?=$inscrit["nomevenement"]?></h3>
				<table class="table table-hover">
		  			<thead>
		  				<tr>
		  					<th>Date de l'événement</th>
		  					<th>Nom</th>
		  					<th>Prénom</th>
		  					<th>Email</th>
		  					<th>Mon campus</th>
		  					<th>Mon association</th>
		  					<th></th>
		  					
		  				</tr>
		  			</thead>
		  			<tbody>
		  				<tr>					
			  				<td><?=$inscrit["dateev"]?></td>
			  				<td><?=$inscrit["nom"]?></td>
			  				<td><?=$inscrit["prenom"]?></td>
			  				<td><?=$inscrit["email"]?></td>
			  				<td><?=$inscrit["nom_campus"]?></td>
			  				<td><?=$inscrit["nom_asso"]?></td>
			  				<form action="desinscription.php" method="POST">
			  					<input type="hidden" class="form-control" name="email" value="<?=$inscrit["email"]?>" required>
			  					<input type="hidden" class="form-control" name="idevenement" value="<?=$inscrit["idevenement"]?>" required>
			  					<td><input type="submit" class="btn btn-danger" name="desinscrire" value="Supprimer ma participation"/></td>
			  				</form>
		  				</tr>
		  			</tbody>
		  		</table>
		    <?php }?>
		<?php }else echo "Vous êtes inscrit à aucun événement ou une erreur c'est produite";?>
	</body>
</html>