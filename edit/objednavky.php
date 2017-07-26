<header>
	<?php echo $DOMAIN;?> &gt; EDITACE &gt; Objednávky
	<a class="logout" href="?logout">odhlásit</a>
</header>
<div class="main">
	<?php if ($error != "") echo '<div class="notification">' .$error. '</div>'; ?>
	<?php include 'navigace.inc'; ?>

	<h1>Objednávky</h1>
	<?php
		$orders = scandir('../zakoupit/objednavky', SCANDIR_SORT_DESCENDING);
		$counter = 0;
		$ordersCount = count($orders)-2;
		foreach ($orders as $order) {
			if ($order == '.' || $order == '..') continue;
			echo '<p>'.($ordersCount-$counter).'. <a href="../zakoupit/objednavky/'.$order.'" target="_blank">'.substr($order, 0, -4).'</a><br />';
			$counter++;
			if ($counter > 100) break;
		};
	?>
