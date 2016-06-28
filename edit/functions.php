<?php
// REQUIRED settings.php
function connectDatabase()
{
	include("settings.php");

	// WEB
	//$mysqli = new mysqli($MYSQL_SETTINGS['host'], $MYSQL_SETTINGS['user'], $MYSQL_SETTINGS['password'], $MYSQL_SETTINGS['db']);
	
	if (!isset($mysqli) || $mysqli->connect_errno) {
		// Try Localhost
		$mysqli = new mysqli($MYSQL_SETTINGS_LOCAL['host'], $MYSQL_SETTINGS_LOCAL['user'], $MYSQL_SETTINGS_LOCAL['password'], $MYSQL_SETTINGS_LOCAL['db']);
	}

	if ($mysqli->connect_errno) {
    	printf("Connect failed: %s\n", $mysqli->connect_error);
	}
	$mysqli->query("SET NAMES utf8;");
	return $mysqli;
}

function loadStrings($mysqli) {
	$ret = array();
	$res = $mysqli->query("SELECT * FROM strings");
	while ($row = $res->fetch_array(MYSQL_BOTH))
	{
		$ret[$row['code']] = ["value" => $row['value'], "type" => $row['type']]; 
	}
	return $ret;
}


function loadPosts($mysqli, $limit=50) {
	$ret = array();
	$res = $mysqli->query("SELECT * FROM posts ORDER BY id DESC LIMIT 0,$limit");

	while ($row = $res->fetch_array(MYSQL_BOTH))
	{
		$ret[$row['id']] = ["date" => new DateTime($row['date']), "content" => $row['content']];
	}
	return $ret;
}
?>