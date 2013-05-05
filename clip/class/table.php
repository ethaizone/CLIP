<?php

class Table
{

	private $table = array();
	private $format = array();

	public static function create()
	{
		$obj = new static();
		return $obj;
	}

	public function addRow($row_array)
	{
		if(is_array($row_array))
			$this->table[] = $row_array;
		else
			$this->table[] = func_get_args();

		return $this;
	}

	public function setColWidth($width, $col_array)
	{
		foreach($col_array as $col)
		{
			$this->format[$col]['width'] = $width;
		}
		return $this;
	}

	public function setColAlign($align, $col_array)
	{
		foreach($col_array as $col)
		{
			$this->format[$col]['align'] = $align;
		}
		return $this;
	}

	public function generate()
	{
		//Get max lengths of character
		$column_width = array();
		foreach ($this->table as $row)
		{
			foreach ($row as $col => $cell)
			{
				$len = strlen($cell);
				@$column_width[$col] = $len > $column_width[$col] ? $len : $column_width[$col];
			}
		}

		//Put max width to $column_width
		foreach ($column_width as $col => $width)
		{
			@$column_width[$col] = $this->format[$col+1]['width'] > $column_width[$col] ? $this->format[$col+1]['width'] : $column_width[$col];
		}

		$col_number = count($column_width);

		//Create line for put between rows
		$line = '+';
		for ($col=0; $col < $col_number; $col++)
		{
			$line .= Draw::line('-', $column_width[$col]).'+';
		}

		//Generate Table
		$data = $line."\n";
		foreach ($this->table as $row)
		{
			//Generate Row
			$data .= '|';
			foreach ($row as $col => $cell)
			{
				$text = '';
				$length = strlen($cell);
				$diff = ($column_width[$col] - $length);

				//Set alighment to each cell
				if(!empty($this->format[$col+1]['align']))
				{
					$alignment = $this->format[$col+1]['align'];
					if(in_array($alignment, array('center', 'right')))
					{
						if($alignment == 'center')
						{
							$text = Draw::line(' ', $diff/2).$cell.Draw::line(' ', ($diff/2)+($diff%2));
						} else if($alignment == 'right')
						{
							$text = Draw::line(' ', $diff).$cell;
						}
					}
				}

				//Create text for left alignment (default)
				if(empty($text)) $text = $cell.Draw::line(' ', $diff);

				$data .= $text.'|';
			}
			$data .= "\n".$line."\n";
		}
		return $data;
	}

}

?>