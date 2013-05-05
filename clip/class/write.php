<?php

class Write {


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

	public static function number($number, $length=0)
	{
		return sprintf('%0'.$length.'d', $number);
	}

	public static function indent($string, $indent)
	{
		$string = $indent.trim($string);
		return str_replace("\n", "\n".$indent, $string)."\n";
	}

	public static function breadcrumb()
	{
		$breadcrumb = implode(' -> ', func_get_args());
		return box($breadcrumb);
	}

}

?>