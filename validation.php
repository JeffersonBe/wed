<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>WED 2012 by Showtime BDE 2012 | Merci d'avoir validé votre inscription</title>
  <meta name="description" content="">
  <meta name="keyword" content=""/>
  <meta name="viewport" content="width=device-width">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" type="text/css" media="all" href="css/960.css" />

  <script src="js/libs/modernizr-2.5.3.min.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Norican' rel='stylesheet' type='text/css'>
</head>
<body>
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <div id="wrap">
	  <div id="main" role="main">
	  		<?php

	  		require_once('includes/connection.php');

	  		// Récupération des variables nécessaires à l'activation
	  		$nom = $_GET['nom'];
	  		$cle = $_GET['cle'];

	  		try
	  			{
	  				$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	  				$bdd = new PDO('mysql:host='.$PARAM_hote.';port='.$PARAM_port.';dbname='.$PARAM_nom_bd, $PARAM_utilisateur, $PARAM_mot_passe) or die('Il y a un problème de connexion à la base de données');
	  			}
	  		catch (Exception $e)
	  			{
	  			        die('Erreur : ' . $e->getMessage());
	  			}

	  		// Récupération de la clé correspondant au $login dans la base de données
	  		$stmt = $bdd->prepare("SELECT cle,actif FROM reservation WHERE nom like :nom ");
	  		if($stmt->execute(array(':nom' => $nom)) && $row = $stmt->fetch())
	  		  {
	  		    $clebdd = $row['cle'];	// Récupération de la clé
	  		    $actif = $row['actif']; // $actif contiendra alors 0 ou 1
	  		  }

	  		// On teste la valeur de la variable $actif récupéré dans la BDD
	  		if($actif == '1') // Si le compte est déjà actif on prévient
	  		  {
	  		     echo "<p class=\"error\">Votre compte est déjà actif !</p>";
	  		  }
	  		else // Si ce n'est pas le cas on passe aux comparaisons
	  		  {
	  		     if($cle == $clebdd) // On compare nos deux clés
	  		       {
	  		          // Si elles correspondent on active le compte !
	  		          echo "<p class=\"success\">Votre compte a bien été activé !</p>";

	  		          // La requête qui va passer notre champ actif de 0 à 1
	  		          $stmt = $bdd->prepare("UPDATE reservation SET actif = 1 WHERE nom like :nom ");
	  		          $stmt->bindParam(':nom', $nom);
	  		          $stmt->execute();
	  		       }
	  		     else // Si les deux clés sont différentes on provoque une erreur...
	  		       {
	  		          echo "<p class=\"error\">Erreur ! Votre compte ne peut être activé...</p>";
	  		       }
	  		  }
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
