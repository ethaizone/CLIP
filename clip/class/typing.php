<?php

/**
 * Typing text on screen for CLi programming
 *
 * @author Nimit Suwannagate <ethaizone@hotmail.com>
 * @package CLIP
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 * @version 1.0.0
 */
class Typing
{

	protected static $spin_num = 0;
	protected static $spin_phases = array("|", "/", "-", "\\");

	/**
	 * Render spin character
	 *
	 * @param  integer $time         Number of loop
	 * @param  float   $delay_in_sec Delay between loop
	 * @return string                Spin character
	 */
	public static function spin($time=1,$delay_in_sec=0.1)
	{
		if(! is_int($time)) $time = 1;
		if(! is_numeric($delay_in_sec)) $delay_in_sec = 0.1;
		$delay_in_sec *= 1000000;

		echo ' ';	// echo blank for place of spin emblem
		for($i=0; $i<$time;$i++) {
			if(static::$spin_num == 4) static::$spin_num = 0;
			echo chr(8).static::$spin_phases[static::$spin_num];
			static::$spin_num++;
			usleep($delay_in_sec);
		}
		echo chr(8).' '.chr(8);	//print blank in place of spin emblem
		return null;
	}

	/**
	 * Typing string with spin character
	 *
	 * @param  string $text         Text
	 * @param  float  $delay_in_sec Delay between loop
	 * @return string               Typing text
	 */
	public static function spinType($text, $delay_in_sec=0.05)
	{
		if(! is_numeric($delay_in_sec)) $delay_in_sec = 0.05;
		$text = str_replace("\r", "", $text);
		$arr = str_split($text);
		foreach($arr as $char)
		{
			echo $char;
			static::spin(2, $delay_in_sec);
		}
		return null;
	}

	/**
	 * Typing string with typewriter effect
	 *
	 * @param  string $text         Text
	 * @param  float  $delay_in_sec Delay between loop
	 * @return string               Typing text
	 */
	public static function typewriter($text, $delay_in_sec=0.1)
	{
		if(! is_numeric($delay_in_sec)) $delay_in_sec = 0.1;
		$delay_in_sec *= 1000000;

		$text = str_replace("\r", "", $text);
		$arr = str_split($text);

		foreach($arr as $char)
		{
			echo $char;
			if($char != "\n") {
				echo '_';
				if($char != " ")
					usleep($delay_in_sec);
				echo chr(8).' '.chr(8);
			}
		}
		return null;
	}

}

?>