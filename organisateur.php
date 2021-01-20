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
   if (checkOrganisateurExiste($base,$user, $pass)==-1){
   	echo "Vous devez être organisateur pour accéder à cette page";
   	exit;
   }
  ?>
  <!-- Créer un événement -->
  <h2 style="margin-top:20px;">Créer un événement</h2>
 <div class="row g-3">
  <form action="ajout_eve.php" method="POST">
  	<div class="col-md-6">
    	<input style="margin-bottom:10px;" type="text" class="form-control" placeholder="ID de l'évenement" name="idevenement" required>
    </div>
    <div class="col-md-6">
    	<input style="margin-bottom:10px;" type="text" class="form-control" placeholder="Nom de l'évenement" name="nomevenement" required>
    </div>
    <div class="col-md-6">
    	<input style="margin-bottom:10px;" type="date" class="form-control" placeholder="Date de l'événement" name="dateev" required>
    </div>
    <div class="col-md-6">
    	<input style="margin-bottom:10px;" type="text" class="form-control" placeholder="Lien vers la page de l'événement" name="siteweb" required>
    </div>
    <div class="col-md-6">
		<textarea style="margin-bottom:10px;" name="infos" class="form-control" placeholder="Informations sur l'événement" cols="30" rows="5" required></textarea>
	</div>
    <div style="margin-bottom:10px;" class="col-md-6">
	    <select class="form-select" name="goodies" required>
	      <option value="false" selected>Non</option>
	      <option value="true">Oui</option>
	    </select>
	</div>
	<div style="margin-bottom:30px;" class="col-md-6">
    	<input type="submit" class="btn btn-primary" name="inscrire" value="Créer l'évenement"/>
    </div>
  </form>
</div>

  <?php
  //Gestion des inscriptions
  	$Evenement=getEvenement($base);
  	$Inscrit=getInscrit($base);
  	$Verifasso=getVerifasso($base);?>
  	<h2>Gérer les inscriptions</h2>
	<?php foreach($Inscrit as $inscrit){?>		
		<h4 style="text-align:center;"><?=$inscrit["nomevenement"]?></h4>
		<table class="table table-hover">
			<thead>
				<tr>
					<th>Nom</th>
					<th>Prénom</th>
					<th>Adresse mail</th>
					<th>Campus</th>
					<th>Association</th>
					<th>Validation Association</th>
					<th></th>
					<th>Validation Goodies</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
			<tr>					
				<td><?=$inscrit["nom"]?></td>
				<td><?=$inscrit["prenom"]?></td>
				<td><?=$inscrit["email"]?></td>
				<td><?=$inscrit["nom_campus"]?></td>
				<td><?=$inscrit["nom_asso"]?></td>
				<?php if($inscrit["etatmembre"]!='1'){?>
				<td><?=$inscrit["libelle"]?></td>
				<?php } else{ ?>
				<form action="verifasso.php" method="POST">
				<td>
					<div class="col-md-6">
					<input type="hidden" class="form-control" name="email" value="<?=$inscrit["email"]?>" required>
	    				<select class="form-select" name="id" required>
	    					 <?php foreach($Verifasso as $etatmembre){?>
	    						<option value="<?=$etatmembre["id"]?>"><?=$etatmembre["libelle"]?></option>
	    					<?php }?>
	    				</select>
					</div>
				</td>
				<?php }?>
				<td><input type="submit" class="btn btn-primary" name="validerAsso" value="Valider Association"/></td>
				</form>
				<?php if($inscrit["etatmembre"]=='1' || $inscrit["etatmembre"]=='3' || $inscrit["goodies_fourni"]=='t'){?>
				<td><?=$inscrit["goodies_fourni"]?></td>
				<?php } else{ ?>
				<form action="validgoodies.php" method="POST">
				<td>
					<div class="col-md-6">
					<input type="hidden" class="form-control" name="email" value="<?=$inscrit["email"]?>" required>
					<input type="hidden" class="form-control" name="idevenement" value="<?=$inscrit["idevenement"]?>" required>
	    				<select class="form-select" name="goodies_fourni" required>
	    					<option value="false">Faux</option>
	    					<option value="true">Vrai</option>
	    				</select>
					</div>
				</td>
				<?php }?>
				<td><input type="submit" class="btn btn-primary" name="validerGoodies" value="Valider Goodies"/></td>
				</form>
			</tr>
			</tbody>
		</table>
  <?php } ?>
  
  
  
 
  
  
 


</body>
</html>