<!DOCTYPE HTML>
<html>
	<head>
    	<meta charset="UTF-8">
    	<title>Сгенерировать короткую ссылку</title>
    	<meta name="description" content="Сервис для сокращения ссылок">
		<link type="text/css" href="css/style.css" rel="stylesheet">
		<script src="js/jquery.min.js" type="text/javascript"></script>
	</head>
	<body>
		
<?php

	require_once('config.php');
	$db = mysqli_connect($config['db']['host'],$config['db']['username'],$config['db']['password'],$config['db']['dbname']) or die();
	
	if (!empty($_GET['redirect'])) {
		$res = mysqli_query($db,"SELECT * FROM url WHERE short_url = '".$_GET['redirect']."'");
		$url = mysqli_fetch_assoc($res);
		if ($url['short_url']) {
			header('Location: '.$url['full_url'].'');
		}
	}
?>
	
	<header>
        <h2>Сократить ссылку</h2>
    </header>
	<div class="short">
        <form method="post" action="" id="url"> <br />
            <input name="action" value="set" type="hidden">
            <input class="full_url" type="text" size="50" name="full_url" placeholder="Вставьте ссылку" val="">           
            <input id="generate" type="submit" value="Сгенерировать" /><br />
            <input type="checkbox" id="custom_box" name="custom_box"><label>Ввести свое окончание</label><br />
            <input id="custom_url" type="text" size="50" name="custom_url" placeholder="Придумайте окончание" val="" style="display:none;">           
            <input id="custom_sub" type="submit" value="Применить" style="display:none;" />
        </form>
        <div class="results"></div>
    </div>
    
	<script src="js/main.js"></script>
	
    </body>
</html>