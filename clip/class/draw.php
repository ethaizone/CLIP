<?php

/**
 * Draw string Class for command-line
 *
 * @author Nimit Suwannagate <ethaizone@hotmail.com>
 * @package CLIP
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 * @version 1.0.1
 */
class Draw
{

	/**
	 * Draw box cover string. (Support multi-line.)
	 * @param  string  $string Text
	 * @param  integer $space Number of blank space around text
	 * @param  string  $char   Character that want to be border.
	 * @return string          Text with a box
	 */
	public static function box($string, $space = 0, $char = "#")
	{
		if(! is_int($space)) $space = 0;

		$text = str_replace("\r", "", trim($string, "\n"));
		$lines = explode("\n", $text);

		$max_width = '';
		foreach ($lines as $line)
		{
			$max_width = strlen($line) > $max_width ? strlen($line) : $max_width;
		}

		$line_char = static::line($char, $max_width+2+($space*2))."\n";
		$line_space = '';
		for ($i=0; $i < $space; $i++) {
			$line_space .= $char.static::line(' ', $max_width+($space*2)).$char."\n";
		}

		$lines_text = '';
		foreach ($lines as $line)
		{
			$len = strlen($line);
			$lines_text .= $char.static::line(' ', $space).$line.static::line(' ', $space+($max_width-$len)).$char."\n";
		}

		return $line_char.$line_space.$lines_text.$line_space.$line_char;
	}

	/**
	 * Draw line with character and loop it.
	 * @param  string  $char Text or character that want to loop
	 * @param  integer $time Number of loop
	 * @return string        Text line rendered
	 */
	public static function line($char, $time=0)
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

	/**
	 * Render multi-line text with 2 columns format from Array.
	 * @param  array $arr   Array
	 * @param  integer $space Number of blank space between 2 columns
	 * @return string        Text rendered
	 */
	public static function twoColumns($arr, $space = 0)
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