<?php
require_once('Fleet.class.php');
require_once('Ship.class.php');
require_once('FregateImperial.class.php');
require_once('RaiderIdolator.class.php');
require_once('Block.class.php');
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
	if ( $elem['race'] === 'chaos')
		$chaos_fleet->add($new_ship);
}

function getShip ($elem) {
	if ($elem['type'] === 'FregateImperial')
		return new FregateImperial($elem);
	if ($elem['type'] === 'RaiderIdolator')
		return new RaiderIdolator($elem);
}

$board = array();
$j = 0;
while ($j < 100)
{
	$board[$j] = array();
	$i = 0;
	while ($i < 150)
	{
		$board[$j][$i] = new Block(array(NULL, NULL));
		$i++;
	}
	$j++;
}

$board[0][0]->sprite = "http://www.objets-publicitaires-pro.com/images/objet-publicitaire/produit/large/canard-publicitaire-equitation-jaune.jpg";
$board[0][1]->sprite = "http://www.objets-publicitaires-pro.com/images/objet-publicitaire/produit/large/canard-publicitaire-equitation-jaune.jpg";
$board[0][2]->sprite = "http://www.objets-publicitaires-pro.com/images/objet-publicitaire/produit/large/canard-publicitaire-equitation-jaune.jpg";
$board[0][3]->sprite = "http://www.objets-publicitaires-pro.com/images/objet-publicitaire/produit/large/canard-publicitaire-equitation-jaune.jpg";
$board[0][0]->ship = $imperium_fleet->array_fleet[0];
$board[0][1]->ship = $imperium_fleet->array_fleet[0];
$board[0][2]->ship = $imperium_fleet->array_fleet[0];
$board[0][3]->ship = $imperium_fleet->array_fleet[0];


$board[99][146]->sprite = "http://lividao.unblog.fr/files/2010/03/jouetdesigncanardcroixrouge450.gif";
$board[99][147]->sprite = "http://lividao.unblog.fr/files/2010/03/jouetdesigncanardcroixrouge450.gif";
$board[99][148]->sprite = "http://lividao.unblog.fr/files/2010/03/jouetdesigncanardcroixrouge450.gif";
$board[99][149]->sprite = "http://lividao.unblog.fr/files/2010/03/jouetdesigncanardcroixrouge450.gif";
$board[99][146]->ship = $chaos_fleet->array_fleet[0];
$board[99][147]->ship = $chaos_fleet->array_fleet[0];
$board[99][148]->ship = $chaos_fleet->array_fleet[0];
$board[99][149]->ship = $chaos_fleet->array_fleet[0];

print(json_encode($board));

?>
