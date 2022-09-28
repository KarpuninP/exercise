<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Exercise for practice</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <style>
        body {
            font-family:"arial", verdana Helvetica, sans-serif;
        }
        .h-bg{
            background: #D0D0D0;
            height: 180px;
        }
        .header{
           padding-top: 50px;
        }
        .header p {
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            letter-spacing: 6px;
            color: #FFFAF0;
            margin-top: 15px;
            margin-bottom: 15px;
            text-shadow: 7px -12px 4px rgba(18, 17, 17, 0.42);
            font-size: 29px;
        }

        .main-bg {
            background: #F5F5F5 ;
            padding: 50px 0;
        }
        .main-wrp{
            background: #f9f9f9;
            box-shadow: 0 0 10px rgba(19, 18, 18, 0.3);
            margin: 25px auto 0;
            padding: 21px;
            position: relative;
            width: 95%;
        }
        .card {
            margin: 10px;
        }
        .product-grids {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            flex-wrap: wrap;
            height: 100%;
        }

        .link {
            display: block;
            margin-top: 15px;
            padding: 21px;
            text-align: right;
        }
    </style>
</head>
<body>
<!-- нав -->
<div class="h-bg">
    <div class="container">
        <div class="header">
            <p>Exercise for practice</p>
        </div>
    </div>
</div>
<div class="main-bg">
    <div class="container">
        <div class="main-wrp">
            <div class="artists">
                <div class="product-grids">
                    <!-- карточки -->
                    <div class="card" style="width: 18rem;">
                        <img src="https://picsum.photos/150?random=1" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Cyrillic to Latin</h5>
                            <p class="card-text">On old phones there were no Cyrillic characters, to write a message you had to write in Latin characters. This translator will help you quickly write a message in Latin. </p>
                            <a href="/transcriptor_ru/transcriptor.php" class="btn btn-primary">Go to project</a>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="https://picsum.photos/150?random=2" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Shadow generator</h5>
                            <p class="card-text">jQuery practice. Simple css shadow generator</p>
                            <a href="/shadow_generator/start.php" class="btn btn-primary">Go to project</a>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="https://picsum.photos/150?random=3" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Practice in OOP: 'Little game'</h5>
                            <p class="card-text">A small board game, each player takes turns and rolls a dice, moving a figure into cells</p>
                            <a href="/oop_board_game/oop_board_game.php" class="btn btn-primary">Go to project</a>
                        </div>
                    </div>

                    <div class="card" style="width: 18rem;">
                        <img src="https://picsum.photos/150?random=4" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">Test Task №1</h5>
                            <p class="card-text">Small test task</p>
                            <a href="/test_task_1/start.php" class="btn btn-primary">Go to project</a>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>


<div class="footer">
    <div class="container">
        <p class="link"><span>© 2022  PHP Developer Karpunin P. All rights Reserved | <a href="https://github.com/KarpuninP/"> My github</a></span></p>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>
</html>
