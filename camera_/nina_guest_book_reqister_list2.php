<!DOCTYPE html>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <link rel="shortcut icon" href="../img/savekoplife.ico" />

  <title>SaveKopLife</title>
 <script type="text/javascript" src="../js/jquery-2.1.4.min.js" ></script>

  <style>
	body {
		/*background-image: url(../img/gb_backgroud3.jpg); /* Путь к фоновому изображению */*/
		/*background-color: #c7b39b; /* Цвет фона */*/
	}
	p {
		font-family: monospace;
		margin: 3px;
		margin-bottom: 0px;
	}

	td.padding {
		padding: 3px 0px 10px 3px;
	}

	td.padding_hint {
		padding-bottom: 24px;
	}

	span.hint {
		/*background: url("../img/notify_sprite.png") 0 0 no-repeat;*/
		display: block;
		font-family: Tahoma, Arial;
		background-position: 0 -50px;
		position: absolute;
	}

	span.example {
		display: none;
		margin-left: 10px;
		/*padding: 3px 5px;*/
		font-size: 10px !important;
		font-family: Tahoma, Arial;
		background-color: #f2f3f7;
		border-style: solid;
		border-color: #e6e8ed;
	}



    /* Кнопки */


	button.button22_submit
	{
		font-family: monospace;
		display: inline-block;
		line-height: 1.4em;
		vertical-align: middle;
		text-align: center;
		text-decoration: none;
		user-select: none;
		color: #000;
		outline: none;
		border: 1px solid rgba(110,121,128,.8);
		border-top-color: rgba(0,0,0,.3);
		border-radius: 5px;
		background: rgb(222, 231, 239) linear-gradient(rgb(226, 237, 233), rgb(205, 229, 239));
		box-shadow: 0 -1px rgba(10,21,28,.9) inset, 0 1px rgba(255,255,255,.5) inset;
	}

	button.button22_submit:hover
	{
		background: rgb(222, 231, 239) linear-gradient(rgb(197, 212, 207), rgb(177, 199, 208));
	}

	.head_title
	{
	background-color: #666666;
    -webkit-background-clip: text;
    -moz-background-clip: text;
    background-clip: text;
    color: transparent;
    text-shadow: rgba(255,255,255,0.5) 0px 3px 3px;
    font-family: monospace;
    font-weight: bold;
    font-size: 2em;
    margin-left: 9px;
	}



  </style>
 </head>




	<body>
		<div style="text-align: left;" class="head_title">
			<b>Регистрация нового гостя!</b></div>

		<table width="50%" border="0">
<!-- 		<tr>
			<td width="1%" class="padding">
				<p style="text-align: right;">Имя<sup style="color: red;">*</sup></p>
			</td>
			<td width="1%" class="padding">
				<input type="text" name="name_new_guest"
				  onfocus ="on_focus('name_new_guest')"
				  onblur="on_blur('name_new_guest')"
				  size="50"  style="border-radius: 5px;" required="1" id="name_new_guest" >
			</td>
			<td class="padding_hint">
				<span class="hint">
					<span class="example"  id="hint_name" >Пожалуйста, укажите настоящее имя</span>
					<span class="example"  id="hint_empty_name"  style="color:#D20000;">Введите имя!</span>
				</span>
			</td>
		</tr> -->
		<tr>
			<td class="padding">
				<p style="text-align: right;">Логин<sup style="color: red;">*</sup></p>
			</td>
			<td class="padding">
				<input type="text" name="login_new_guest"
				 onfocus ="on_focus('login_new_guest')"
				 onblur="on_blur('login_new_guest')"
				size="50" style="border-radius: 5px;" required="1" id="login_new_guest">
			</td>
			<td class="padding_hint">
				<span class="hint">
					<span class="example"  id="hint_login"  style="color:#D20000;">Такой логин уже существует, попробуйте ввести другой!</span>
					<span class="example"  id="hint_empty_login" style="color:#D20000;">Введите логин!</span>
				</span>
			</td>
		</tr>
		<tr>
			<td class="padding">
				<p style="text-align: right;">Пароль<sup style="color: red;">*</sup></p>
			</td>
			<td class="padding">
				<input type="text" name="pass_new_guest"
				 onfocus ="on_focus('pass_new_guest')"
				 onblur="on_blur('pass_new_guest')"
				 size="50"  style="border-radius: 5px;" required="1" id="pass_new_guest">
			</td>
			<td class="padding_hint">
				<span class="hint">
					<span class="example"  id="hint_pass" >Задайте сложный пароль, используя заглавные<br />и строчные буквы (A-Z, a-z), цифры (0-9) и специальные символы</span>
					<span class="example"  id="hint_empty_pass"  style="color:#D20000;">Введите пароль!</span>
				</span>
			</td>
		</tr>
		<tr>
			<td class="padding">
				<p>&nbsp;</p>
			</td>
			<td class="padding">
				<button class="button22_submit" id="reqister_gb"  onclick="reqister_new_guest()">Зарегистироваться!</button>
			</td>
			<td class="padding_hint">
				<span></span>
			</td>
		</tr>

		</table>
		<br />
	</body>
</html>



<script>

$(document).ready(function()
{
	$('#name_new_guest').focus();
	$('#hint_name').show();

	$('#hint_login').hide();
	$('#hint_pass').hide();

	$('#hint_empty_name').hide();
	$('#hint_empty_login').hide();
	$('#hint_empty_pass').hide();
});



function on_focus (code_button)
{
	$('#'+code_button).css("box-shadow", "none");
	$('#hint_name').hide();
	$('#hint_login').hide();
	$('#hint_pass').hide();

	$('#hint_empty_name').hide();
	$('#hint_empty_login').hide();
	$('#hint_empty_pass').hide();

	switch (code_button)
	{
		case 'name_new_guest':
			$('#hint_name').show();
		break;
		case 'pass_new_guest':
			$('#hint_pass').show();
		break;
	}
}


function on_blur (code_button)
{
	$('#hint_name').hide();
	$('#hint_login').hide();
	$('#hint_pass').hide();

	$('#hint_empty_name').hide();
	$('#hint_empty_login').hide();
	$('#hint_empty_pass').hide();

}




function reqister_new_guest()
{

	var name_new_guest  = $('#name_new_guest').val();
	var login_new_guest = $('#login_new_guest').val();
	var pass_new_guest  = $('#pass_new_guest').val();

	if (!login_new_guest || !pass_new_guest)
	{

		if (!login_new_guest)
		{
			$('#hint_login').hide();
			$('#hint_empty_login').show();
			$('#login_new_guest').css("box-shadow", "0 0 3px #D20000");
		};
		if (!pass_new_guest)
		{
			$('#hint_pass').hide();
			$('#hint_empty_pass').show();
			$('#pass_new_guest').css("box-shadow", "0 0 3px #D20000");
		};
		return(false);
	};

	$.ajax({
		type:'POST',
		dataype:'json',
		url:'/camera_/nina_guest_book_reqister_new_quest2.php',
		data:{
			login_new_guest: login_new_guest,
			pass_new_guest:  pass_new_guest
		},
		success: function(data){
				var login_free = jQuery.parseJSON( data );

				if(login_free)
				{
					window.location.href='index.php'
					location.href = "index.php?login="+login_free;

				} else{
					$('#hint_login').show();
					$('#login_new_guest').css("box-shadow", "0 0 3px #D20000");
				}

		}

	})
}

</script>
