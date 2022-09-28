<?php

// Что я хочу релизовать ? -- Практика в ооп на примере настольной игры.
// Поле будет 20 ходов.
// от 2 до 6 игроков по очереди будут бросать кубик.
// На кубике будет выпадать до 6 ходов.
// на поле в 5,9,15 клетках будут бонусы (определенный шаги вперед или назад)
// Выграет тот  кто дойдет до финиша первым
//-------------------------------------------------------------------
// Запуск игры будет в консоле  php oop_board_game.php  или запуск сервера php -S localhost:8000

// У нас будет два класса.
// Класс Game тут будет все что касается игры
// Класс  Player тут будет все что касается игроков
/*
 * Делаем начальную шапку что бы можно было проверить что-то на работу способность.
 *
 * В class Player создаем свойства:
 * $name - тут будет имя игрока.
 * Дальше пишем конструктор, для установки в свойствах их значение. В получаем переменную $name.
 *
 * Теперь мы будем работать в class Game
 * Создаем 2 protected свойства $players (тут хранится массив класса Player) и $gameOver (тут хранится массив готовой игры)
 * Далее в конструкторе мы их получаем класса Player конвертировать его в массив и переносим в свойства.
 * Для проверки работоспособности создаем 2 метода start() и resultat()
 * В методе start() это стартовая точка то что будет запускаться поэтому туда помешаем методе resultat()
 * В методе resultat() - будет выдаваться результат
 * Для запуска игры у создаем new Game(new Player("P"), new Player("T")) и запускаем метод $game->start(); для запуска
 * Запускаться, либо в консоли, либо на сервере
 * В class Game метод start() смотрим что в var_dump($this->players); и  подключаем метод resultat() в нем пишем
 *echo <<<EOT
            Game over
        EOT;
 * проверяем работоспособность кода.
 *
 * Далее пишем логику нашей игры, Создаем методы.
 * - Метод flip() - отвечает за бросок кубика, через рандом от 1-6
 * - Метод gameField() - это у нас будет игровая доска, мы пройдемся по списку имен игроков gamerName(), создадим массив
 * и вложим туда историю ходом render(). Это у нас будет массив из имени, количество очков, какие очки вышли (брошенные кубики)
 * число брошенного кубика (ходов), время хода - эти данные каждого игрока. Мы возращая запустив метод whoWon() и туда положили
 * данные которые получили в массиве. Этот метод будет определять кто выиграл и перемешать его будет в нулевой ключ (всегда сверху).
 * - Метод gamerName($players) получает в себя свойства $players. Он проходит циклом по массиву то что мы получили от class Player
 * и проверяет на пустоту. Далее создает массив с именами игроков и возвращает их.
 * - Метод render($name, $numbPersn) принимает в себя имя игрока и его очередность. Этот метод создает историю ходов каждого игрока.
 * Создаем для начального отсчета пустые переменные. $numberMovesT - будет записывать какие кубики выпали (строка),
 * $numberMoves - очки(общие число ходов), $timeDrop - время броска
 * Для этого нам в цикл надо пройтись по ходам и остановится только в том случае если у игрока будет больше или равно 20 очкам
 * С начало мы запускаем метод flip() он эмулирует бросок кубика и ложем в переменную $drop.
 * Далее мы генерируем время броска с помощь метода timeDrop($drop), где $drop это какой кубик выпал, складываем число на
 * предыдущие число, которое записано в переменно $timeDrop и перезаписываем ее. Так же само мы заполняем переменную
 * $numberMoves просто складываем те очки которые выпали с кубиков. А в переменной $numberMovesT мы эти очки, которые выпали
 * с кубиков, просто записываем в строку.
 * Дальше пишем условия бонусов, если игрок попадет на определенную клетку то ему прибавляется или отнимаются очки и записывается
 * это определенной буквой к переменной $numberMovesT. Тут есть костыль, что бы отразить ход назад я дублировал букву, что
 * бы было больше бросков, так мы определим кто выиграет. Выходим из цикла.
 * В переменную $recalculationSum мы записываем сколько было ходов по переменной $numberMovesT (считаем количество симболов)
 * В переменную $numbPersn мы прибовляем 1 что бы избавится от нуля (очередность игрока, берется по ключу из масива)
 * И дальше мы это все возвращаем массивом в метод whoWon().
 * - В методе whoWon($playersArray) мы берем массив то что получили в методе render() и благодаря встроенной функции usort()
 * отсортировываю массив по заданным данным, а это у нас по количеству брошенных кубиков и очередность. Чем меньше эти данные
 * тем выше игрок в массиве. Так сказать таблица победителей. И это все возвращаю обратно, в метод start() и записываю в
 * свойства gameOver, то что у нас получилось.
 * - Метод bonusInfo() он у нас красиво показывает сделанные ходы и расшифровывает буквенное обозначение бонусов.
 * Мы перемешаем в переменную $data то что находится в свойствах gameOver первого игрока его выдачу очков.
 * Создаем строку в переменной $consilience, сюда мы будем класть совпадение, что бы по нему могли найти бонусные буквы.
 * И дальше пишем логику если в строке которая к нам пришла находим определенную бонусную букву, то в переменню
 * $info засовываем текст который надо выдать, а в переменную $consilience буква которая пришла.
 * Далее нам надо заменить эту бонусную букву, на текстовое сообщение и красиво это все показать. Для этого делаем пару манипуляций.
 * Переводим строку в массив, ишим указанную букву и выдаем ключ массива. И по этому ключу меняем его значение на то что нам надо.
 * Обратно все переводим в строку. Делаем логику и смотрим если то что нам пришло есть буквы, то меняем на текст, если нет
 * то выдаем красиво, то что нам пришло.
 * - Метод timeDrop($dice) - отвечает за время хода. Принимает число то что получили от кубика, и через рандом он выбирает число
 * от 1 и до того что получили. Делим это все на 1.5 и округляем в большую сторону. Это у нас будет время хода пешки по доске.
 * Прибавляем к этому всему 5 секунд (время броска кубика) и выходит время хода в секундах.
 * - Метод totalTime() он выдает красиво время всей игры. Просто проходимся циклом по массиву, от тудого берем время каждого
 * игрока который сделал ход и складываем все. Далее высчитываем минуты и секунды, красиво все возвращаем.
 */

