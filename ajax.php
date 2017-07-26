<?php

	require_once('config.php');
	$db = mysqli_connect($config['db']['host'],$config['db']['username'],$config['db']['password'],$config['db']['dbname']) or die();
	
	switch ($_POST['action']) {
		case 'set':
			$full_url = $_POST['full_url'];
			if (filter_var($full_url, FILTER_VALIDATE_URL) === FALSE) {
			    die('Вы ввели не ссылку!');
			}
			$custom_box = $_POST['custom_box'];
			$custom_url = $_POST['custom_url'];
			if ($custom_box) {
				if (!$custom_url) {
					die ('Вы ничего не ввели');
				}
				$res = mysqli_query($db,"SELECT * FROM url WHERE short_url = '".$custom_url."'");
				if (mysqli_num_rows($res)) {
					die ('Извините, ссылка занята, придумайте другую');
				}				
				$res = mysqli_query($db,"INSERT INTO url (full_url, short_url) VALUES ('".$full_url."', '".$custom_url."')");
				die ('Ссылка успешно создана. Скопируйте:<br />
						http://'.$_SERVER['HTTP_HOST'].'/'.$custom_url);
			}
			$generated_url = generateUrl();
			$res = mysqli_query($db,"INSERT INTO url (full_url, short_url) VALUES ('".$full_url."', '".$generated_url."')");
			die ('Ссылка успешно создана. Скопируйте:<br />
					http://'.$_SERVER['HTTP_HOST'].'/'.$generated_url);
			break;
	}
	
	function urlRandom()
	{
		$arr = array('a','b','c','d','e','f','g','h','i','j','k','l','m','n','o','p','q','r','s','t','u','v','w','x','y','z','A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z','1','2','3','4','5','6','7','8','9','0');
		$generated_url = '';
		for($i = 0; $i < 5; $i++) {
			$index = rand(0, count($arr) - 1);
			$generated_url .= $arr[$index];
		}
		return $generated_url; 	
	}
	
	function generateUrl()
	{
		$generated_url = urlRandom();
		$res = mysqli_query($db,"SELECT * FROM url WHERE short_url = '".$generated_url."'");
		if (mysqli_num_rows($res)) {
			return generateUrl();
		}
		return $generated_url;
	}
	