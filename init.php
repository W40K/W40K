<?php

require_once("Classes/Fighter.class.php");
require_once("Classes/Obstacle.class.php");
require_once("Classes/Fleet.class.php");
require_once("Classes/Board.class.php");

session_start();

//Board::$verbose = true;
$board = new Board(["width" => 150, "height" => 100]);
$board->initBoard();

//Fleet::$verbose = true;
$myFleet = new Fleet(["name" => $_GET["faction1"], "owner" => $_GET["player1"]]);
$ennemyFleet = new Fleet(["name" => $_GET["faction2"], "owner" => $_GET["player2"]]);

//Fighter::$verbose = true;
$fighter1 = new Fighter(["name" => "Foo Fighter", "faction" => $myFleet,
	"x" => 0, "y" => 0, "owner" => "me", "sprite" => "fighter1.png"]);
$fighter2 = new Fighter(["name" => "Tiger Fighter", "faction" => $ennemyFleet,
	"x" => 149, "y" => 99, "owner" => "not me", "sprite" => "fighter2.png"]);

//Obstacle::$verbose = true;
$planet1 = new Obstacle(["name" => "Utopia", "x" => 10, "y" => 10, "sprite" => "planet1.png"]);
$planet2 = new Obstacle(["name" => "Beltegeuse", "x" => 30, "y" => 30, "sprite" => "planet2.png"]);

$board->updateBoard([
		["object" => $fighter1, "x" => $fighter1->getX(), "y" => $fighter1->getY()],
		["object" => $fighter2, "x" => $fighter2->getX(), "y" => $fighter2->getY()],
		["object" => $planet1, "x" => $planet1->getX(), "y" => $planet1->getY()],
		["object" => $planet2, "x" => $planet2->getX(), "y" => $planet2->getY()]
	]);
echo $board->toJson();

$_SESSION["board"] = $board;
$_SESSION["fighter1"] = $fighter1;
$_SESSION["fighter2"] = $fighter2;
$_SESSION["myFleet"] = $myFleet;
$_SESSION["ennemyFleet"] = $ennemyFleet;
?>
