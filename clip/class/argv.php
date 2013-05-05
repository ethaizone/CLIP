<?php

class Argv
{

	public static function get($option = FALSE)
	{
		$argv = $_SERVER['argv'];

		if($option !== FALSE)
		{
			$key = array_search($option, $argv);
			if(! empty($key))
			{
				if(! empty($argv[$key+1]) && ! preg_match('#^-#', $argv[$key+1]))
					return $argv[$key+1];
			}
			return FALSE;
		}

		array_shift($argv);
		return (array) $argv;
	}

	public static function has($option)
	{

	}

	public static function isset($option)
	{
		$key = array_search($option, $_SERVER['argv']);
		return !empty($key) ? $key : FALSE;
	}

?>