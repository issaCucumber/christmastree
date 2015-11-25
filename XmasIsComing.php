<?php

// LOGGING
require_once("/usr/share/php/Log.php");
ini_set('error_log', 'syslog');
$log = Log::singleton(
	'syslog'
, LOG_LOCAL0
, '/var/log/nginx/xmas_tree.log'
, array('lineFormat' => "[%{priority}] %{message} (%{file}, %{line})"
), PEAR_LOG_INFO);
openlog('/var/log/nginx/xmas_tree.log', LOG_NDELAY, LOG_LOCAL0);


include str_replace('//','/',dirname(__FILE__).'/')."class/ChristmasTree.inc.php";

$christmasTree = new ChristmasTree();

//put the star on the top of the tree
//1
$christmasTree->addNode(0);

//put something down the tree
//1 --> 2 and 1 --> 3
$christmasTree->addNode(1);
$christmasTree->addNode(1);

//2 --> 4 and 2 --> 5 and 2 --> 6 and 2 --> 7 and 3 --> 8
$christmasTree->addNode(2);
$christmasTree->addNode(2);
$christmasTree->addNode(2);
$christmasTree->addNode(2);
$christmasTree->addNode(3);

//5 --> 9 and 6 --> 10 and 6 --> 11 and 6 --> 12 and 6 --> 13 and 7 --> 14
$christmasTree->addNode(5);
$christmasTree->addNode(6);
$christmasTree->addNode(6);
$christmasTree->addNode(6);
$christmasTree->addNode(6);
$christmasTree->addNode(7);

//11 --> 15 and 11 --> 16 and 11 --> 17 and 11 --> 18 and 11 --> 19 and 11 --> 20
$christmasTree->addNode(11);
$christmasTree->addNode(11);
$christmasTree->addNode(11);
$christmasTree->addNode(11);
$christmasTree->addNode(11);
$christmasTree->addNode(11);

//$christmasTree->printTree();

//Test 1 : find the count at Level 3 from the star
echo "Count of nodes at level 3 from the star :: ".$christmasTree->countNodesAtLevel(1, 3)."\n";
echo "*************************************************\n";

//Test 2 : find the count at Level 3 from node 2
echo "Count of nodes at level 1 from node 2 :: ".$christmasTree->countNodesAtLevel(2, 1)."\n";
echo "*************************************************\n";

//Test 3 : find the count at Level 4 from the star
echo "Count of nodes at level 4 from the star :: ".$christmasTree->countNodesAtLevel(1, 4)."\n";
echo "*************************************************\n";

//Test 4 : find count for non- existing level
echo "Count of nodes at level 5 (not existing) from the star :: ".$christmasTree->countNodesAtLevel(1, 5)."\n";
echo "*************************************************\n";

?>