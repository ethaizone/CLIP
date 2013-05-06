<?php

/**
 * Writing on screen for CLi programming
 *
 * @author Nimit Suwannagate <ethaizone@hotmail.com>
 * @package CLIP
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License
 * @version 1.0.0
 */
class Write {


	/**
	 * Write choice menu. (Number type)
	 *
	 * @param  array $list Array of menu
	 * @return string       Text menu
	 */
	public static function choiceNumber($list)
	{
		$text = '';
		$number = 1;
		foreach ($list as $value) {
			$text .= $number.". ".$value."\n";
			$number++;
		}
		return $text;
	}

	/**
	 * Write choice menu. (Character type)
	 *
	 * @param  array $list Array of menu
	 * @return string       Text menu
	 */
	public static function choiceChar($list)
	{
		$text = '';
		$char = 'A';
		foreach ($list as $value) {
			$text .= $char.". ".$value."\n";
			$char++;
		}
		return $text;
	}

	/**
	 * Write number with zero before. Use for number with fixed lenght.
	 *
	 * @param  integer  $number Number
	 * @param  integer $length Lenght of number
	 * @return string          Number
	 */
	public static function number($number, $length=0)
	{
		return sprintf('%0'.$length.'d', $number);
	}

	/**
	 * Write multi-line text with space indent
	 *
	 * @param  string $text Text
	 * @param  integer $indent Lenght of indent
	 * @return string         Text
	 */
	public static function indent($text, $indent)
	{
		$text = $indent.trim($text);
		return str_replace("\n", "\n".$indent, $text)."\n";
	}

	/**
	 * Write breancrumb manually.
	 *
	 * @param  string $text Intitial text to merge
	 * @param  string $text Next text to merge ...
	 * @return [type] [description]
	 */
	public static function breadcrumb()
	{
		$breadcrumb = implode(' -> ', func_get_args());
		return box($breadcrumb);
	}

}

?>