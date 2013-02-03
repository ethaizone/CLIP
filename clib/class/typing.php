<?php

class Typing
{
	protected static $spin_num = 0;
	protected static $spin_phases = array("|", "/", "-", "\\");

	public static function spin($time=1,$delay_in_sec=0.1)
	{
		if(! is_int($time)) $time = 1;
		if(! is_numeric($delay_in_sec)) $delay_in_sec = 0.1;
		$delay_in_sec *= 1000000;

		echo ' ';	// echo blank for place of spin emblem
		for($i=0; $i<$time;$i++)
		{
			if(static::$spin_num == 4) static::$spin_num = 0;
			echo chr(8).static::$spin_phases[static::$spin_num];
			static::$spin_num++;
			usleep($delay_in_sec);
		}
		echo chr(8).' '.chr(8);	//print blank in place of spin emblem
		return null;
	}

	public static function spin_type($text, $delay_in_sec=0.05)
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