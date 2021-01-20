<?php
error_reporting(E_ALL);
ini_set('display_errors', 'On');

function connectBase(){
	$host = "serveur-etu.polytech-lille.fr";
	$base = "sportuniv";
	$user = "bgrollea";
	$password = "postgres";
	$base = pg_connect("host=$host dbname=$base user=$user password=$password")
	or die ('connexion impossible:' .pg_last_error());
	return $base;
}

function getEvenement($base){
	$requeteSQL="select * from evenementsportif order by dateev desc";
	$result=pg_query($base,$requeteSQL) or
	die ('Echec requete:' .pg_last_error());
	$ligne = pg_fetch_all($result);
	return $ligne;
}

function getVerifasso($base){
	$requeteSQL="select * from verifasso";
	$result=pg_query($base,$requeteSQL) or
	die ('Echec requete:' .pg_last_error());
	$ligne = pg_fetch_all($result);
	return $ligne;
}

function checkUserPass($base, $user, $pass){
	$requeteSQL2="select email, password from organisateur where email='$user' and password='$pass'";
	$result2=pg_query($base,$requeteSQL2) or
	die ('Echec requete:' .pg_last_error());
	if (pg_num_rows($result2)==0){
		$requeteSQL3="select email, password from sportif where email='$user' and password='$pass'";
		$result3=pg_query($base,$requeteSQL3) or
		die ('Echec requete:' .pg_last_error());
		if (pg_num_rows($result3)==0){
			return -1;
		}else return 1;
	}else return 1;
}


function checkOrganisateurExiste($base,$user, $pass) {
	$requeteSQL="select email, password from organisateur where email='$user' and password='$pass'";
	$resultat=pg_query($base,$requeteSQL)
	or die("Erreur SQL existence abonné !<br />$requeteSQL<br />") ;
	if (pg_num_rows($resultat)==0) return -1 ;
	$ligne=pg_fetch_assoc($resultat) ;
	return $ligne["email"] ;
}

function inscription($base,$user, $nab) {
	$requeteSQL="insert into inscription(nom, prenom, datedeb, datefin) values($nab,$ndvd,now(),null)" ;
	$result=pg_query($base,$requeteSQL) ;
	return pg_affected_rows($result) ;
}

function getInscrit ($base){
	$requeteSQL4="select  e.nomevenement, e.idevenement, s.nom, s.prenom, s.email, s.refcategorie, s.refsiteuniversitaire, s.etatmembre, v.libelle, i.goodies_fourni, a.libelle as nom_asso, u.nom as nom_campus
from evenementsportif e join inscription i on e.idevenement = i.refevenement
join sportif s on s.email = i.refsportif join assosportive a on a.idcategorie=s.refcategorie join siteuniversitaire u on u.idsite=s.refsiteuniversitaire join verifasso v on v.id=s.etatmembre  
group by e.idevenement,s.nom,s.prenom,  s.email, s.refcategorie, s.refsiteuniversitaire, s.etatmembre, v.id, i.goodies_fourni, a.libelle, u.nom order  by (dateev)desc";
	$result4=pg_query($base,$requeteSQL4) or
	die ('Echec requete:' .pg_last_error());
	$ligne = pg_fetch_all($result4);
	return $ligne;
}

function checkAbo ($base, $user, $pass){
	$requeteSQL4="select nomevenement,dateev,s.etatmembre,s.nom,s.prenom,s.email,v.libelle, s.refcategorie, s.refsiteuniversitaire, e.idevenement, a.libelle as nom_asso, u.nom as nom_campus
	from evenementsportif e join  inscription on refevenement=e.idevenement join sportif s on refsportif = s.email join verifasso v on s.etatmembre=v.id join assosportive a on a.idcategorie=s.refcategorie
	join siteuniversitaire u on u.idsite=s.refsiteuniversitaire
where s.email ='$user' and password='$pass'";
	$result4=pg_query($base,$requeteSQL4) or
	die ('Echec requete:' .pg_last_error());
	if (pg_num_rows($result4)>0) {
		$ligne = pg_fetch_all($result4);
		return $ligne;
	} else return -1 ;
}

function getEvenementSportif($base,$user){
	$requeteSQL11="select idevenement, nomevenement, infos, siteweb, dateev
	from evenementsportif e join inscription i on e.idevenement = i.refevenement  where i.refsportif='$user' order by dateev desc";
	$result11=pg_query($base,$requeteSQL11) or
	die ('Echec requete:' .pg_last_error());
	$ligne = pg_fetch_all($result11);
	return $ligne;
}


function etu($base){
	$requeteSQL="select nomevenement, count(refsportif) as nb from inscription i join evenementsportif e on i.refevenement = e.idevenement 
			join sportif s on i.refsportif=s.email where refcategorie = '2'  group by nomevenement;";
	$result=pg_query($base,$requeteSQL) or
	die ('Echec requete:' .pg_last_error());
	$ligne = pg_fetch_all($result);
	return $ligne;
}


function prof($base){
	$requeteSQL="select nomevenement, count(refsportif) as nb from inscription i join evenementsportif e on i.refevenement = e.idevenement 
			join sportif s on i.refsportif=s.email where refcategorie = '1'  group by nomevenement;";
	$result=pg_query($base,$requeteSQL) or
	die ('Echec requete:' .pg_last_error());
	$ligne = pg_fetch_all($result);
	return $ligne;
}

function total($base){
	$requeteSQL="select nomevenement, count(refsportif) as nb from inscription i join evenementsportif e on i.refevenement = e.idevenement join sportif s on i.refsportif=s.email group by nomevenement;";
	$result=pg_query($base,$requeteSQL) or
	die ('Echec requete:' .pg_last_error());
	$ligne = pg_fetch_all($result);
	return $ligne;
}


	

?>