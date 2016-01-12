cyl = {

};  // Это самый главный объект в котором хранятся все перемен и ф-ции. Т.е. это пространство имён


cyl.oParametrs = {}

cyl.init = function ()
{

	cyl.ini_parameters();			//Здесь нужно указывать все функции которые будут использоваться
	cyl.reset_button();			//Здесь нужно указывать все функции которые будут использоваться
	cyl.input_int();			//Здесь нужно указывать все функции которые будут использоваться
	cyl.mov();					//Здесь нужно указывать все функции которые будут использоваться

}

cyl.input_int = function () //  нажатие на кнопки-цифры
{
	$('.buttons').on('click', function(e)
	{
		var aInt = $(e.currentTarget).html();
		if(cyl.oParametrs.tmp_move)				// смотрим, если это первая цифра
		{
			$('#total_field').html(aInt);		// ... то просто присваиваем значение полю
			cyl.oParametrs.tmp_move = false;	// , и говорим что мы ничего не плюсуем
		}
		else
		{
			$('#total_field').append(aInt);		// ... если нет, то добавляем в конец
		}
		cyl.oParametrs.tmp_data = $('#total_field').html();
		cyl.oParametrs.push_int = true;
	});
}

cyl.mov = function ()					// нажатие на кнопки +;-;*;/;=
{
	$('.spec_button').on('click', {this:this}, function(e)
	{
		var that = e.data.this;						// принимаем все переменные из пространства cyl
		if(that.oParametrs.push_int || (that.oParametrs.save_move_tmp != that.oParametrs.save_move))				// проверяем чтобы при нажатии ++ не происходило два действия. Устанавливается когда нажимаем кнопку int
		{

			if(!that.oParametrs.push_int && (that.oParametrs.save_move_tmp != that.oParametrs.save_move))
			{
				that.oParametrs.save_move = $(e.currentTarget).html();			// записываем какое действие мы хотим сделать с числами
				that.oParametrs.tmp_f = $('#total_field').html() + ' ' + $(e.currentTarget).html() + ' ';
				$('#tmp_field').html(that.oParametrs.tmp_f);	// выводим содержимое маленького(верхнего) поля на экран
				return;
			}
			else
			{
				that.oParametrs.tmp_f += $('#total_field').html() + ' ' + $(e.currentTarget).html() + ' '; // записываем в простую переменную содержание маленького(верхнего поля), т.е. переписываем нажатое действие
				//console.log(that.oParametrs.tmp_f);
			}
			$('#tmp_field').html(that.oParametrs.tmp_f);	// выводим содержимое маленького(верхнего) поля на экран



			if(that.oParametrs.tmp_data2)  // проверяем есть ли у нас в буфере число с которым нужно сделать save_move
			{
				that.oParametrs.tmp_data2 = that.summa(that.oParametrs.tmp_data, that.oParametrs.save_move, that.oParametrs.tmp_data2); // если есть, то перезаписываем его через вызов нашей арифметической функции
			}
			else
			{
				that.oParametrs.tmp_data2 = that.oParametrs.tmp_data; // если буфер пуст - записываем туда число cyl.oParametrs.tmp_data = $('#total_field').html();
			}
			if($(e.currentTarget).attr('id') == 'btn_equal')
			{
				$('#tmp_field').html('');
				that.oParametrs.tmp_f = '';
			}
			$('#total_field').html(that.oParametrs.tmp_data2);   // выводим результат на экран в нижнем(большом окне)

			that.oParametrs.save_move_tmp = that.oParametrs.save_move;
			that.oParametrs.push_int = false;		// сбрасываем флаг о том что последней была нажата числовая кнопка
		}
		that.oParametrs.save_move = $(e.currentTarget).html();  // записываем действие которое нужно введёнными сделать с числами
		that.oParametrs.tmp_move = true;

	});
}

cyl.ini_parameters = function()
{
	cyl.oParametrs.save_move = "";			// Нажатое действие
	cyl.oParametrs.tmp_f = "";				// Верхняя строка, которая показывает 5 + 2 + 7 + ...
	cyl.oParametrs.tmp_data = 0;			// Временно сохраненное число(Первое)
	cyl.oParametrs.tmp_data2 = 0;			// Временно сохраненное число(Второе)
	cyl.oParametrs.tmp_move = true;			// Флаг. Говорит о том что мы что-то плюсуем
	cyl.oParametrs.push_int = false;		// Флаг. Для того чтобы не происходило каких-либо действий при повторном нажатии на "+"
	cyl.oParametrs.save_move_tmp = "";		// Для того чтобы не происходило каких-либо действий при повторном нажатии на "+"
	$('#total_field').html('');
	$('#tmp_field').html('');
}

cyl.reset_button = function ()
{
	$('#btn_C').on('click', {this:this}, function(e)
	{
		cyl.ini_parameters();
	});
}


cyl.summa = function (int1, what, int2)
{
	var sum = 0;
	var num1 = parseFloat(int1);
	var num2 = parseFloat(int2);
	switch (what)
			{
				case "+":
					sum = num2 + num1;
					break;
				case "-":
					sum = num2 - num1;
					break;
				case "*":
					sum = num2 * num1;
					break;
				case "/":
					if(num1 == 0)
					{
						sum = 'Деление на 0 невозможно';
					}
					else
					{
						sum = num2 / num1;
					}
					break;
			}
			console.log(typeof sum);
	return parseFloat(sum);
}

$('#ii').bind("click", function(event){
	console.log('hhhhhhhh');
  var str = "( " + event.pageX + ", " + event.pageY + " )";
  alert("ffff " + str);
});


$(document).ready(function(e)
{
	cyl.init();   				// Это запуск ф-ции инициализации, а в ней все фукции.
});

// $ - ээто объект jquery
// $('.className') - обращаемся к элементам этого класса
// $('#classID')
// $('div') - обращение ко всем div-ам
// $('div.className') - обращение ко всем div-ам класса className
// $('div.className').Конструкция котороая нужна(напр. show()) - действия с объектом
// $(e.currentTarget).attr('id') - получение ID нажатого элемента

//window.frames[]	Все фреймы - т.е. объекты, отвечающие контейнерам <FRAME>
//document.all[]	Все объекты, отвечающие контейнерам внутри контейнера <BODY>
//document.anchors[]	Все якоря - т.е. объекты, отвечающие контейнерам <A>
//document.applets[]	Все апплеты - т.е. объекты, отвечающие контейнерам <APPLET>
//document.embeds[]	Все вложения - т.е. объекты, отвечающие контейнерам <EMBED>
//document.forms[]	Все формы - т.е. объекты, отвечающие контейнерам <FORM>
//document.images[]	Все картинки - т.е. объекты, отвечающие контейнерам <IMG>
//document.links[]	Все ссылки - т.е. объекты, отвечающие контейнерам <A HREF="..."> и <AREA HREF="...">
//document.f.elements[]	Все элементы формы с именем f - т.е. объекты, отвечающие контейнерам <INPUT> и <SELECT>
//document.f.s.options[]	Все опции (контейнеры <OPTION> ) в контейнере <SELECT NAME=s> в форме <FORM NAME=f>
//navigator.mimeTypes[]	Все типы MIME, поддерживаемые браузером (список см. на сайте IANA)
//function_name.arguments[]	Все аргументы, переданные функции function_name() при вызове