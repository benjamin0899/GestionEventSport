<?php 
require("./fonctions.php");
$base=connectBase();

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
  
  <section id="liste_evenements"> 
	  <div>
		<h2 style="margin-top:20px;">Nos événements</h2>
			<p>Retrouvez nos événements organisés dans la région de Lille</p>
				<div>
				    <div>
				        <article>
				        <?php $Evenement=getEvenement($base);
				        foreach($Evenement as $event) { ?>
				        	<h3><a href="<?= $event["siteweb"]?>"><?=$event["nomevenement"]?></a></h3>
				        	<p><?= $event["infos"]?></p>
				        	<p><?= $event["dateev"]?></p>
				        <?php } ?>
					    </article>
				    </div>
				</div>
	</div>
  </section>
  
  <section id="inscription_evenement"> 
	 <h2 id="inscription">S'inscrire à un événement</h2>
	 <div class="row g-3">
	  <form action="inscription.php" method="POST">
	  	<?php
	  	$Evenement=getEvenement($base);
		foreach($Evenement as $event) {?>
			<input type="checkbox" name="<?=$event["idevenement"]?>" id="case" value="<?= $event["idevenement"] ?>"/><label for="case"> <?=$event["nomevenement"]?></label>
		<?php } ?>
	    <div class="col-md-6">
	    	<input style="margin:10px 0;" type="text" class="form-control" placeholder="Mon nom" name="lname" pattern="[a-zA-ZÀ-ÿ]{2,20}" required>
	    </div>
	    <div class="col-md-6">
	    	<input style="margin-bottom:10px;" type="text" class="form-control" placeholder="Mon prénom" name="fname" pattern="[a-zA-ZÀ-ÿ]{2,20}" required>
	    </div>
	    <div class="col-md-6">
	    	<input style="margin-bottom:10px;" type="email" class="form-control" placeholder="Mon email" name="email" pattern="[A-Za-z0-9](([_\.\-]?[a-zA-Z0-9]+)*)@([A-Za-z0-9]+)(([_\.\-]?[a-zA-Z0-9]+)*)\.([A-Za-z]{2,})" required>
	    </div>
	    <div style="margin-bottom:10px;" class="col-md-6">
		    <select class="form-select" name="choix_campus" required>
		      <option value="" disabled selected hidden>Mon campus</option>
		      <option value="1">Santé</option>
		      <option value="2">Cité Scientifique</option>
		      <option value="3">Moulins-Ronchin</option>
		      <option value="4">Flers-Château</option>
		      <option value="5">Pont-de-bois</option>
		      <option value="6">Roubaix-Tourcoing</option>
		      <option value="7">Lille</option>
		    </select>
		</div>
	    <div style="margin-bottom:10px;" class="col-md-6">
		    <select class="form-select" name="choix_asso" required>
		      <option value="" disabled selected hidden>Mon association</option>
		      <option value="1">ASP ULille</option>
		      <option value="2">ASE ULille</option>
		    </select>
		</div>
		<div class="col-md-6">	
	    	<input style="margin-bottom:10px;" type="submit" class="btn btn-primary" name="inscrire" value="S'inscrire"/>
	   	</div>
	  </form>
	</div>
	</section>
  <section id="statistiques"> 
	<h2>Les chiffres clés sur nos événements</h2>
	 <?php
	$a = etu($base);
	$b = prof($base);
	$c = total($base);
	?>
	<table>
		<thead>
			<tr>
				<th>Evénement</th>
				<th>Nombre d'inscrits</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $a as $s) 
			echo "<tr><td>".$s['nomevenement']."</td><td style='text-align:center'>".$s['nb']."</td></tr>";
			?>
		</tbody>
	</table>
	<table>
		<thead>
			<tr>
				<th>Evénement</th>
				<th>Nombre d'inscrits</th>
			</tr>
		</thead>
		<tbody>
			<?php
			foreach ($b as $d) 
			echo "<tr><td>".$d['nomevenement']."</td><td style='text-align:center'>".$d['nb']."</td></tr>";
			?>
		</tbody>
	</table>
	<table>
		<thead>
		<tr>
			<th>Evénement</th>
			<th>Nombre d'inscrits</th>
		</tr>
		</thead>
		<tbody>
			<?php
			foreach ( $c as $e) 
			echo "<tr><td>".$e['nomevenement']."</td><td style='text-align:center'>".$e['nb']."</td></tr>";
			?>
		</tbody>
	</table>
	</section>
</body>
</html>
