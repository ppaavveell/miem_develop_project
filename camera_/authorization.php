<?php header("Access-Control-Allow-Origin: *"); ?>
<!doctype html>

<html lang="en">
<head>
 <link rel="shortcut icon" href="../img/savekoplife.ico" />
</head>
<body>
<form method="POST" action="" >
	<h1 style="margin-left: 30px;">Приложение по учёту покупок</h1>
	<input type="text" name="login_gb" size="20"  placeholder="логин" style="border-radius: 5px;">
	<input type="text" name="pass_gb" size="20"  placeholder="пароль" style="border-radius: 5px;">
	<button type="submit" name="enter_gb" id="enter_gb" class="button22_submit">Войти</button>
	<p><a href="/camera_/nina_guest_book_reqister_list2.php">Регистрация</a></p>
</form>
</body>
</html>

<?php
	$itog = 0;
	if (isset($_POST['login_gb']))
	{
		$link = mysql_connect('localhost', 'root');
		$db = mysql_select_db('test');
		$sql = "SELECT login = '" . $_POST['login_gb'] . "' AS login, pass FROM guests ORDER BY login DESC  LIMIT 1";
		$result = mysql_query($sql);
		while($h = mysql_fetch_assoc($result))
		{
			// var_dump($h);
			// var_dump($result);

				if($h['login'] == 0)
				{
					echo "Такого пользователя не существует!";
				}
				else
				{
				if (md5($_POST['pass_gb']) == $h['pass'])
				{
					$itog = 2;
				}
				else
				{
					echo "Не верный логин или пароль!";
					$itog = 0;
				}
			}
		}
	}
?>

<script type="text/javascript">
	var itog = "<?= $itog ?>";
	var login = "<?= $_POST['login_gb'] ?>";
	if (itog > 0)
		{
			console.log(login);
			document.location.href = "../camera_/index.php?login=" + login;
		};
</script>