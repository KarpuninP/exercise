<!DOCTYPE html>
<html lang="en">
   <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
      <title>Text shadow generator</title>
      <style>
         /* для всего поля что оринтеровка по середине и цвет фона */
         body {
            text-align: center;
            background-color: #eeeeee;
         }
         /* для меток блочные */
         label {
            display: block;
         }
         /* для текста, большие буквы, шрифт жирный, растояние между симболами 6px ,размер текста 40px, цвет чорный.
         отступ сверху и снизу 15 px*/
         h1 {
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 6px;
            color: #000000;
            margin-top: 15px;
            margin-bottom: 15px;
         }
         /* для вкладки range ширина все поле */
         input[type="range"] {
            width: 100%;
         }
         /* для вкладки color */
         input[type="color"] {
            border: none;     /* блочный элемент */
            background-color: transparent;
            width: 55px; /* ширина  */
            height: 55px; /* высота  */
            padding: 0;  /* внутрений отступ */
            margin-bottom: 15px;  /* внешний отступ низа  */
         }
         /* при наведение курсора изменяется */
         input[type="color"]:hover {
            cursor: pointer;
         }
         /* для текстового поля */
         textarea {
            width: 100%; /* ширина во всю колонку */
            resize: none;  /* запрет на изменение размер */
            margin-bottom: 15px; /* нижний отступ */
            min-width: 300px; /* минимальная щирина */
            font-size: 13px;  /* размер шрифта */
         }
         /* для карточек всего  */
         .card {
            height: 100%;  /* занять высоту всего поля, что бы были одинаковые по высоте */
         }
         /* название карточек */
         .card-header {
            font-weight: bold;  /* жирный шрифт */
            color: #ffffff;  /* цвет */
         }
         /* для дивов отступ внизу при моб версии*/
         .row > div {
            margin-bottom: 15px;
         }
      </style>
   </head>

   <body>
      <h1>Text shadow generator</h1>
      <!-- .container>.row>.col-xl-4.col-md-6*3>.card>.card-header+.card-body нажать на Tab (EMMET)-->
      <div class="container">
         <div class="row">
            <!-- Первая колонка -->
            <div class="col-xl-4 col-md-6">
               <div class="card">
                  <!-- название карточки -->
                  <div class="card-header bg-primary">Настройки:</div>
                  <!-- тело карточки - пуста -->
                  <div class="card-body"></div>
                  <!-- Дальше пулзунки -->
                  <!-- метка для "font_size" -->
                  <label for="font_size">Размер шрифта</label>
                  <!-- Тут у нас будет размер шрифта от 8-40 с шагом 1 значение по умолчанию 40 -->
                  <input class="custom-range" id="font_size" type="range" min="8" max="40" step="1" value="40">
                  <!-- метка для "offset_х" -->
                  <label for="offset_x">Смешение по оси x</label>
                  <!-- Тут у нас будет смешение тени от -15-15 с шагом 1 значение по умолчанию 4 -->
                  <input class="custom-range" id="offset_x" type="range" min="-15" max="15" step="1" value="4">
                  <!-- метка для "offset_y" -->
                  <label for="offset_y">Смешение по оси y</label>
                  <!-- Тут у нас будет смешение тени от -15-15 с шагом 1 значение по умолчанию -1 -->
                  <input class="offset_y" id="offset_y" type="range" min="-15" max="15" step="1" value="-1">
                  <!-- метка для "blur" -->
                  <label for="blur">Размытие</label>
                  <!-- Тут у нас будет размытие от 0-15 с шагом 1 значение по умолчанию 0 -->
                  <input class="offset_y" id="blur" type="range" min="0" max="15" step="1" value="0">
               </div>
            </div>

            <!-- Выбр цвета и его прозрачность -->
            <div class="col-xl-4 col-md-6">
               <div class="card">
                  <!-- название карточки -->
                  <div class="card-header bg-primary">Цвет:</div>
                  <!-- тело карточки -->
                  <div class="card-body">
                     <!-- выбр цвета, по умолчанию красный -->
                     <input type="color" value="#ff0000">
                     <!-- метка-->
                     <label for="opacity">Прозрачность</label><br>
                     <!-- Ползунок прозрачности от 0-1 с шагом 0.01 для точности, значение по умолчанию 1 -->
                     <input class="custom-range" id="opacity" type="range" min="0" max="1" step="0.01" value="1">
                  </div>
               </div>
            </div>

            <!-- вывод результата в текстовых полях -->
            <div class="col-xl-4 col-md-12">
               <div class="card">
                  <!-- наименование карточки-->
                  <div class="card-header bg-primary">Результат:</div>
                  <!-- тело карточки -->
                  <div class="card-body">
                     <!-- для HEX  -->
                     <label for="resultHex">Цвет в HEX</label>
                     <textarea id="resultHex" rows="4" readonly></textarea><br>
                     <!-- для RGBA  -->
                     <label for="resultRgba">Цвет в RGBA</label>
                     <textarea id="resultRgba" rows="3" readonly></textarea><br>
                  </div>
               </div>
            </div>
         </div>
      </div>   
      <script src="jquery-3.3.1.min.js"></script>
      <script>
         // создаем функцию которая включает в себя обьект (свойства и его значение)
         function cssShadow({
                 font_size,
                 offset_x,
                 offset_y,
                 blur,
                 opacity,
                 color,
                 rgba
         }) {
            // создаем переменную в ней будет хранится весь наш стиль в виде текстовой строки
            // создаем динамическую строку для наших стилей
            var cssStyles = offset_x + 'px ' + offset_y + 'px ' + blur + 'px ' + rgba;
            // меняем наш текст
            $('h1').css('text-shadow', cssStyles);
            // вывод в textarea в колонке для Hex
            $('#resultHex').val('background-color: ' + color + ';\nopacity: ' + opacity + '\nfont-size: ' + font_size + 'px;');
            // вывод в textarea для колонки с Rgba
            $('#resultRgba').val('text-shadow: ' + offset_x + 'px ' + offset_y + 'px ' + blur + 'px ' + rgba + ';\nfont-size: ' +
             font_size + 'px;');
         }

         // вызываем функцию с значению по умолчанию
         cssShadow({
            font_size: 40,
            offset_x: 4,
            offset_y: -1,
            blur: 0,
            opacity: 1,
            color: '#ff0000',
            rgba: 'rgba(255, 0, 0, 1)'
         });
         // обрабочик события input и change... первый аргумент это события, второй аргумент наш элемент и вызываем функцию
         $(document).on('input change', 'input', function () {
            // принимаем значение которые получаем от ползунков
            var font_size = $('#font_size').val();  // размер шрифта
            var offset_x = $('#offset_x').val();  // смешение по оси х
            var offset_y = $('#offset_y').val();  // смешение по оси y
            var blur = $('#blur').val();   // размытие
            var opacity = $('#opacity').val(); // прозрачность
            var color = $('input[type="color"]').val() + '';  // выбраный цвет #ff0000
            // переводим 16 цвет в rgba , берем наш колор #ff0000 и извлекаем его
            var red16 = color[1] + '' + color[2]; // примерно получаем 'ff'
            var green16 = color[3] + '' + color[4];
            var blue16 = color[5] + '' + color[6];
            // теперь переводим это в 10 ричную систему, для шестнадцатеричных чисел это основание
            // https://developer.mozilla.org/ru/docs/Web/JavaScript/Reference/Global_Objects/parseInt
            var red10 = parseInt(red16, 16); // тут получим 255
            var green10 = parseInt(green16, 16);
            var blue10 = parseInt(blue16, 16);
            // делаем динамическую строку параметров и прибовлям туда прозрачность
            var rgba = 'rgba(' + red10 + ', ' + green10 + ', ' + blue10 + ', ' + opacity + ')';

            // Изменение шрифта
            // применим размер шрифта
            $('h1').css('fontSize', font_size + 'px');
            // добовляем все переменные и атрибуты нашего обьекта для css свойств
            cssShadow({
               font_size: font_size,
               offset_x: offset_x,
               offset_y: offset_y,
               blur: blur,
               opacity: opacity,
               color: color,
               rgba: rgba
            });
         })
      </script>
   </body>
</html>