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
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/960.css" />

  <script src="js/libs/modernizr-2.5.3.min.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Norican' rel='stylesheet' type='text/css'>
</head>
<body>
  <div id="wrap">
	  <div id="main" role="main">
	  	<?php require_once('includes/recaptchalib.php');

$privatekey = "6LfZA9ISAAAAABMsn6ZZRLg977n8VBxaBrA0tqcG";
$resp = recaptcha_check_answer ($privatekey,
	$_SERVER["REMOTE_ADDR"],
	$_POST["recaptcha_challenge_field"],
	$_POST["recaptcha_response_field"]);

if (!$resp->is_valid) {
	// What happens when the CAPTCHA was entered incorrectly
	die ("<p class=\"error\">Le reCAPTCHA n'a pas été entré correctement. Retournez en essayez une seconde fois pour vous inscrire.</p>" .
		"(Votre erreur est: " . $resp->error . ")");
} else {
	// Your code here to handle a successful verification
	require('includes/connection.php');

	function mailValide($email)
	{

		$atom   = '[-a-z0-9!#$%&\'*+\\/=?^_`{|}~]';   // caractères autorisés avant l'arobase
		$domain = '([a-z0-9]([-a-z0-9]*[a-z0-9]+)?)'; // caractères autorisés après l'arobase (nom de domaine)

		$regex = '/^' . $atom . '+' .   // Une ou plusieurs fois les caractères autorisés avant l'arobase
		'(\.' . $atom . '+)*' .         // Suivis par zéro point ou plus
		// séparés par des caractères autorisés avant l'arobase
		'@' .                           // Suivis d'un arobase
		'(' . $domain . '{1,63}\.)+' .  // Suivis par 1 à 63 caractères autorisés pour le nom de domaine
		// séparés par des points
		$domain . '{2,63}$/i';          // Suivi de 2 à 63 caractères autorisés pour le nom de domaine

		// test de l'adresse e-mail
		if (preg_match($regex, $email)) {
			return true;
		} else {
			return false;
		}
	}

	// teste si un mail est en @telecom-sudparis.eu ou @telecom-em.eu ou @it-sudparis.eu
	function mailINT($mail)
	{
		$extensions_autorisees = array('telecom-sudparis.eu', 'telecom-em.eu', 'it-sudparis.eu');
		$separation = explode('@', $mail);
		$extension = $separation[1];
		if(in_array($extension, $extensions_autorisees))
			return true;
		else
			return false;
	}

	if(!mailValide($_POST['email']) or !mailINT($_POST['email'])){
		die("<p class=\"error\">Ce mail est invalide, merci d'utilise un mail au format telecom-em.eu ou it-sudparis.eu</p>" . "<br><a href='http://wed.showtime2012.fr'>Retour</a>");
	} else {
		$email= $_POST['email'];
	}

	$prenom = $_POST['prenom'];
	$nom = $_POST['nom'];
	$depart= $_POST['depart'];
	$alcool= $_POST['alcool'];
	$tshirt= $_POST['tshirt'];
	$regime = $_POST['regime'];

	// création de la clé de vérification
	$cle = md5(microtime(TRUE)*100000);

	try
	{
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe) or die('Il y a un problème de connexion à la base de données');
	}
	catch (Exception $e)
	{
		die('Erreur : ' . $e->getMessage());
	}

	$verif=$bdd->prepare('SELECT email, actif FROM reservation WHERE nom = :nom AND prenom = :prenom');

	$verif->execute(array(
			'prenom' => $prenom,
			'nom' => $nom
			));

	$row = $verif->fetch();

		if($email = $row){
			echo("<p class=\"error\">Vous vous êtes déjà inscrit<p>");
		}
		else // On ajoute l'utilisateur dans la BDD
	  		  {

					$req = $bdd->prepare("INSERT INTO reservation(cle, actif, prenom, nom, email, depart, alcool, tshirt, regime) VALUES(:cle, :actif, :prenom,:nom,:email,:depart,:alcool,:tshirt,:regime)");

					$req->execute(array(
							'cle' => $cle,
							'actif' => 0,
							'prenom' =>  $prenom,
							'nom' => $nom,
							'email' => $email,
							'depart' => $depart,
							'alcool' => $alcool,
							'tshirt' => $tshirt,
							'regime' => $regime
						));

					// Envoie de l'email
					$destinataire = $email;
					$sujet = "Activer votre inscription" ;
					$entete = "From: wed@showtime2012.com" ;

					// Le lien d'activation est composé du login(log) et de la clé(cle)
					$message = 'Merci de vous inscrire pour le WED Showtime,

					Pour activer votre inscription, veuillez cliquer sur le lien ci dessous
					ou copier/coller dans votre navigateur internet.

					http://wed.showtime2012.fr/validation.php?nom='.urlencode($nom).'&cle='.urlencode($cle).'

					---------------
					Ceci est un mail automatique, Merci de ne pas y répondre.';

					mail($destinataire, $sujet, $message, $entete) ; // Envoi du mail

				echo(
					"<p class=\"success\">Merci de vous êtes inscrit au WED Showtime, vous recevrez un mail de confirmation."."<br><a href='http://wed.showtime2012.fr'>Retour</a></p>"
				);
			} // fin de else
}// fin de else captcha
?>
	    </div><!-- fin de de main -->
  </div><!-- fin de wrap -->

	  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
	  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"></script>')</script>
	  <script src="js/plugins.js"></script>
	  <script src="js/script.js"></script>
	  <script src="js/libs/jquery.validate.js"></script>
	  <script src="js/libs/jquery.transit.js"></script>
	  <script>
	    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
	    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
	    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
	    s.parentNode.insertBefore(g,s)}(document,'script'));
	  </script>
</body>
</html>