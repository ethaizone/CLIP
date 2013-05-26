<?php

//Autoload
function __autoload ($class_name) {
	$file = __DIR__.'/class/'.strtolower($class_name).'.php';
	require_once($file);
}

?>