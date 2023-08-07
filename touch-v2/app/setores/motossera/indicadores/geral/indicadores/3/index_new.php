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
    <div class="sector" style="width:900px;line-height:30px;">
        <div style="font-size:50px;">
            MOTOSSERRA
        </div>
        <div class="chevron">
            <img style="height:35px;" src=" ../../chevron.png">
        </div>
        <div style="font-size:50px;">
            GERAL
        </div>
    </div>

    <a href="./index_new.php" class="btn btn4">
        <div class="text">SCRAP R$</div>
    </a>
    <a href="./index.php" class="btn btn5">
        <div class="text">SCRAP %</div>
    </a>

    <a href="#" class="btn home back-btn">
        <img src="../../back.png">
    </a>
    <!-- BACKGROUND SCENE -->
    <div class="scene">
        <!-- CHARTJS -->
        <div class="frame-decorationval1"></div>

        <div id="chart-title">
            SCRAP EM R$
            <div class="decorationval1"></div>
        </div>
        <div id="chartframeval1">
            <canvas id="chartval1">
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
    <script src="chartval1.js"></script>
</body>

</html>