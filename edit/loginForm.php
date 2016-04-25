<?php setcookie("editace"); setcookie("editace_str");?>
<html lang="cs">
<head>
	<title>Editace dvojcatanauteku.cz</title>
<meta charset="utf-8" />
</head>
<style>
	body, html {padding: 0, 0, 0, 0; margin: 0 0 0 0;}
	header {background-color: #C0C; color:white; padding: 5px 5px 5px 5px; font-family: sans-serif; font-weight: lighter; letter-spacing: 2px;}
	.main {padding: 5px 5px 5px 5px; width: 100%; max-width: 800px; margin: auto auto;}
	label {display: block; text-decoration: underline;}
</style>

</head>
<body>
	<header>
		dvojcatanauteku.cz &gt; EDITACE &gt; Login
	</header>
	<div class="main">
		<h1>Login</h1>
		<form method="post" action="index.php">
			<label>Autentizace:</label>
			<input type="password" name="password" />
			<input type="submit" value="Přihlásit" />
		</form>
	</div>

</body>
</html>