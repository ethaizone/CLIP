<?php

/**
 * PHP Argument Class
 *
 * @author Nimit Suwannagate <ethaizone@hotmail.com>
 * @package CLIP
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 * @version 1.0.0
 */
class Argv
{

	/**
	 * Get arguments from command-line. Return all arguments if you don't assign key option.
	 * @param  string $option Key option
	 * @return string          value of argument
	 */
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

	/**
	 * Check if option is in arguments?
	 * @param  string $option Option
	 * @return mixed         Key number in array of argument or FALSE
	 */
	public static function isset($option)
	{
		$key = array_search($option, $_SERVER['argv']);
		return !empty($key) ? $key : FALSE;
	}

?>