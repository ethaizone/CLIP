<?php

class Draw
{
	public static function box($string, $char = "#", $border = 0)
	{
		if(! is_int($border)) $border = 0;
		$len = strlen($string);
		$line = static::line($char, $len+2+($border*2))."\n";
		$line_space = '';
		for ($i=0; $i < 1; $i++) {
			$line_space .= $char.static::line(' ', $len+($border*2)).$char."\n";
		}

		return $line.$line_space.
		$char.static::line(' ', $border).$string.static::line(' ', $border).$char."\n"
		.$line_space.$line;
	}

	public static function line($char="", $time=0)
	{
		if(! is_numeric($time)) $time = 0;
		if($time > 0)
		{
			$res = '';
			for($i=0; $i<floor($time);$i++)
			{
				$res .= $char;
			}
			return $res;
		}
		return null;
	}

	public static function two_columns($arr, $space)
	{
		$str = "";
		$max_left = 0;
		$max_right = 0;
		foreach($arr as $k => $text)
		{
			$left = strlen($text[0]);
			$max_left = $left > $max_left ? $left : $max_left;
			$right = strlen($text[1]);
			$max_right = $right > $max_right ? $right : $max_right;
		}


		foreach($arr as $k => $text)
		{
			$str .= $text[0].static::line(" ", ($max_left-strlen($text[0])+$space))
				.static::line(" ", ($max_right-strlen($text[1]))).$text[1]."\n";
		}
		return $str;
	}

}

?>