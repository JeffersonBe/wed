@extends('app')

@section('content')
<div id="main" role="main">
		<h1>Inscrivez-vous au Wed Showtime !</h1>
		<button id="inscription">Inscrivez-vous !</button>
		<form id="resa" method="post" action="reservation.php">
				<p>
			  		<label for="prenom">Prénom
			  			<input type="text" value="" class="validate[required,custom[onlyLetterNumber]]" id="prenom "name="prenom" placeholder="Entrez votre prénom">
			  		</label>
			  	</p>
			  	<p>
				  	<label for="nom">Nom
				  		<input type="text" value="" class="validate[required,custom[onlyLetterNumber]]" id="nom" name="nom" placeholder="Entrez votre nom">
				  	</label>
			  	</p>
			  	<p>
			  		<label for="email">E-mail
			  			<input type="email" value="" class="validate[required,custom[email]]" id="email" name="email" placeholder="Votre adresse Telecom">
			  		</label>
			  	</p>
			  	<p>
				  	<label for="depart">Choix de départ</label>
				  		<select name="depart">
				  			<option>Evry</option>
				  			<option>Paris</option>
				  		</select>
				  	</label>
			  	</p>
			  	<p>
				  	<label for="alcool">Alcool
					  	<select name="alcool">
					  		<option>Vodka</option>
					  		<option>Rhum</option>
					  		<option>Whisky</option>
					  		<option>Pastis</option>
					  	</select>
				</label>
				</p>
				<p>
				  	<label for="tshirt">Votre t-shirt wed
					  	<select name="tshirt">
					  		<option>S</option>
					  		<option>M</option>
					  		<option>L</option>
					  		<option>XL</option>
					  	</select>
					</label>
				</p>
				<p>
				  	<label for="regime">Regime alimentaire
					  	<select name="regime">
					  		<option>Aucun</option>
					  		<option>Végétarien</option>
					  		<option>Halal</option>
					  		<option>Kasher</option>
					  	</select>
					</label>
				</p>
				<p>Inclure recaptcha</p>

</div><!-- fin de de main -->
@endsection
