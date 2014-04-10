<?php
Class Fleet {
	public			$array_fleet = array();
	
	public function				add( Ship $new_ship) {
		$this->array_fleet[] = $new_ship;
	}
	public function				__toString() {
		$str = NULL;
		foreach ($this->array_fleet as $key => $elem)
		{
			$str .= sprintf ("Ship number %d\n", $key);
			$str .= sprintf("%s", $elem);
		}
		return ($str);
	}
}
?>
