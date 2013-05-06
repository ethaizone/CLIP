<?php

include('clip/base.php');

$GLOBALS['item'] = array('1A - 5s4d56sd', '2B - as65da4c', '3C - 89w7ew7r', '4D - ufdsio78');

function breadcrumb()
{
	$fixedLenght = 25;

	$text = Route::breadcrumb();
	$lenght = strlen($text);
	$blankSpace = $fixedLenght-$lenght;
	echo Draw::box($text.Draw::line(' ', $blankSpace), 1);
}

Route::add('main', function() {

	breadcrumb();

	$menu = array(
		'add' => 'Add item',
		'remove' => 'Remove item',
		'view' => 'View items',
		'exit' => 'Exit Program'
	);
	echo Draw::box(Write::choiceChar($menu), 1);
	$route = Get::choiceChar($menu, true);

	//Example call route with parameter
	if($route == 'exit')
		return Route::run($route, array('Exit right now'));

	echo "\n\n\n";
	return Route::run($route, array(), TRUE);

});

Route::add('add', function() {

	breadcrumb();

	echo "Type text that you want to store: ";
	$text = Get::text();

	$GLOBALS['item'][] = $text;

	echo "\n\n";
	Typing::spinType("Text added into memory.\n");

	Route::pause();

	echo "\n\n\n";
	return Route::run('main');

}, 'Add item');

Route::add('remove', function() {

	breadcrumb();

	$columnArray = array();
	foreach($GLOBALS['item'] as $key => $value) {
		$columnArray[] = array(++$key.".", $value);
	}

	echo Draw::twoColumns($columnArray, 3)."\n\n";

	echo "Type key number that you want to delete: ";
	$number = Get::text();
	$number--;

	if(!empty($GLOBALS['item'][$number])) {
		unset($GLOBALS['item'][$number]);
		sort($GLOBALS['item']);
		echo "Item removed.\n";
	} else {
		echo "This item don't exist.\n";
	}

	Route::pause();

	echo "\n\n\n";
	return Route::run('main');

}, 'Remove item');

Route::add('view', function() {

	breadcrumb();

	echo "Data that stored in memory.\n";

	$tb = Table::create();
	$tb->addRow(array("KEY INDEX", "DATA"));
	foreach($GLOBALS['item'] as $key => $value) {
		$tb->addRow(array(Write::number(++$key, 2),$value));
	}
	$tb->setColWidth(9, array(1, 2))
		->setColWidth(18, array(2))
		->setColAlign('center', array(1))
		->setColAlign('right', array(2));
	echo $tb->render();
	echo "\n\n";

	Route::pause();
	echo "\n\n\n";
	return Route::run('main');

}, 'View items');

Route::add('exit', function($text) {

	echo $text." - hola!\n";
	exit;

});

//Start main process
Route::init('main');

?>