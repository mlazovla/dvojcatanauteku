<?php
$priceBook = 220;
$pricePost = 130;

$form = [
	'amount' => ['l'=>'Kusů', 't' => 'number', 'dv'=>'1', 'r'=>1, 'ia' => 'min="1" max="99"'],
	
	'name' => ['l'=>'Jméno', 't' => 'text', 'dv'=>'', 'r'=>1],
	'surname' => ['l'=>'Příjmení', 't' => 'text', 'dv'=>'', 'r'=>1],
	'street' => ['l'=>'Ulice', 't' => 'text', 'dv'=>'', 'r'=>1],
	'streetNo' => ['l'=>'Číslo popisné', 't' => 'text', 'dv'=>'', 'r'=>1],
	'city' => ['l'=>'Město', 't' => 'text', 'dv'=>'', 'r'=>1],
	'zip' => ['l'=>'PSČ', 't' => 'text', 'dv'=>'', 'r'=>1],
	'country' => ['l'=>'Země', 't' => 'text', 'dv'=>'Česká Republika', 'r'=>1],
	'phone' => ['l'=>'Telefon', 't' => 'text', 'dv'=>'+420', 'r'=>0],
	'email' => ['l'=>'Email', 't' => 'text', 'dv'=>'@', 'r'=>1],

	//'capcha' => ['l'=>'Napište výsledek 3+2', 't' => 'text', 'dv'=>'@', 'r'=>1],
	'sent' => ['l'=>'Zakoupit', 't' => 'submit', 'dv'=>'Objednat', 'r'=>1],
];
$values = isset($_POST['sent']) ? $_POST : [];

$errors = [];

function formRow($name, $form)
{
	$values = isset($_POST['sent']) ? $_POST : [];
	$type = isset($form[$name]) ? $form[$name]['t'] : 'text';
	$label = isset($form[$name]) ? $form[$name]['l'] : $name;
	$value = isset($values[$name]) ? $values[$name] : (isset($form[$name]) ? $form[$name]['dv'] : '');
	$ia  = (isset($form[$name]) && isset($form[$name]['ia'])) ? ' '.$form[$name]['ia'] : '';
	echo '<div class="form-group"><label for="'.$name.'">'.$label.'</label><br />
  			<input name="'.$name.'" id="'.$name.'" type="'.$type.'" value="'.$value.'"'.$ia.'/></div>';
}

