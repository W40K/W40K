<?php

require_once("Fighter.class.php");
require_once("Obstacle.class.php");
require_once("Fleet.class.php");
require_once("Board.class.php");

//Board::$verbose = true;
$board = new Board(["width" => 150, "height" => 100]);
$board->initBoard();

//Fleet::$verbose = true;
$myFleet = new Fleet(["name" => "Ma super flotte", "owner" => "me"]);
$ennemyFleet = new Fleet(["name" => "Les méchants", "owner" => "me"]);
//Fighter::$verbose = true;
$ship = new Fighter(["name" => "Foo Fighter", "faction" => $myFleet,
	"x" => 0, "y" => 0, "owner" => "me", "sprite" => "fighter.png"]);
$ennemy = new Fighter(["name" => "Tiger Fighter", "faction" => $ennemyFleet,
	"x" => 10, "y" => 0, "owner" => "not me", "sprite" => "fighter.png"]);
$board->updateBoard([
		["object" => $ennemy, "x" => $ennemy->getX(), "y" => $ennemy->getY()],
		["object" => $ship, "x" => $ship->getX(), "y" => $ship->getY()]
	]);
$ship->moves("up", $board);
//$ship->fire("Mini-lasers", $board);
echo $board->toJson();
?>
