<?php
Class Fleet {
	public			$array_fleet = array();
	
	public function				add( Ship $new_ship) {
		$array_fleet[] = $new_ship;
	}
	public function				__toString() {
		foreach ($array_fleet as $key => $elem)
		{
			$str .= sprintf ("Ship number %d\n", $key);
			$str .= $elem();
		}
	}
}
?>
