<?php
if (isset($_GET['remove'])) {
	// Mazani
	$res = $mysqli->query("DELETE FROM KnihaNavstev WHERE id = '".addslashes($_GET['remove']) ."';");
	if ($res)
		$error .= "Byl smazán jeden vzkaz z Knihy návštěv.";
	else
		$error .= "Chyba při mazání vzkazu. " . $mysqli->error;
}
?>
	<header>
		radim-keith.cz &gt; EDITACE &gt; Kniha návštěv
		<a  class="logout" href="?logout">odhlásit</a>
	</header>
	<div class="main">
		<?php if ($error != "") echo '<div class="notification">' .$error. '</div>'; ?>
		<?php include 'navigace.inc'; ?>

		<h1>Mazání z Knihy návštěv</h1>
<?php
$i = 0;
$res = $mysqli->query("SELECT * FROM KnihaNavstev ORDER BY id DESC LIMIT 0,50;");
while ($row = $res->fetch_array(MYSQL_BOTH))
{
	$i++;
	echo '<div class="vzkaz"><div class="zahlavi">' .
		'<a href="?remove='. $row['id'] . '" onclick="return confirm(\'Smazání je nevratné.\nPokračovat?\')">smazat</a>' .
		'<span class="jmeno">'. $row['name'] . '</span>' .
		'<span class="datum">' . substr($row['time'], 0, 10) . '</span></div>' .
		'<span class="message">' .nl2br($row['message']) . "</span></div>\n";
}
if ($i == 0) {
	echo "Kniha návštěv je prázdná.";
}

?>
	</div>