class Player {
    public $name;

    public function __construct(string $name) {
        $this->name = $name;
    }
}

class Game {

    protected $players;
    protected $gameOver;



    public function __construct(Player $player1, Player $player2, Player $player3 = NULL, Player $player4 = NULL, Player $player5 = NULL, Player $player6 = NULL)
    {
        $this->players = [(array)$player1, (array)$player2, (array)$player3, (array)$player4, (array)$player5, (array)$player6];
    }

    // Бросок кубика
    public function flip() {
        return rand(1, 6);
    }


    // Время хода
    public function timeDrop($dice) {
        $time = ceil(rand(1, $dice) / 1.5);
        return $time + 5 ;
    }

    // Общее время всей игры
    public function totalTime() {
        $time = 0;
        foreach ($this->gameOver as $v1) {
                 $time += $v1['timeDrop'];
        }
        $minD = $time / 60;
        $min =  floor($minD);
        $sec = ($minD - $min) * 60;
        return $min . ' минуты и ' . $sec . ' секунд' ;
    }

    // красиво показывает сделанные ходы и расшифровывает буквенное обозначение бонусов
    public function bonusInfo(){
        $data = $this->gameOver[0]['recalculation'];
        $consilience = '';
        if (strripos($data, 'a')) {
            $info = 'Вы перешли на 3 хода в перед';
            $consilience = 'a';
        } elseif (strripos($data, 'c')) {
            $info = 'Вы перешли на 3 хода в перед';
            $consilience = 'c';
        } elseif (strripos($data, 'bb')) {
            $info = 'Вы перешли на 3 хода в перед';
            $consilience = 'bb';
        }

        // разбиваю строку на символы и перекидываю в массив
        $dataArr = str_split($data);
        // ищем значение в массиве и возвращаем его ключ   https://www.php.net/manual/ru/function.array-keys.php
        $dataSearchKeys = array_keys($dataArr, $consilience);

        // проверяем на пустоту, если есть то работаем дальше
        if (!empty($dataSearchKeys)) {
            // заменяем значение в массиве   https://www.php.net/manual/ru/function.array-keys.php
            $dataReplaceKey = array_fill_keys($dataSearchKeys, $info );
            // Ставим значение то которое заменили по ключу   https://www.php.net/manual/ru/function.array-replace.php
            $dataReplaceAll = array_replace($dataArr, $dataReplaceKey);
            // Массив переводим в строку
            $dataStr = implode(", ", $dataReplaceAll);
            return $dataStr;
        }else {
            return  $dataStr = implode(", ", $dataArr);
        }
    }

