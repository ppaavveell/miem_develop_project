<?php

session_start();

if (isset($_GET['error']))
{
	$_SESSION["idUser"] = 0;
}

if(isset($_GET['exit']))
{
	$_SESSION["idUser"] = 0;
}


if(isset($_POST['enter_gb']) || isset($_GET['id']))
{


	if(isset($_POST['enter_gb']))
	{
		$sLogin = $_POST['login_gb'];
		$sPass = md5($_POST['pass_gb']);

		require_once("includes_gb/connect.php");

		$sql = "SELECT id, login, pass
				FROM authorization_db.guests
				WHERE authorization_db.guests.login = \"$sLogin\"
				AND authorization_db.guests.pass = \"$sPass\" ";
		$out = mysql_query($sql);

		$Id_User = 0;

		while($aStart = mysql_fetch_assoc($out))
		{
			$Id_User = (int)$aStart["id"];
			$sLoginUser = $aStart["login"];
		}
	}

	if(isset($_GET['id']))
	{
		$iNewId = $_GET['id'];

		require_once("includes_gb/connect.php");

		$sql = "SELECT id, login, pass
				FROM authorization_db.guests
				WHERE authorization_db.guests.id = \"$iNewId\" ";
		$out = mysql_query($sql);

		$Id_User = 0;

		while($aStart = mysql_fetch_assoc($out))
		{
			$Id_User = (int)$aStart["id"];
			$sLoginUser = $aStart["login"];
		}
	}

	$_SESSION["idUser"] = $Id_User;
	$_SESSION["loginUser"] = $sLoginUser;
	$_SESSION["enter_gb"] = 1;

	// После того, как мы авторизовали пользователя...
	if($Id_User)
	{
		header("Location: ?");
	}
	else
	{
		header("Location: ?error=1");
	}

} else
{
	$Id_User = $_SESSION["idUser"];
	//$_SESSION["enter_gb"] = 0;
}


?>

<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="shortcut icon" href="../img/comment_9254.ico" />
  <link href="../css/gb.css" rel="stylesheet">
  <title>Гостевая книга</title>
  <script src="../js/jquery-2.1.4.js"></script>
 </head>



 <body>
    <FORM  name="form_gb" action="" method="post">
            <div class="head_title">Приложение по учёту покупок</div>
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />

			<?php
			/***********

			Здесь должен быть код с камерой


			**********/
			?>

            <br />
            <br />
            <br />
            <br />
            <br />
            <br />
            <br />

			<div>
				<?php
					if ($Id_User) /* if (!$Id_User) */
					{
						echo "Вы зашли как: <b id=\"guestName\">".$_SESSION["loginUser"]."</b>";
						echo "&nbsp;";
						echo "[<a href=\"?exit=1\">выход</a>]";

					}else
					{
						if (isset($_GET['error']))
						{
						echo "<p style=\"color: #990000;\">";
						echo "Неправильно введен логин или пароль!";
						echo "</p>";
						}

				?>
					<input type="text" name="login_gb" size="20"  placeholder="логин" style="border-radius: 5px;">
					<input type="text" name="pass_gb" size="20"  placeholder="пароль" style="border-radius: 5px;">
					<button type="submit" name="enter_gb" id="enter_gb" class="button22_submit">Войти</button>
					<p><a href="/camera_/nina_guest_book_reqister_list2.php">Регистрация</a></p>

				<?php } ?>
			</div>

	</FORM>
  </body>
</html>





