<?php
if (isset($_POST['edit'])) {
			$id = addslashes($_POST['edit']);
			$value = addslashes($_POST['value']);
			$res = $mysqli->query("UPDATE `strings` SET `value` = '$value' WHERE `code` = '$id'");
			$error = $res ? "Byl upraven text <b>$id</b>." : "Při ukládaní došlo k chybě.";
		}
?>
	<header>
		<?php echo $DOMAIN;?> &gt; EDITACE &gt; Části stránky
		<a  class="logout" href="?logout">odhlásit</a>
	</header>
	<div class="main">
		<?php if ($error != "") echo '<div class="notification">' .$error. '</div>'; ?>
		<?php include 'navigace.inc'; ?>

		<h1>Části stránky</h1>

<?php if (isset($_GET['edit']) || isset($_POST['edit'])) { ?>
	<hr />
	<?php if (isset($_POST['edit'])) { ?>
	&lt;&lt; <a href="?list">uloženo, zpět na seznam</a>
	<?php } else { ?>
	&lt;&lt; <a href="?list">neukládat</a>
	<?php } ?>

	<?php
		$id = isset($_POST['edit']) ? addslashes($_POST['edit']) : addslashes($_GET['edit']);
		$res = $mysqli->query("SELECT * FROM strings WHERE code='$id' LIMIT 0,1");
		$description = $value = "";
		while ($row = $res->fetch_array(MYSQL_BOTH)) {
			$description = $row['description'];
			$value = $row['value'];
		};
	?>
	<form method="POST">
		<h2>Upravit</h2>
		<p><?php echo $description;?></p>
		<input type="hidden" name="edit" value="<?php echo $_GET['edit'];?>" />
		<textarea name="value" rows="12"><?php echo $value;?></textarea>
		<input type="submit" name="send" value="uložit" />
	</form>
<?php } else { ?>


		<table>
			<thead>
				<tr>
					<th>Popis</th>
					<th>Obsah</th>
					<th>Nástroje</th>
				</tr>
			</thead>
			<tbody>

<?php
$i = 0;
$res = $mysqli->query("SELECT * FROM strings");
while ($row = $res->fetch_array(MYSQL_BOTH))
{
	echo '<tr>
			<td>'. strip_tags($row['description']).'</td>
			<td>'. mb_substr(strip_tags($row['value']), 0, 50, 'UTF-8').'</td>
			<td><a href="?edit='. $row['code'] . '" class="btn float-right">upravit</a></td>
		</tr>';
}
?>
		</tbody>
	</table>

<?php } ?>