    // Сортирует массив тот кто выиграл всегда сверху
    public function whoWon($playersArray) {
        $key1 = 'recalculationSum';
        $key2 = 'numbPersn';

        usort( $playersArray, function ($a, $b) use ($key1, $key2) {
            if ($a[$key1] == $b[$key1] && $a[$key2] == $b[$key2]) {
                return 0;
            }elseif ($a[$key1] == $b[$key1] & $a[$key2] < $b[$key2]) {
                return -1;
            }
            return ($a[$key1] < $b[$key1] & $a[$key2] < $b[$key2])? -1 : 1;
        });
        return $playersArray;
    }

    // делает историю ходов с добавлением бонусами
    public function render($name, $numbPersn) {
        $numberMovesT = '';
        $numberMoves = 0;
        $timeDrop = 0;
        while ($numberMoves <=  20) {
            $drop = $this->flip();
            $timeDrop += $this->timeDrop($drop);
            $numberMoves += $drop;
            $numberMovesT .= $drop;
            if($numberMoves == 5) {
                $numberMoves = $numberMoves + 3;
                $numberMovesT .= 'a';
            } elseif($numberMoves == 9) {
                $numberMoves = $numberMoves - 2;
                $numberMovesT .= 'bb';
            } elseif($numberMoves == 15) {
                $numberMoves = $numberMoves + 3;
                $numberMovesT .= 'c';
            }
        }
        $recalculationSum = strlen($numberMovesT);
        $numbPersn++;
        return ['name'=>$name,'total'=>$numberMoves,  'recalculation'=>$numberMovesT, 'recalculationSum'=>$recalculationSum,
            'numbPersn'=> $numbPersn, 'timeDrop'=>$timeDrop ];
    }

    // получение имя игрока
    public function gamerName($players) {
        foreach ($players as $v) {
            if(!empty($v)) {
                $name[]= $v['name'];
            }
        }
        return $name;
    }

    // Игровая доска
    public function gameField() {
        foreach ($this->gamerName($this->players) as $k=>$v) {
            $playersArray[] = $this->render($v,$k) ;
        }
        return $this->whoWon($playersArray);
    }

    // Запуск игры
    public function start()
    {
        // Запуск игры
        $this->gameOver = $this->gameField();
        // Подключение вывод результатов
        $this->resultat();
//        var_dump($this->players);
        var_dump($this->gameOver);
    }

    // Результат
    public function resultat() {
        echo <<<EOT
            Game over <br>
            Выйграл: {$this->gameOver[0]['name']}<br>
            Выпали такие кубики:  {$this->bonusInfo()}<br>
            Обшие время игры: {$this->totalTime()}<br><br>
            Нажмите обновить в броузере, что бы начать заного.<br><br>
            Результаты по учасникам:
        EOT;
    }
}


$game = new Game(
    new Player("Roma"),
    new Player("Tolik"),
    new Player("Kiril"),
    new Player("Bob"),
    new Player("Nike")
);
$game->start();
