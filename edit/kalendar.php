<?php
function nova_udalost(&$mysqli, $den, $mesic, $rok, $text) {
	if (trim($text) == "")
		return "Prázdné pole s textem.\n";
	if (!is_numeric($den) || $den < 1 || $den > 32)
		return "Den mimo rozsah.\n";
	if (!is_numeric($mesic) || $mesic < 1 || $mesic > 12)
		return "Měsíc mimo rozsah.\n";
	if (!is_numeric($rok) || $rok < date('Y'))
		return "Rok mimo rozsah nebo již uplynulý rok\n";
	if ($rok == date('Y') && $mesic < date('n'))
		return "Datum již bylo.\n";
	if ($rok == date('Y') && $mesic == date('n') && $den < date('j'))
		return "Datum již bylo.\n";

	// Input os ok, let save it to db.
	$sql = "INSERT INTO `kalendar` (`id` ,`den` ,`mesic` ,`rok` ,`text`)
		VALUES (NULL ,  '$den',  '$mesic',  '$rok',  '". htmlspecialchars(trim($text)) ."');";
	if ($mysqli->query($sql))
		return "Ok";
	else
		return "Selhání databáze.\n" . $mysqli->error;
}
function saveEchoPost($postIndex, $alternative = "") {
	if (isset($_POST[$postIndex])) {
		echo $_POST[$postIndex];
		return;
	}
	echo $alternative;
}
function saveEchoGet($postIndex) {
	if (isset($_GET[$postIndex]))
		echo $_GET[$postIndex];
}

///////////////////////////////////////////////////////////////////////////////////////////////
// INPUT
if (isset($_POST['novaUdalost'])) {
	$tmp = nova_udalost($mysqli, $_POST['den'], $_POST['mesic'], $_POST['rok'], $_POST['text']);
	if ($tmp == "Ok")
		$error .= "Uložena nová událost. \n";
	else
		$error .= "Událost nebyla uložena. $tmp\n";
	unset($tmp);
}

if (isset($_GET['remove'])) {
	// Mazani
	$res = $mysqli->query("DELETE FROM kalendar WHERE id = '".addslashes($_GET['remove']) ."';");
	if ($res)
		$error .= "Byla smazána jedna Událost.";
	else
		$error .= "Chyba při mazání Události. " . $mysqli->error;
}

?>

	<header>
		radim-keith.cz &gt; EDITACE &gt; Kalendář akcí
		<a  class="logout" href="?logout">odhlásit</a>
	</header>
	<div class="main">
		<?php if ($error != "") echo '<div class="notification">' .$error. '</div>'; ?>
		<?php include 'navigace.inc'; ?>
		<h1>Kalendář akcí</h1>

		<form method="post" action="index.php">
			<label>Den měsíc rok (například <?php echo date('j n Y');?>):</label>
				<input name="den" style="width:2em;" value="<?php saveEchoPost('den');?>" /> 
				<input name="mesic" style="width:2em;" value="<?php saveEchoPost('mesic');?>" /> 
				<input name="rok" style="width:3em;" value="<?php saveEchoPost('rok', date('Y'));?>" />
			<label>Popis události:</label>
				<textarea name="text"><?php saveEchoPost('text');?></textarea>
			<input name="novaUdalost" type="submit" value="Uložit událost" class="submit" />
		</form>
		<div class="udalosti">
<?php
$i = 0;
$before = 0;
$res = $mysqli->query("SELECT * FROM kalendar ORDER BY rok, mesic, den ASC LIMIT 0,100;");
while ($row = $res->fetch_array(MYSQL_BOTH))
{
	if ($i != 0 && $before != $row['mesic'])
		echo "<hr />\n";
	$i++;
	echo '<div class="udalost">' .
		'<a href="?remove='. $row['id'] . '" onclick="return confirm(\'Smazání je nevratné.\nPokračovat?\')">smazat</a>' .
		'<span class="datum">' . $row['den'] .'. ' . $row['mesic'] .'. ' . $row['rok']. '</span>' .
		'<span class="text">' .nl2br($row['text']) . "</span></div>\n";
	$before = $row['mesic'];
}
if ($i == 0) {
	echo "Kalendář akcí je prázdný.";
}

?>
		</div>
	</div>