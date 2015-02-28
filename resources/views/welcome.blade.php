@extends('app')

@section('content')
<main id="main" class="col-md-4 col-md-offset-4" role="main">
	<?= Former::vertical_open()
		->id('wedForm')
		->secure()
		->rules(array(
		    'name'				=> 'required|max:15|alpha',
		    'email'					=> 'required|email',
			'password'				=> 'required|max:30',
		    'depart'				=> 'required',
		    'alcohol'				=> 'required',
		    't_shirt'				=> 'required',
			'diet'					=> 'required',
		    'g-recaptcha-response'  => 'required|recaptcha',
		))
		->withErrors()
		->setOption('live_validation', true)
		->method('POST') ?>

	<?= Former::text('name')
		->label("First Name")
		->placeholder("Enter you first name") ?>

	<?= Former::email('email')
		->label("Email")
		->placeholder("Enter you name") ?>

	<?= Former::password('password')
		->label("Password")
		->placeholder("Enter you password") ?>

	<hr>

	<?= Former::select('depart')
		->label("Chosse you departure")
		->options(array(
			'evry'	=> 'Evry',
			'paris'	=> 'Paris',
		)); ?>

	<?= Former::select('alcohol')
		->label("Alcool")
		->options(array(
			'name'  	=> 'None',
			'rhum'  	=> 'Rhum',
			'vodka'  	=> 'Vodka',
			'pastis'  	=> 'Pastis',
 		)); ?>

	<?= Former::select('t_shirt')
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

    {!! Recaptcha::render() !!}

	<?= Former::actions()
			->class('text-center')
			->large_primary_submit('Réservez votre voyage !')
		?>

	<?= Former::close() ?>
</main><!-- fin de de main -->
@endsection
