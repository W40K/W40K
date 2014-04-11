<?php

require_once("Block.class.php");

class Board {

	  /////////////////
	 // attributes  //
	/////////////////

	public static $verbose = false;

	private $_board;
	private $_width;
	private $_height;

	  /////////////////////////
	 // getter and setters  //
	/////////////////////////

	public function getWidth() { return $this->_width; }
	public function getHeight() { return $this->_height; }
	public function getBoard() { return $this->_board; }

	  ///////////////
	 // builtins  //
	///////////////
	
	public function __construct(array $kwargs) {

		// mandatory attributes, throw error if not exists //
		$this->_width = $kwargs["width"];
		$this->_height = $kwargs["height"];
		$this->__toString();
	}

	public function __destruct() {
		if (self::$verbose)
			echo "The board no more used !<br />";
	}

	public function __toString() {
		if (self::$verbose)
		{
			echo "<u>Attributes</u><br/>";
			print_r($this);
			echo "<br />";
			echo "<u>Methods</u><br/>";
			print_r(get_class_methods($this));
			echo "<br />";
		}
	}

	public function doc() {
		echo file_get_contents("Dice.doc.txt");
	}

	  //////////////
	 // methods  //
	//////////////

	public function initBoard() {
		for ($i = 0; $i < $this->getHeight(); $i++)
		{
			for ($j = 0; $j < $this->getWidth(); $j++)
			{
				$block = new Block(["object" => null]);
				$this->_board[$i][$j] = $block;
			}
		}
	}

	public function updateBoard($changes) {
		foreach ($changes as $change)
		{
			$x = $change["x"];
			$y = $change["y"];
			$object = $change["object"];
			$block = $this->_board[$y][$x];
			$block->setObject($object);
		}
	}

	public function toJson() {
		$str = json_encode($this->getBoard());
		return ($str);
	}

	}	//! end of Board.class.php //
?>
