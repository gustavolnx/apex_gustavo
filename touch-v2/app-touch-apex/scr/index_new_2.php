<?php
//Get this dir name
$dir = dirname(__DIR__, 4);
//Get last \ dir name
$dir = substr($dir, strrpos($dir, '\\') + 1);
//StrToUpper on $dir
$setor = strtoupper($dir);

//Get this dir name
$dir = dirname(__DIR__, 2);
//Get last \ dir name
$dir = substr($dir, strrpos($dir, '\\') + 1);
//StrToUpper on $dir
$area = strtoupper($dir);

// var_dump($area, $setor);

//Set links
$linkgeralplanta = "../../../../../app-touch-apex/index.html";
$linkgeralsetor = "";



# Coluna O e P
# O linha (objetivo)
# P abs do dia
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Touch v2</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <script src="/apex/touch-v2/dist/js/jquery.js"></script>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <!-- INDICATOR TITLE -->
    <div class="sector-maintext">
        <div class="text1">SCRAP</div>
        <div class="text2"></div>
    </div>
    <!-- SECTOR TITLE -->
    <div class="sector">
        <div>
            TRIANGULARES
        </div>
        <div class="chevron">
            <img src=" ../../chevron.png">
        </div>
        <div>
            GERAL
        </div>
    </div>

    <a href="./index.php" class="btn btn1 active">
        <img src="../../../../triangle.svg">
        <div class="text">TRIANGULARES</div>
    </a>
    <a href="./index2.php" class="btn btn2">
        <img src="../../../../circle.svg">
        <div class="text">REDONDAS</div>
    </a>
    <a href="./index3.php" class="btn btn3">
        <img src="../../../../square.svg">
        <div class="text">QUADRADAS</div>
    </a>
    <a href="./index4.php" class="btn btn4">
        <div class="text">SCRAP R$</div>
    </a>
    <a href="#" class="btn home back-btn">
        <img src="../../back.png">
    </a>
    <!-- BACKGROUND SCENE -->
    <div class="scene">
        <!-- CHARTJS -->
        <div class="frame-decoration"></div>

        <div id="chart-title">
            SCRAP PRODUÇÃO
            <div class="decoration"></div>
        </div>
        <div id="chartframe">
            <canvas id="chart">
            </canvas>
        </div>
        <div class="frame-decoration2"></div>

        <div id="chart-title2">
            SCRAP ACABAMENTO
            <div class="decoration"></div>
        </div>
        <div id="chartframe2">
            <canvas id="chart2">
            </canvas>
        </div>
    </div>
    <script>
        $(document).ready(function() {
            $(".btn.home").on("click", function() {
                //Location back
                window.location.href = "../../index.php";
            });
        });
    </script>
    <script src="/apex/touch-v2/dist/js/chart.js"></script>
    <script src="/apex/touch-v2/dist/js/plugin-datatables.js"></script>
    <script src="chart1.js"></script>
    <script src="chart2.js"></script>
</body>

</html>