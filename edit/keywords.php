<?
if (!file_exists("keywords.inc"))
{
	$infile = fopen("../keywords.inc", "a+");
	fclose($infile);
}

if (isset($_POST['keywords']))
{
	$outfile = fopen("../keywords.inc", "w");
	fwrite($outfile, htmlspecialchars($_POST['keywords']));
	fclose($outfile);
	$error .= "Klíčová slova byla změněna:<br />\n<b>" .  $_POST['keywords'] . "</b>\n";
}

?>

	<header>
		radim-keith.cz &gt; EDITACE &gt; Klíčová slova
		<a  class="logout" href="?logout">odhlásit</a>
	</header>
	<div class="main">
		<?php if ($error != "") echo '<div class="notification">' .$error. '</div>'; ?>
		<?php include 'navigace.inc'; ?>
		<h1>Klíčová slova</h1>
		<p>Vyplňte nebo změňta klíčová slova. Jednotlivá slova nebo slovní spojení oddělujte čárkou.</p>
		<form method="post">
			<textarea name="keywords"><?php include "../keywords.inc"; ?></textarea>
			<input type="submit" value="ULOŽIT" />
		</form>
	</div>