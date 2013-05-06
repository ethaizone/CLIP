<?php

/**
 * Draw string Class for command-line
 *
 * @author Nimit Suwannagate <ethaizone@hotmail.com>
 * @package CLIP
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 * @version 1.0.0
 */
class Get
{

	protected static $textChoice = 'Select which menu that you want..';

	/**
	 * Get string from keyboard
	 * @return string Text from keyboard
	 */
	public static function text()
	{
		return trim(fgets(STDIN));
	}


	/**
	 * Get number choice from keyboard
	 * @param  array  $choice Array of menu
	 * @param  boolean $until  Assign TRUE for loop until get correct choice
	 * @return integer          Choice number
	 */
	public static function choiceNumber($choice, $until = FALSE)
	{
		$max = count($choice);

		while(true)
		{
			echo static::$textChoice." (1-".$max.") : ";
			$key = Static::text();
			//Number isn't in range.
			if(! is_numeric($key) || $key > $max || $key <= 0)
			{
				if($until === FALSE)
					return FALSE;
				else
					continue;
			}
			break;
		}

		return (integer) static::keyFromNumber($choice, $key);
	}

	/**
	 * Get character choice from keyboard
	 * @param  array  $choice         Array of menu
	 * @param  boolean $until          Assign TRUE for loop until get correct choice
	 * @param  boolean $case_sensitive Assign TRUE for case sensitive
	 * @return string                  Choice character
	 */
	public static function choiceChar($choice, $until = FALSE, $case_sensitive = FALSE)
	{
		$max = count($choice);
		$max_char = "A";
		for($i = 1; $i <$max; $i++)
		{
			$max_char++;
		}

		while(true)
		{
			echo static::$textChoice." (A-".$max_char.") : ";
			$key = Static::text();
			if($case_sensitive == FALSE) $key = strtoupper($key);
			//Character isn't in range.
			if(! in_array($key, range('A', $max_char)))
			{
				if($until === FALSE)
					return FALSE;
				else
					continue;
			}
			break;
		}

		//Convert string to number
		$key = ord(strtolower($key)) - 96;

		return static::keyFromNumber($choice, $key);
	}

	/**
	 * Get index of array from number
	 * @param  array $array  Target array
	 * @param  integer $number Number
	 * @return integer         Number of index
	 */
	private static function keyFromNumber($array, $number)
	{
		//Return key of array as replacement of Number.
		for($i = 1; $i <$number; $i++)
		{
			next($array);
		}
		return key($array);
	}
}

?>