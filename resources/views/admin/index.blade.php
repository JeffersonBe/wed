@extends('app')

@section('content')
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
@endsection
