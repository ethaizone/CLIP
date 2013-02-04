<?php

include('clip/base.php');


Route::add('main', function() {

	$menu = array(
		'add' => 'Add item',
		'remove' => 'Remove item',
		'exit' => 'Exit Program'
	);
	echo Draw::box(Type::choice_char($menu), 1);
	$route = Get::choice_char($menu, true);

	if($route == 'exit')
		return Route::run($route, array('Exit right now'));

	return Route::run($route);

});

Route::add('add', function() {

	echo Draw::box("example add()");
	Typing::spin_type('Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.', 0.03);
	return Route::run('main');

});

Route::add('remove', function() {


	echo Draw::box("example remove()");

	$tb = Table::create();
	$tb->add_row('one', 'orange', 'be')
		->add_row(array('bananas','two', 'monkey'))
		->set_col_width(10, array(1, 3))
		->set_col_align('center', array(1))
		->set_col_align('right', array(3));
	echo $tb->generate();

	return Route::run('main');

});

Route::add('exit', function($text) {

	echo $text." - hola!\n";
	exit;

});

Route::init('main');

?>