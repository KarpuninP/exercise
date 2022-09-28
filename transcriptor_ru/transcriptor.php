<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST['send'])) {   // Проверка сто кнопка отправить была нажата

    $text = isset($_POST['text']) ? $_POST['text'] : '';   // что бы тут что-то было, если нечего нет то прейдёт пустота
    $lenText = strlen($text);
    if (!$lenText || $lenText < 1 || $lenText > 500) {  // Проверка, что было хотя бы от 1 до 500 симболов
        exit('Text must be more 1 to 500 symbols');
    }
    $chr_ru = "А-Яа-яЁё0-9\s`~!@#$%^&*()_+-={}|:;<>?,.\/\"\'\\\[\]"; // рурские символы
    if (!preg_match("/^[$chr_ru]+$/u", $text)) {    // Проверяет что только были русские символы
        exit('Only Russian symbols');
    }
    $sbl = [" ", "~", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "_", "+", "-", "=", "{", "}", "|", ":", ";",
        "<", ">", "?", ",", ".", "\/", "\"", "\'", "\\", "\[", "\]"];  // символы для удаление

    $text = filter_var($text, FILTER_SANITIZE_FULL_SPECIAL_CHARS);  // убирает запрещенные символы
    $text = str_replace($sbl, "NN", "$text");  // заменяет символы на знак
}

function translate ($str) {  // словарь (замена на английские символы)
    $simbl = [
        'NN'=> ' ',
        'а'=> 'a',
        'б'=> 'b',
        'в'=> 'v',
        'г'=> 'g',
        'д'=> 'd',
        'е'=> 'e',
        'ё'=> 'yo',
        'ж'=> 'zh',
        'з'=> 'z',
        'и'=> 'i',
        'й'=> 'j',
        'к'=> 'k',
        'л'=> 'l',
        'м'=> 'm',
        'н'=> 'n',
        'о'=> 'o',
        'п'=> 'p',
        'р'=> 'r',
        'с'=> 's',
        'т'=> 't',
        'у'=> 'y',
        'ф'=> 'f',
        'х'=> 'x',
        'ц'=> 'ts',
        'ч'=> 'ch',
        'ш'=> 'sh',
        'щ'=> 'w',
        'ъ'=> '',
        'ы'=> 'u',
        'ь'=> '',
        'э'=> 'e',
        'ю'=> 'ju',
        'я'=> 'ya',
        'А'=> 'A',
        'Б'=> 'B',
        'В'=> 'v',
        'Г'=> 'g',
        'Д'=> 'D',
        'Е'=> 'E',
        'Ё'=> 'Yo',
        'Ж'=> 'Zh',
        'З'=> 'Z',
        'И'=> 'I',
        'Й'=> 'J',
        'К'=> 'K',
        'Л'=> 'L',
        'М'=> 'M',
        'Н'=> 'N',
        'О'=> 'O',
        'П'=> 'P',
        'Р'=> 'R',
        'С'=> 'S',
        'Т'=> 'T',
        'У'=> 'Y',
        'Ф'=> 'F',
        'Х'=> 'X',
        'Ц'=> 'Ts',
        'Ч'=> 'Ch',
        'Ш'=> 'Sh',
        'Щ'=> 'W',
        'Ъ'=> '',
        'Ы'=> 'U',
        'Ь'=> '',
        'Э'=> 'E',
        'Ю'=> 'Ju',
        'Я'=> 'Ya'
    ];
    $word = '';
    $arr = str_split($str, 2);  // строку превращаем в массив, русские символ имеет 2 байта (2 инглиш символа)
    foreach ($arr as $value ) {  // идет перебор и заменяет на английские символы
        $letter = $simbl[$value];
        $word .= $letter;  //  добавляет символ к символу
    }
    return $word;
}

$rest = translate($text);  // запуск функции

?>

<!DOCTYPE html>
<html lang="ru" xmlns="http://www.w3.org/1999/html">     <!-- язык контента -->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">            <!-- Что бы работал для броузера IE  -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  <!-- для мобильной версии размер -->
        <title>Translator</title>
        <style>
            body {                       /* вставляем картинку для фона */
                background: url("https://clipart-db.ru/file_content/rastr/background_019.jpg") center center no-repeat;
                background-size: unset;
            }

            .wrap {
                max-width: 1000px;        /* Не дает шире стать */
                min-width: 320px;        /* Для ползунка прокрутки */
                margin: 200px auto;          /* Центрирование */
            }

            .wrap .translate {           /* выравнивание */
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
            }

            .wrap .translate .post {          /* блок для правильного отображение */
                display: flex;
                flex-direction: column;
                justify-content: center;
                background: #00FFFF;
                height: auto;
                width: 320px;
            }

            .wrap .post form {              /* выравнивание */
                display: flex;
                flex-direction: column;
            }

            .wrap .post form label {         /* стили для метки */
                display: block;
                background-color: #7FFFD4;
                margin: 3px;
            }

            .wrap .post form .text {           /* стили для поле вода текста */
                display: block;
                width: 300px;
                margin: 7px;
            }

            .wrap .post form input {
                display: block;
            }

            .wrap .post span {                /* стили для вывода текста */
                display: block;
                background-color: #E0FFFF;
                margin: 50px;
                padding: 5px;
                border: 3px solid black;
                font-size: 1.5rem;
                white-space: pre-wrap;
            }

        </style>
    </head>
    <body>
        <div class="wrap">
            <div class="translate">
                <div class="post">
                    <form  method="post" >
                        <label> текст для перевода в транслит
                            <textarea class="text" name="text" id="text" placeholder="ведите текст для перевода в транслит"></textarea>
                        </label>
                        <input type="submit" value="Отправить" name="send">
                    </form>
                    <span><?php echo $rest; ?></span>
                </div>
            </div>
        </div>
    </body>
</html>















