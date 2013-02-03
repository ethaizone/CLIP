<?php

class Get
{

	/**
	 * Get string from keyboard
	 * @return string Text from keyboard
	 */
	public static function text()
	{
		return trim(fgets(STDIN));
	}

	public static function argv($option = FALSE)
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
		return $argv;
	}

	public static function has_argv($option)
	{
		$key = array_search($option, $_SERVER['argv']);
		return !empty($key) ? $key : FALSE;
	}

	public static function choice_number($choice, $until = FALSE)
	{
		$max = count($choice);
		if($until !== FALSE)
		{
			while(true)
			{
				echo "Select whichs menu that you want.. (1-".$max.") ";
				$key = Static::text();
				//Number isn't in range.
				if(! is_numeric($key) || $key > $max || $key <= 0)
				{
					continue;
				}
				break;
			}
		} else {
			echo "Select whichs menu that you want.. (1-".$max.") ";
			$key = Static::text();
			//Number isn't in range.
			if(! is_numeric($key) || $key > $max || $key <= 0)
			{
				return FALSE;
			}
		}

		return static::key_from_number($choice, $key);
	}

	public static function choice_char($choice, $until = FALSE, $case_sensitive = FALSE)
	{
		$max = count($choice);
		$max_char = "A";
		for($i = 1; $i <$max; $i++)
		{
			$max_char++;
		}

		if($until !== FALSE)
		{
			while(true)
			{
				echo "Select whichs menu that you want.. (A-".$max_char.") ";
				$key = Static::text();
				if($case_sensitive == FALSE) $key = strtoupper($key);
				//Character isn't in range.
				if(! in_array($key, range('A', $max_char)))
				{
					continue;
				}
				break;
			}
		} else {
			echo "Select whichs menu that you want.. (A-".$max_char.") ";
			$key = Static::text();
			if($case_sensitive == FALSE) $key = strtoupper($key);
			//Character isn't in range.
			if(! in_array($key, range('A', $max_char)))
			{
				return FALSE;
			}

		}

		//Convert string to number
		$key = ord(strtolower($key)) - 96;

		return static::key_from_number($choice, $key);
	}

	/**
	 * Get index of array from number
	 * @param  array $array  Target array
	 * @param  integer $number Number
	 * @return integer         Number of index
	 */
	private static function key_from_number($array, $number)
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