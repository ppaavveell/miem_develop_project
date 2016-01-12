<?php header("Access-Control-Allow-Origin: *"); ?>
<?php
	session_start();




if(isset($_GET['login']))
{


	$Id_User = $_GET['login'];


	$_SESSION["idUser"] = $Id_User;
	$_SESSION["loginUser"] = $Id_User;

	// После того, как мы авторизовали пользователя...
	if($Id_User)
	{
		header("Location: ?");
	}

} else
{
	$Id_User = $_SESSION["idUser"];
	//$_SESSION["enter_gb"] = 0;
}

?>
<!doctype html>

<html lang="en">
<head>
	<link rel='stylesheet' href='webcamjs-master/css/bootstrap.min.css' type='text/css' media='all'>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	 <link rel="shortcut icon" href="../img/savekoplife.ico" />
	<!-- First, include the Webcam.js JavaScript Library -->
	<script type="text/javascript" src="webcamjs-master/webcam.js"></script>
	<script type="text/javascript" src="../js/jquery-2.1.4.min.js" ></script>
	<title>SaveKopLife</title>
	<style type="text/css">
		body { font-family: Helvetica, sans-serif; }
		h2, h3 { margin-top:0; }
		form { margin-top: 15px; }
		form > input { margin-right: 15px; }
		#results { float:right; margin:20px; padding:20px; border:1px solid; background:#ccc; }
	</style>
</head>
<body>
	<div id="results" style="display:none">Сфотографированный чек будет показан здесь...</div>

	<h1 style="margin-left: 30px;">Приложение по учёту покупок</h1>


		<?php
					if ($Id_User) /* if (!$Id_User) */
					{
						echo "<p style='margin-left: 30px;'><i>Вы зашли как</i>: <b id=\"guestName\">".$_SESSION["loginUser"]."</b>";
						echo "&nbsp;";
						echo "[<a href=\"authorization.php\">выход</a>]</p>";

					}

				?>

	<!-- Configure a few settings and attach camera -->
	<script language="JavaScript">
		Webcam.set({
			width: 320,
			height: 240,
			image_format: 'jpeg',
			jpeg_quality: 90,
		});
		// Webcam.attach( '#my_camera' );
	</script>


	<!-- Code to handle taking the snapshot and displaying it locally -->
	<script language="JavaScript">
		function show_button()
		{
			Webcam.attach( '#my_camera' );
			document.getElementById('fhotos').style.display = '';
			document.getElementById('results').style.display = '';
		};
		function take_snapshot() {
			// take snapshot and get image data
			// document.getElementById('save_as').style.display = 'none';
			Webcam.snap(function(data_uri) {
			document.getElementById('results').innerHTML = '<img id="base64image" src="'+data_uri+'"/><br><br><button id="save_as" class="btn btn-primary" onclick="SaveSnap();">Сохранить чек</button>';
			} );
		}
		function SaveSnap()
		{
			document.getElementById("save_as").innerHTML="Saving, please wait...";
			var file =  document.getElementById("base64image").src;
			console.log(file);
			var formdata = new FormData();
			formdata.append("base64image", file);
			var ajax = new XMLHttpRequest();
			ajax.addEventListener("load", function(event) { uploadcomplete(event);}, false);
			ajax.open("POST", "upload.php");
			ajax.send(formdata);
		}
		function uploadcomplete(event)
		{
			document.getElementById("save_as").innerHTML="Сохранено";
			document.getElementById("save_as").disabled = true;;
			var image_return=event.target.responseText;
			var showup=document.getElementById("save_as").src=image_return;
			console.log(showup);
		}
		function chose_file()
		{
			// document.getElementById("files").setAttribute("click", "gg()");
			document.getElementById("files").click();
			// console.log(document.getElementById("files"));
		};
		function gg()
		{
			var filename = 'uploads\\' + document.getElementById("files").files[0].name
			fr = new FileReader();
			fr.readAsDataURL(document.getElementById("files").files[0]);
			var img = new Image();
			img.src = fr.result;
					console.log(document.getElementById("files").files);
					// $('#ds').html('<img src="data:image/jpeg;base64" >');

			/*var xhr = new XMLHttpRequest();
			xhr.open('GET', filename, false);
			xhr.send();
			if (xhr.status != 200) {
			  // обработать ошибку
			  alert( xhr.status + ': ' + xhr.statusText ); // пример вывода: 404: Not Found
			} else {
			  // вывести результат
			  alert( xhr.responseText ); // responseText -- текст ответа.
			}*/
			// console.log(document.getElementById("files").files);
			openImageWindow(filename);
			// console.log(filename);
		}

		function openImageWindow(src)
		{
			var image = new Image();
			image.src = src;
			var width = image.width;
			var height = image.height;
			// location.href=src;
			console.log(document.open(src,"Image","width=" + width + ",height=" + height, '_self'));
		}



	</script>
<p style="margin-top: 20px; margin-left: 30px;">
	<input class="btn btn-success" onclick="show_button()" type=button value="Сфотографировать чек" >
	<input class="btn btn-info" type=button onclick="chose_file()" value="Выбрать файл" >
	<input class="btn btn-warning" type=button value="Ввести вручную" >
	<input type=file value="Выбрать файл" id="files" onchange="gg()" style="display: none;" >
</p>
	<div id="my_camera" style="margin-left: 30px;"></div>
	<input type=button id="fhotos" value="Сфотографировать чек" onClick="take_snapshot()" style="display:none;margin-top: 20px;margin-left: 30px;" class="btn btn-primary"  >
	<div>
 <!-- <img src = 'laba4_1.jpg' alt = 'Фотография' width = '200' onclick = 'openImageWindow(this.src);' /> -->
</div>

<div id="ds"></div>
</body>
</html>
