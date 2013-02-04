<?php

class Draw
{
	public static function box($string, $border = 0, $char = "#")
	{
		if(! is_int($border)) $border = 0;

		$text = str_replace("\r", "", trim($string));
		$lines = explode("\n", $text);

		$max_width = '';
		foreach ($lines as $line)
		{
			$max_width = strlen($line) > $max_width ? strlen($line) : $max_width;
		}

		$line_char = static::line($char, $max_width+2+($border*2))."\n";
		$line_space = '';
		for ($i=0; $i < $border; $i++) {
			$line_space .= $char.static::line(' ', $max_width+($border*2)).$char."\n";
		}

		$lines_text = '';
		foreach ($lines as $line)
		{
			$len = strlen($line);
			$lines_text .= $char.static::line(' ', $border).$line.static::line(' ', $border+($max_width-$len)).$char."\n";
		}

		return $line_char.$line_space.$lines_text.$line_space.$line_char;
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