@extends('app')

@section('content')
<main id="main" class="col-md-4 col-md-offset-4" role="main">
	<?= Former::vertical_open()
		->id('wedForm')
		->secure()
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
			    1  => 'Evry',
			    2  => 'Paris',
		)); ?>

	<?= Former::select('alcool')
		->label("Alcool")
		->options(array(
			1  => 'None',
			2  => 'Rhum',
			3  => 'Rhum',
			4  => 'Pastis',
			5  => 'None',
 		)); ?>

	<?= Former::select('tshirt')
		->label("Choose the size of your t-shirt")
		->options(array(
			1  => 'S',
			2  => 'M',
			3  => 'L',
			4  => 'XL',
		)); ?>

	<?= Former::select('diet')
		->label("Choose your diet")
		->options(array(
			1  => 'Normal',
			2  => 'Vegean',
			3  => 'Halal',
			4  => 'Kasher',
		)); ?>

	{!! app('captcha')->display() !!}

	<?= Former::actions()
  			->class('text-center')
  			->large_primary_submit('Réservez votre voyage !')
			?>

	<?= Former::close() ?>
</main><!-- fin de de main -->
@endsection