if (count($values)) {
	foreach ($form as $name => $row) {
		if ($row['r'] && !$values[$name]) {
			$errors[] = 'Vyplňte prosím '.$row['l'].'.';
			break;
		}
	}
	if (!filter_var($values['email'], FILTER_VALIDATE_EMAIL)) {
    	$errors[] = "Zkontrolujte prosím Vaši emailovou adresu.";
	}
	if (!count($errors)) {
		$totalPrice = $pricePost+$priceBook*$values['amount'];
		$headers = [
			'MIME-Version: 1.0',
			'Content-type: text/html; utf-8',
			'From: dvojcatanauteku.cz <info@dvojcatanauteku.cz>'
		];
		$messageHead = "<html><head><meta charset=\"utf-8\"><title>Objednávka z webu dvojcatanauteku</title></head><body>";
		$messageTail = "</body></html>";
		$summary = '<table>';
		foreach ($form as $name => $row) {
		    if ($name=='sent') {
		        continue;
            }
			if ($values[$name]) {
				$summary .= '<tr><th align="left">'.$row['l'].': </th><td>'.$values[$name]."</td></tr>\n";
			}
		}
		$summary .= '</table>';
		$filename = 'objednavky/'.date('Y-m-d_H:i:s').'.txt';
		file_put_contents($filename, "\xEF\xBB\xBF".strip_tags($summary)."\n Cena: ".$totalPrice.' Kč'); // log file
        chmod($filename, 0664);

		$adminMessage = $messageHead
			."<p>Na webu dvojcatanauteku.cz byla právě vytvořena objednávka s následujícími parametry.</p><br/>\n<br/>\n"
			.$summary
			.'<big><b>Cena celkem '.$totalPrice.' Kč</b></big>'
			.$messageTail;
		$clientMessage = $messageHead
			."<p>Na webu dvojcatanauteku.cz jste vytvořil/a objednávku. Prosím zkontrolujte správnost údajů, v případě pochybení nás ihned kontaktujte na info@dvojcatanauteku.cz nebo telefonicky na 774 907 657.</p><br/>\n<br/>\n"
			.$summary
			.'<p><big><b>Cena celkem '.$totalPrice.' Kč</b></big></p>'
			.'<p>Kniha Vám bude odeslána na dobírku.</p>'
			.$messageTail;

		mail( $values['email'], 'Vaše objednávka z dvojcatanauteku.cz', $clientMessage,
			implode("\r\n", array_merge($headers, ['To: <'.$values['email'].'>'])) );
		mail('Radim.Keith@seznam.cz', 'Nová objednávka z dvojcatanauteku.cz', $adminMessage,
			implode("\r\n", array_merge($headers, ['To: <Radim.Keith@seznam.cz>'])) );
		
		header("Location: http://dvojcatanauteku.cz/zakoupit/thankyou.php");
		die();
	}
}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>Zakoupit Dvojčata na útěku | Radim Keith</title>
	<meta name="title" content="Zakoupit Dvojčata na útěku | Radim Keith" />
	<meta name="description" content="Zakoupit knihu Dvojčata na útěku, aneb život otce na rodičovské" />

    <!-- font-family: 'Sacramento', cursive; font-family: 'Lato', sans-serif; -->
    <link href='https://fonts.googleapis.com/css?family=Lato:100|Sacramento&subset=latin-ext,latin' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" id="favicon" href="favicon.ico">
	<meta name="author" content="Radim Keith">
	<script type="text/javascript" src="../js/jquery-1.9.1.js"></script>
	  <meta name="viewport" content="initial-scale=1, width=device-width, maximum-scale=1, minimum-scale=1, user-scalable=no">

	<!-- FACEBOOK -->
	<meta property="og:image" content="http://dvojcatanauteku.cz/img/nohy.png">
	<meta property="og:image:type" content="image/png">
	<meta property="og:image:width" content="486">
	<meta property="og:image:height" content="616">
	<meta property="og:url" content="http://dvojcatanauteku.cz">
	<meta property="og:title" content="Dvojčata na útěku">
	<meta property="og:description" content="Kniha Dvojčata na útěku, aneb život otce na rodičovské">


  <style>
    html {
      height: 100%;
    }
    body {
      background: rgb(255, 235, 241);;
      padding: 0 0 0 0;
      font-family: 'Helvetica Neue', sans-serif;
      font-weight: 300;
      margin: 0 0 0 0;
      height: 100%;
      -webkit-font-smoothing: antialiased;
    }
    .main {
    	width: 100%;
    	max-width: 400px;
    	margin: auto auto;
    }
    
    .centered {
    	text-align: center;
    }
    .right {
    	text-align: right;
    }
    .pull-right {
    	float: right;
    }

    .order {
    	width:60%;
 		min-width: 200px;
 		margin: auto auto;
    }
    .order table {
 		width:100%;
 		min-width: 200px;
 		float: right;
 		clear: both;
 		border-bottom: 3px double #444;
    }
    .order table th {
    	text-align: left;
    }
    .priceTotal {
    	text-align: right;
    	font-size: 1.2rem;
    	font-weight: bold;
    	clear: both;
    }
    h1 small {
    	color: #444;
    }

    h2 {
    	font-weight: 200;
    }

    .form-group {
    	margin-bottom: 6px;
    }
    .form-group label {
    	font-weight: 400;
    	font-size: 0.7rem;
    	letter-spacing: 0.4px;
    }
    .form-group input {
    	width: 60%;
    	min-width: 200px;
    	font-size: 1rem;
    	padding: 3px 5px;
    }
    .form-group input[type='number'] {
    	text-align: right;
    	min-width: 2em;
    	width: 2em;
    }
    .btn-primary {
    	text-transform: uppercase;
    	background-color: royalblue;
    	color: white;
    	border: 1px solid darkblue;
    	font-weight: bold;
    	padding: 5px 10px;
    	margin-bottom: 5px;
    	margin-top: 5px;
    }
    .btn-primary:hover {
    	cursor: pointer;
    	box-shadow: 0 0 3px rgba(0,0,0,0.4);
    }

    .orderInfo {
    	font-size: 0.7rem;
    }
    hr {
    	clear: both;
    }
    footer {
    	padding-bottom: 1em;
    	text-align: right;
    }
    .error {
    	margin-bottom: 3px;
    	color: darkred;
    }

  </style>
	
</head>
<body>
    <div class="main">
    	Zakoupit
		<h1>
			Dvojčata na útěku,<br />
			<small>aneb život otce na rodičovské</small>
		</h1>
      	<div class="centered"><i>Radim Keith</i></div>
      	<hr />
      	<form method="post">
      		<?php foreach ($errors as $err) {echo '<div class="error">'.$err.'</div>';} ?>
      		<?php formRow('amount', $form); ?>
      		<hr />

      		<h2>Dodací adresa</h2>
      		<?php formRow('name', $form); ?>
			<?php formRow('surname', $form); ?>
			<?php formRow('street', $form); ?>
			<?php formRow('streetNo', $form); ?>
			<?php formRow('city', $form); ?>
			<?php formRow('zip', $form); ?>
			<?php formRow('country', $form); ?>
			<?php formRow('phone', $form); ?>
			<?php formRow('email', $form); ?>

			<hr />

			<h2>Objednávka</h2>
      		<div class="order">
      			<table>
      				<tr><th>Kniha</th><td id='amountTable'>1x</td><td class="right" id='priceTable'><?php echo $priceBook; ?> Kč</td></tr>
      				<tr><th>Dobírka</th><td></td><td class="right"><?php echo $pricePost; ?> Kč</td></tr>
				</table>		
      		
      			<div class="priceTotal" id="priceTotal">
      				<?php echo ($priceBook+$pricePost); ?> Kč
      			</div>
  			</div>

			<hr />

			<div class="orderInfo">Objednávka Vám bude potvrzena emailem a zaslána na dobírkou na výše uvedenou adresu.</div>
			<input type="submit" name='sent' value='Zakoupit' class="btn-primary" /><br/>
		</form>
		<hr />
		<footer>
			Radim Keith 2017
		</footer>
    </div>

    <script type="text/javascript">
    	$('#amount').on('change', function() {
    		var amount = $(this).val();
    		var totalPrice = amount*<?php echo $priceBook; ?> + <?php echo $pricePost; ?>;
    		$('#amountTable').html(''+amount+'x');
    		$('#priceTotal').html(''+totalPrice+' Kč');
    	});

    </script>
</body>
</html>