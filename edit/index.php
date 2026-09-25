<?php
// REQUIRED settings.php functions.php
// vlozeni nastaveni hesel a jinych tajnych hodnot
include_once('settings.php');

// vlozeni pridavnych funkci, jako je pripojeni databaze
include_once ('functions.php');

$error = "";
$editacePovolena = false;
if (isset($_POST['password']) && in_array($_POST['password'], $PASSWORDS)) {
	setcookie("editace", $COOKIE_SECRET);
	$error .= "Přihlášení úspěšné.\n";
	$editacePovolena = true;
}
if ($editacePovolena == false) {
	if (isset($_GET['logout']) || !isset($_COOKIE['editace']) || $_COOKIE['editace'] != $COOKIE_SECRET)
	{
		include("loginForm.php");
		exit();
	}
}
else
	$editacePovolena = true;

// stranka
if (isset($_GET['str'])) {
	$tmp = $_GET['str'];
}
else if (isset($_COOKIE['editace_str'])) {
	$tmp = $_COOKIE['editace_str'];
}
else {
	$tmp = 'kniha_navstev';
}

switch ($tmp)
{
	case 'slajdy':
		$page = 'slajdy';
		setcookie('editace_str',  'slajdy');
		break;
	case 'prispevky':
		$page = 'prispevky';
		setcookie('editace_str',  'prispevky');
		break;
	case 'objednavky':
		$page = 'objednavky';
		setcookie('editace_str',  'objednavky');
		break;
	default:
		$page = 'prispevky';
		setcookie('editace_str',  'prispevky');
		break;
}
unset($tmp);





$mysqli = connectDatabase();
$post = (!empty($_POST)) ? true : false;

?><!DOCTYPE html>
<html lang="cs">
<head>
	<title>Editace dvojcatanauteku.cz</title>
<meta charset="utf-8" />

<style>
	body, html {padding: 0 0 0 0; margin: 0 0 0 0;}
	header {background-color: #F49; color:white; padding: 5px 5px 5px 5px; font-family: sans-serif; font-weight: lighter; letter-spacing: 2px;}
	header .logout {float:right; color:white;}
	.main {padding: 5px 5px 5px 5px; width: 100%; max-width: 800px; margin: auto auto; font-family: 'Calibri', sans-serif;}
	.navigation {border-bottom: 1px solid silver;}
	.notification {border-bottom: 1px solid silver; background-color: #FFD;}
	.udalosti {margin-top: 40px; padding: 10px 10px 10px 10px; box-shadow: silver 0px 5px 20px; border-radius: 3px;}
	label {display: block;}
	textarea {width: 100%; display: block;}
	form .submit {float: right;}
	table {width: 100%; margin: auto auto; border:1px solid silver; border-collapse: collapse;}
	table thead {background-color: #FDE; border-bottom: 3px double silver;}
	table th, table td { border: 1px solid silver }
	.btn {border:1px solid #555; box-shadow: 1px 1px 2px #AAA,inset 0px 2px 2px white,inset -1px -1px 2px #ccc; padding: 5px 7px; margin-bottom: 5px; border-radius: 5px; color: #333; text-decoration: none; background-color: #EEE; display: inline-block;}
	.btn:hover {box-shadow: inset 0px 2px 2px silver; color: black;}
	.btn-danger {border:1px solid #F55; box-shadow: 1px 1px 2px #AAA,inset 0px 2px 2px #C33,inset -1px -1px 2px #Fcc; padding: 5px 7px; margin-bottom: 5px; border-radius: 5px; color: #F33; text-decoration: none; background-color: #FDD; display: inline-block;}
	.float-right {float: right}
</style>



</head>
<body>
<?php include($page . '.php'); ?>
</body>
</html>