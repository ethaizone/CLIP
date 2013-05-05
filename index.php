<?php

include('clip/base.php');


Route::add('main', function() {

	echo Write::number(50);

	$menu = array(
		'add' => 'Add item',
		'remove' => 'Remove item',
		'exit' => 'Exit Program'
	);
	echo Draw::box(Write::choiceChar($menu), 1);
	$route = Get::choiceChar($menu, true);

	//Example call route with parameter
	if($route == 'exit')
		return Route::run($route, array('Exit right now'));

	return Route::run($route);

});

Route::add('add', function() {

	echo Draw::box("example add()");
	Typing::spinType('Lorem ipsum dolor sit amet, consectetur', 0.03);
	return Route::run('add2');

});

Route::add('add2', function() {

	echo Draw::box("example add2()");

	$trace = debug_backtrace();
	print_r($trace);

	return Route::run('main');
});

Route::add('remove', function() {


	echo Draw::box("example remove()");

	$tb = Table::create();
	$tb->addRow('one', 'orange', 'be')
		->addRow(array('bananas','two', 'monkey'))
		->setColWidth(10, array(1, 3))
		->setColAlign('center', array(1))
		->setColAlign('right', array(3));
	echo $tb->generate();

	return Route::run('main');

});

Route::add('exit', function($text) {

	echo $text." - hola!\n";
	exit;

});

Route::init('main');

?>