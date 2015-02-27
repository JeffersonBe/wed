@extends('app')

@section('content')
<main id="main" class="col-md-4 col-md-offset-4" role="main">
	<?= Former::vertical_open()
		->id('wedForm')
		->secure()
		->rules(array(
		    'firstName'				=> 'required|max:15|alpha',
		    'lastName'				=> 'required|max:15|alpha',
		    'email'					=> 'required|email',
		    'departs'				=> 'required',
		    'alcool'				=> 'required',
		    'tshirt'				=> 'required',
			'diet'					=> 'required',
		    'g-recaptcha-response'  => 'required|recaptcha',
		))
		->withErrors()
		->setOption('live_validation', true)
		->method('POST') ?>

	<?= Former::text('firstName')
		->label("First name")
		->placeholder("Enter you name") ?>

	<?= Former::text('lastName')
		->label("Last name")
		->placeholder("Enter you name") ?>

	<?= Former::email('email')
		->label("Email")
		->placeholder("Enter you name") ?>

	<?= Former::select('departs')
		->label("Chosse you departure")
		->options(array(
			'evry'	=> 'Evry',
			'paris'	=> 'Paris',
		)); ?>

	<?= Former::select('alcool')
		->label("Alcool")
		->options(array(
			'name'  	=> 'None',
			'rhum'  	=> 'Rhum',
			'vodka'  	=> 'Vodka',
			'pastis'  	=> 'Pastis',
 		)); ?>

	<?= Former::select('tshirt')
		->label("Choose the size of your t-shirt")
		->options(array(
			's'  	=> 'S',
			'm'  	=> 'M',
			'l'  	=> 'L',
			'xl'  	=> 'XL',
		)); ?>

	<?= Former::select('diet')
		->label("Choose your diet")
		->options(array(
			'normal'  	=> 'Normal',
			'vegean'  	=> 'Vegean',
			'halal'  	=> 'Halal',
			'kasher'  	=> 'Kasher',
		)); ?>

	{!! app('captcha')->display() !!}

	<?= Former::actions()
			->class('text-center')
			->large_primary_submit('Réservez votre voyage !')
		?>

	<?= Former::close() ?>
</main><!-- fin de de main -->
@endsection
