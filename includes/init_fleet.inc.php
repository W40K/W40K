<?php
require_once('Fleet.class.php');
require_once('Ship.class.php');
require_once('FregateImperial.class.php');
require_once('RaiderIdolator.class.php');
include("connect.inc.php");
$sql = "SELECT * FROM ships";
$result = mysqli_query($mysqli, $sql);
$array = array();
while ($tmp = mysqli_fetch_array($result, MYSQLI_ASSOC))
	$array[] = $tmp;
$imperium_fleet = new Fleet('imperium');
$chaos_fleet = new Fleet('chaos');
foreach ($array as $key => $elem)
{
	$new_ship = getShip($elem);
	if ( $elem['race'] === 'imperium')
		$imperium_fleet->add($new_ship);
}
print ($imperium_fleet);
function getShip ($elem) {
	if ($elem['type'] === 'FregateImperial')
		return new FregateImperial($elem);
	if ($elem['type'] === 'RaiderIdolator')
		return new RaiderIdolator($elem);
}
?>
