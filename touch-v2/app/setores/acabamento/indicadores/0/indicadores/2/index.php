<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Touch v2</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <script src="/apex/touch-v2/dist/js/jquery.js"></script>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="sector">
        <div class="text-set">ACABAMENTO</div>
        <div class="chevron">
            <img style="margin-bottom:-2px;" src=" ../../chevron.png">
        </div>
        <div>
            FORNO MOTOSSERRA
        </div>
    </div>
    <div id="goalmeter">
        <div id="missing">
            <p id="title">Balanço:</p>
            <div class="unit">R$</div>
            <p id="value">0</p>
        </div>
    </div>
    <a href="#" class="btn home back-btn">
        <img src="../../back.png">
    </a>
    <div class="scene-3">
        <div class="chartframe">
            <canvas id="chart">
            </canvas>
        </div>
    </div>
    <script>
        $('.btn.home').on('click', function() {
            //History back
            window.history.back();
        })
        $(document).ready(function() {
            //Add R$ to indicators
            $('.left-indicator').each(function() {
                if ($(this).hasClass('day')) {

                } else {
                    var text = $(this).text();
                    $(this).text('R$ ' + text);
                }
            });
        });
    </script>
    <script src="/apex/touch-v2/dist/js/chart.js"></script>
    <script src="/apex/touch-v2/dist/js/plugin-datatables.js"></script>
    <script src="buildchart.js"></script>
</body>

</html>