<?php
//Get this dir name
$dir = __DIR__;
//Get last \ dir name
$dir = substr($dir, strrpos($dir, '\\') + 1);
//StrToUpper on $dir
$area = strtoupper($dir);

//Get this dir name
$dir = dirname(__DIR__, 2);
//Get last \ dir name
$dir = substr($dir, strrpos($dir, '\\') + 1);
//StrToUpper on $dir
$setor = strtoupper($dir);

//Set links
$linkgeralplanta = "../../../../../app-touch-apex/index.html";
$linkgeralsetor = "../geral/index.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Touch v2</title>
    <script src="/apex/touch-v2/dist/js/jquery.js"></script>
    <link rel="stylesheet" href="./styles.css">
</head>

<body>
    <div class="text">
        <div>
            ACABAMENTO
        </div>
        <div class="chevron">
            <img src=" ./chevron.png">
        </div>
        <div>
            SELOVAC
        </div>
    </div>
    <a href="../../../../hub/index.php" class="btn home">
        <img src="./home.png">
    </a>
    <a href="#" class="btn back">
        <img src="./back.png">
    </a>
    <a href="./indicadores/0/index.php" class="btn1 btn-0">
        <div class="text">
            SEGURANÇA
        </div>
    </a>
    <a href="./indicadores/1/index.php" class="btn1 btn-1">
        <div class="text">
            EFICIÊNCIA
        </div>
    </a>
    <a href="./indicadores/2/index.php" class="btn1 btn-2">
        <div class="text">
            ABSORÇÃO
        </div>
    </a>
    <!-- <a href="./indicadores/3/index.php" class="btn1 btn-3">
        <div class="text">
            SCRAP
        </div>
    </a> -->

    <!-- <a href="./indicadores/4/index.php" class="btn1 btn-4">
        <div class="text">
            OPEX
        </div>
    </a> -->
    <!-- <a href="./indicadores/5/index.php" class="btn1 btn-3">
        <div class="text">
            GASTOS
        </div>
    </a> -->
    <!-- <a href="./indicadores/6/index.php" class="btn1 btn-5">
        <div class="text">
            5S
        </div>
    </a> -->
    <a href="<?= $linkgeralplanta ?>" class="btn2 btn-7">
        <div class="text">
            GERAL PLANTA
        </div>
    </a>
    <a href="<?= $linkgeralsetor ?>" class="btn2 btn-8">
        <div class="text">
            GERAL ACABAMENTO
        </div>
    </a>
    <script>
        $(document).ready(function() {
            $(".btn.back").click(function() {
                window.history.back();
            });
        });
    </script>
</body>

</html>