<?php

include('clib/base.php');


var_dump(Get::argv('-f'));
die();

Route::add('main', function() {

	$arr = array(
		array('dasdas', 'das'),
		array('dads', 'dasdas'),
		array('ds', 'da'),
		);
	echo Draw::two_columns($arr, 3);

	$menu = array(
		'add' => 'Add item',
		'remove' => 'Remove item',
		'exit' => 'Exit Program'
	);
	echo Type::choice_char($menu);
	$route = Get::choice_char($menu, true);


	//echo $route;
	return Route::run($route);

});

Route::add('add', function() {

	echo "example add()\n";
	Typing::spin_type('sdf65f4sd56f45s6df456sdf
		sdf564sdf564sdf654sdf6
		56sd4f564sdf564s56df4
');
	return Route::run('main');

});

Route::add('remove', function() {

	$tb = Table::create();
	$tb->add_row('one', 'orange', 'be')
		->add_row(array('bananas','two', 'monkey'))
		->set_col_width(10, array(1, 3))
		->set_col_align('center', array(1, 3));
	echo $tb->generate();

	echo "example remove()\n";
	return Route::run('main');

});

Route::add('exit', function() {

	echo "hola!\n";
	exit;

});

//echo Route::lst();

Route::init('main');

?>