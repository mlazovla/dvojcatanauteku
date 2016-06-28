<?php
if (isset($_POST['edit'])) {
	$id = addslashes($_POST['edit']);
	$content = addslashes(trim($_POST['content']));
	$res = $mysqli->query("UPDATE `posts` SET `content` = '$content' WHERE `id` = '$id'");
	$error = $res ? "Byl upraven příspěvek." : "Při ukládaní došlo k chybě.";
}
elseif (isset($_POST['content']) && !isset($_POST['edit'])) {
	$content = addslashes(trim($_POST['content']));
	$res = $mysqli->query("INSERT INTO `posts` (`id`, `date`, `content`) VALUES (NULL, CURRENT_TIMESTAMP, '$content');");
	$error = $res ? "Byl přidán příspěvek." : "Při ukládaní došlo k chybě.";
}
elseif (isset($_GET['remove'])) {
	$id = addslashes($_GET['remove']);
	$res = $mysqli->query("DELETE FROM `posts` WHERE `id` = '$id';");
	$error = $res ? "Byl odstaněn příspěvek." : "Při mazání došlo k chybě.";
}
?>
<header>
	<?php echo $DOMAIN;?> &gt; EDITACE &gt; Příspěvky
	<a  class="logout" href="?logout">odhlásit</a>
</header>
<div class="main">
	<?php if ($error != "") echo '<div class="notification">' .$error. '</div>'; ?>
	<?php include 'navigace.inc'; ?>

	<h1>Příspěvky</h1>

	<?php if (!isset($_GET['edit']) && !isset($_POST['edit'])) { ?>
	<form method="POST">
		<h2>Nový příspěvek do občasníku</h2>

		<textarea name="content" rows="12"><?php
			if (isset($_POST['content'])) {
				echo $_POST['content'];
			}
			?></textarea>
		<input type="submit" name="send" value="uložit" />
	</form>
	<?php } else  { ?>
		<hr />
		<?php if (isset($_POST['edit'])) { ?>
			&lt;&lt; <a href="?list">uloženo, zpět na seznam</a>
		<?php } else { ?>
			&lt;&lt; <a href="?list">neukládat</a>
		<?php } ?>

		<?php
		$id = isset($_POST['edit']) ? addslashes($_POST['edit']) : addslashes($_GET['edit']);
		$res = $mysqli->query("SELECT * FROM posts WHERE id='$id' LIMIT 0,1");
		$description = $value = "";
		while ($row = $res->fetch_array(MYSQL_BOTH)) {
			$date = new DateTime($row['date']);
			$content = $row['content'];
		};
		?>
		<form method="POST">
			<h2>Upravit</h2>
			<p><?php echo ($date->format('H:i j.n.Y'));?></p>
			<input type="hidden" name="edit" value="<?php echo $id; ?>" />
			<textarea name="content" rows="12"><?php echo $content;?></textarea>
			<input type="submit" name="send" value="uložit" />
		</form>
	<?php }

	if (!isset($_GET['edit']) && !isset($_POST['edit']))  { ?>

		<h2>Upravit existující</h2>
		<table>
			<thead>
			<tr>
				<th>Datum</th>
				<th>Příspěvek</th>
				<th>Nástroje</th>
			</tr>
			</thead>
			<tbody>

			<?php
			$i = 0;
			$res = $mysqli->query("SELECT * FROM posts ORDER BY id DESC LIMIT 0,100");
			while ($row = $res->fetch_array(MYSQL_BOTH))
			{
				$date = new DateTime($row['date']);
				echo '<tr>
			<td>'. $date->format('j.n.Y H:i') .'</td>
			<td>'. mb_substr(strip_tags($row['content']), 0, 50, 'UTF-8').'</td>
			<td>
				<a href="?remove='. $row['id'] . '" class="btn btn-danger float-right" onclick="return confirm(\'Opravdu smazat?\')">odstranit</a>
				<a href="?edit='. $row['id'] . '" class="btn float-right">upravit</a>
			</td>
		</tr>';
			}
			?>
			</tbody>
		</table>

	<?php } ?>
