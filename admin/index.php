<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>WED 2012 by Showtime BDE 2012 | Module de réservation</title>
  <meta name="description" content="Page de réservation de week-end de désintégration organisée par le BDE Showtime 2012 de TMSP">
  <meta name="keyword" content="Telecom, TMSP, Sudparis, BDE, bureau, Showtime, Evry, WED, Etudiants"/>
  <meta name="viewport" content="width=device-width">

<style type="text/css" media="screen">
	#wrap {
		width: 100%;
		background-color: #f8f8f7;
	}

	h1 {
		text-align: center;
	}

	.liste {
	background-color: #c2b1b1;
	width: 30	%;
	margin: 10px auto;
	}

	.liste span {
		font-size: 1.4em;
	}

</style>
</head>
<body>
  <div id="wrap">
  	<h1>Interface de Gestion - Wed Showtime 2012</h1>
<?php
	$PARAM_hote='db412966127.db.1and1.com'; // le chemin vers le serveur
	$PARAM_port='3306';
	$PARAM_nom_bd='db412966127'; // le nom de votre base de données
	$PARAM_utilisateur='dbo412966127'; // nom d'utilisateur pour se connecter
	$PARAM_mot_passe='972showtime972'; // mot de passe de l'utilisateur pour se connecter

try
{
	$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	$connexion = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe);
}
catch (Exception $e)
{
        die('Erreur : ' . $e->getMessage());
}

$req = $connexion->query("SELECT * FROM reservation");

while ($res = $req->fetch())
{
?>
<div class="liste">
	<ul>
		<li>Validation:
			<?php
				if(($res['actif']) == '1'){
					echo 'Validé';
				}
				else {
					echo 'Pas validé';
				}
			?>
		<li>Prénom et nom: <span><?php echo $res['prenom']; ?> - <?php echo $res['nom']; ?></span></li>
		<li>Adresse email: <?php echo $res['email']; ?></li>
		<li>Départ: <?php echo $res['depart']; ?></li>
		<li>Alcool / Tshirt / Régime alimentaire: <?php echo $res['alcool']; ?> / <?php echo $res['tshirt']; ?> / <?php echo $res['regime']; ?></li>
	</ul>
</div>
<?php
}

$req->closeCursor();
?>
  </div><!-- fin de wrap -->
</body>
</html>