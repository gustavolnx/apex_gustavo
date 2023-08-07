<?php
## COLUNAS H E J
# J linha do meio (objetivo)
# H eficiência do dia
@include('csv.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Touch v2</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <script src="../jquery.js"></script>
    <style>
        * {
            -webkit-user-select: none;
            /* Safari */
            -ms-user-select: none;
            /* IE 10 and IE 11 */
            user-select: none;
            /* Standard syntax */
        }

        @font-face {
            font-family: MontserratBold;
            src: url(../fonts/Montserrat-Bold.ttf);
        }

        @font-face {
            font-family: MontserratRegular;
            src: url(../fonts/Montserrat-Regular.ttf);
        }

        @font-face {
            font-family: MontserratExtraBold;
            src: url(../fonts/Montserrat-ExtraBold.ttf);
        }

        html,
        body {
            height: 100%;
            width: 100%;
            margin: 0;
            padding: 0;
            overflow: hidden;

            background-color: #15171b;
        }

        .scene-1,
        .scene-2,
        .scene-3 {
            display: none;
            height: 100%;
            width: 100%;
        }

        .scene-1 {
            background-image: url('1.png');
            background-size: contain;
        }

        .scene-2 {
            background-image: url('2.png');
            background-size: cover;
        }

        .scene-3 {
            background-image: url('3.png');
            background-size: cover;
        }

        .monthday {
            font-family: MontserratBold;
            font-size: 65px;
            color: #ffffff;
            position: absolute;
            top: 38%;
            left: 47%;
            transform: translate(-50%, -50%);
        }

        .yesterday>.year {
            font-family: MontserratRegular;
            font-size: 45px;
            color: #ffffff;
            position: absolute;
            top: 44.5%;
            left: 28%;
            transform: translate(-50%, -50%);
        }

        .acum>.year {
            font-family: MontserratRegular;
            font-size: 45px;
            color: #ffffff;
            position: absolute;
            top: 44.5%;
            left: 47%;
            transform: translate(-50%, -50%);
        }

        .budget>.year {
            font-family: MontserratRegular;
            font-size: 45px;
            color: #ffffff;
            position: absolute;
            top: 44.5%;
            left: 76%;
            transform: translate(-50%, -50%);
        }

        .percent {
            font-family: MontserratBold;
            font-size: 90px;
            color: #ffffff;
        }

        .budget>.percent {
            position: absolute;
            top: 62%;
            left: 20%;
            transform: translate(-50%, -50%);
        }

        .yesterday>.percent {
            position: absolute;
            top: 62%;
            left: 47%;
            transform: translate(-50%, -50%);
        }

        .acum>.percent {
            position: absolute;
            top: 62%;
            left: 76%;
            transform: translate(-50%, -50%);
        }

        .graph {
            position: absolute;
            top: 53%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 90%;
            height: 75%;
        }

        .graph>.lines {
            position: absolute;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 95%;
            height: 88%;
            z-index: 5;
        }

        .graph .left-indicator {
            font-size: 20px;
            font-family: MontserratExtraBold;
            color: #ffffff;
        }

        .left-indicator.low {
            position: absolute;
            top: 88%;
            left: 0.5%;
            transform: translate(-50%, -50%);
        }

        .left-indicator.mid {
            position: absolute;
            top: 45%;
            left: -3%;
            transform: translate(-50%, -50%);
        }

        .left-indicator.max {
            position: absolute;
            top: 2.2%;
            left: 0.5%;
            transform: translate(-50%, -50%);
        }

        .left-indicator.day {
            position: absolute;
            top: 93%;
            left: 4.5%;
            transform: translate(-50%, -50%);
        }

        #bars {
            position: relative;
            top: calc(44% + 8px);
            left: 51.5%;
            transform: translate(-50%, -50%);
            width: 92%;
            height: 88%;
        }

        .bar-wrapper {
            display: inline-block;
            width: 4.5%;
            margin-inline: 5px;
            height: 98.9%;
            transform: translateY(-10px);
        }

        .bar-top {
            display: inline-block;
            width: 100%;
            height: calc(100% - 30%);
            background-color: #088708;
            top: 4px;
            position: relative;
        }

        .bar {
            display: inline-block;
            width: 100%;
            height: calc(100% - 70%);
            background-color: #ff0000;
        }

        .bar>.text {
            position: relative;
            top: 1%;
            font-family: MontserratExtraBold;
            font-size: 20px;
            color: #fff;
            text-align: center;
        }

        .bar-title {
            display: inline-block;
            width: 100%;
            height: 8%;
            background-color: #fff;
        }

        .bar-title>.text {
            position: relative;
            top: 50%;
            font-family: MontserratExtraBold;
            font-size: 20px;
            color: #447dbb;
            text-align: center;
        }

        .bar-top>.text {
            position: relative;
            top: 1%;
            font-family: MontserratExtraBold;
            font-size: 20px;
            color: #fff;
            text-align: center;
        }

        .back-btn {
            position: absolute;
            top: calc(95% - 10px);
            left: 3.5%;
            transform: translate(-50%, -50%);
            z-index: 10;
            width: 75px;
        }

        .chevron-right {
            position: absolute;
            top: 50%;
            left: 98%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        .chevron-left {
            position: absolute;
            top: 50%;
            left: 2%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        #midline {
            position: absolute;
            left: 48%;
            transform: translate(-50%);
            width: 97%;
            height: 7px;
            background-color: #ffffff;
            z-index: 5;
        }

        #slider {
            position: absolute;
            top: 1%;
            left: 2.7%;
            width: 100%;
            height: 86.5%;
            z-index: 10;
            /* border: 5px solid red; */
        }


        .btn {
            transform: translate(-50%, -50%);
            background-color: rgba(7, 52, 110, 0.7);
            border: 1px solid #fff;
        }

        .btn:hover {
            cursor: pointer;
        }

        .btn>img {
            position: absolute;
            width: 75%;
            height: 65%;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .btn.back {
            border-radius: 50%;
            position: absolute;
            top: 93%;
            left: 3.3%;
            height: 75px;
            width: 75px;
        }

        #goalmeter {
            display: none;
            position: absolute;
            top: 5.5%;
            right: 3%;
            width: 250px;
            height: 100px;
            z-index: 10;
        }

        #goalmeter>#missing {
            text-align: center;
            font-family: MontserratExtraBold;
        }

        #goalmeter>#missing>#title {
            font-size: 25px;
            line-height: 5px;
            color: #ffffff;
        }

        #goalmeter>#missing>#value {
            font-size: 35px;
            line-height: 5px;
            color: #ff0000;
            display: inline;

        }

        #goalmeter>#notmissing {
            text-align: center;
            font-family: MontserratExtraBold;
        }

        #goalmeter>#notmissing>#title {
            font-size: 25px;
            line-height: 5px;
            color: #ffffff;
        }

        #goalmeter>#notmissing>#value {
            font-size: 35px;
            line-height: 5px;
            color: #088708;
            display: inline;
        }

        .unit {
            display: inline;
            font-size: 25px;

        }
    </style>
</head>

<body>

    <a id="back_btn" class="btn back back-btn">
        <img src="../../app/common/back.png" />
    </a>
    <div style="width:50px;" class="chevron-right">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="white" class="bi bi-chevron-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
    </div>
    <div style="width:50px;" class="chevron-left">
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="white" class="bi bi-chevron-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
        </svg>
    </div>

    <div class="scene-1"></div>
    <div class="scene-2">
        <div class="budget">
            <div class="year">9999</div>
            <div class="percent">
                <?= $budget; ?>
            </div>
        </div>
        <div class="yesterday">
            <div class="monthday"><?= $monthday ?></div>
            <div class="year">9999</div>
            <div class="percent">
                <?= $yesterday; ?>
            </div>
        </div>
        <div class="acum">
            <div class="year">9999</div>
            <div class="percent">
                <?= $acum; ?>
            </div>
        </div>
    </div>
    <div class="scene-3">
        <div class="graph">
            <div class="left">
                <div class="left-indicator max"></div>
                <div id="slider">
                    <div class="left-indicator mid"></div>
                    <img id="midline" src="./mid-line.png" alt="">
                </div>
                <div class="left-indicator low"></div>
                <div class="left-indicator day">
                    DIA
                </div>
            </div>
            <img class="lines" src="./graph-lines.png">
            <div id="bars">
                <div style="display:inline-block;width:1px;height:103.5%;"></div>
                <?php
                $objetivo = str_replace('%', '', $info[1]['objetivo']);
                $objetivo = str_replace(',', '.', $objetivo);
                $objetivo = round($objetivo, 0);
                // var_dump($objetivo);
                $index = 0;
                $contains = 0;
                $media = 0;
                foreach ($info as $key => $value) {
                    if (isset($value['shortvalue'])) {
                        $val = $value['shortvalue'];
                    } else {
                        $val = $value['value'];
                    }
                    $day = $value['day'];
                    if ($val == 0) {
                        // if ($index > 17) {
                        //     $index++;
                        //     continue;
                        // }
                    } else {
                        $contains++;
                        //Remove K from val
                        $value = explode('K', $val)[0];
                        $value = $val;
                        $media += $value;
                    }
                    echo ("<div class='bar-wrapper'>
                            <div class='bar-top'>
                                <div class='text'>{$val}</div>
                            </div>
                            <div class='bar'>
                                <div class='text'>{$val}</div>
                            </div>
                            <div class='bar-title'>
                                <div class='text'>{$day}</div>
                            </div>
                        </div>");
                    $index++;
                }
                $media = round($media / $contains, 1);
                // $media = 77;
                ?>
                <div class="bar-wrapper last-bar">
                    <div class="bar-top" style="height: 0%;">
                        <div class="text"><?= $media ?></div>
                    </div>
                    <div class="bar" style="height: 0%;">
                        <div class="text"><?= $media ?></div>
                    </div>
                    <div class="bar-title">
                        <div class="text">Média</div>
                    </div>
                </div>
            </div>
        </div>
        <div id="goalmeter">
            <?php
            $objetivo = str_replace('%', '', $info[2]['objetivo']);
            $objetivo = (float) str_replace(',', '.', $objetivo);
            $faltante = $objetivo - $media;
            if ($faltante > 0) {
            ?>
                <div id="missing">
                    <p id="title">Balanço:</p>
                    <p id="value">-<?= $faltante ?>
                    <div style="color:#ff0000;" class="unit">%</div>
                    </p>
                </div>
            <?php
            } else {
                $faltante = $faltante * -1;
            ?>
                <div id="notmissing">
                    <p id="title">Balanço:</p>
                    <p id="value">+<?= $faltante ?>
                    <div style="color:#088708;" class="unit">%</div>
                    </p>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
    <script>
        $("#back_btn").click(function() {
            //History back
            window.history.back();
        });

        function buttonAnimate(href) {
            //Get position
            var button = $(this);
            var width = button.width();
            var height = button.height();
            //If button is not :animated
            if (!button.is(':animated')) {
                $(this).animate({
                    width: '+=10px',
                    height: '+=10px',
                }, 400, function() {
                    $(this).animate({
                        width: '-=10px',
                        height: '-=10px',
                    }, 400)
                });
            }
            setTimeout(function() {
                window.location.href = href;
            }, 875);
        }

        function playScenes() {
            var animation = 500;
            var scene1 = $('.scene-1');
            var scene2 = $('.scene-3');
            var scene3 = $('.scene-2');
            //Check if scene 1 is visible
            if ($(scene1).is(':visible')) {
                $(scene1).hide();
                graph();
                $(scene2).fadeIn(animation);
                return;
            }
            //Check if scene 2 is visible
            if ($(scene2).is(':visible')) {
                $(scene2).hide();
                $(scene3).fadeIn(animation);
                return;
            }
            //Check if scene 3 is visible
            if ($(scene3).is(':visible')) {
                $(scene3).hide();
                $(scene1).fadeIn(animation);
                return;
            }
        }

        var run = 0;

        function graph() {
            //First run var
            if (run < 1) {
                //Get the bars
                var bars = $('#bars').children();
                var lenght = bars.length;
                console.log(lenght);
                //Set var width of bars
                var barWidth = 87 / lenght;
                if (lenght > 20) {
                    fontSize = 18;
                } else if (lenght > 18) {
                    fontSize = 19;
                } else {
                    fontSize = 20;
                }
                var total = 0;
                var higher = 0;
                for (var i = 0; i < lenght - 1; i++) {
                    //LOOP BARS
                    var bar = bars[i + 1];
                    var barTop = $(bar).children('.bar-top');
                    var barTextEl = $(barTop).children('.text');
                    var barText = $(barTextEl).text();
                    var barTextEl2 = $(bar).children('.bar').children('.text');
                    var barText2 = $(barTextEl2).text();
                    //Set width
                    $(bar).css('width', barWidth + '%');
                    //Set font size
                    //BarText
                    $(barTextEl).css('font-size', (fontSize + 2) + 'px');
                    $(barTextEl2).css('font-size', (fontSize + 2) + 'px');
                    //BarTitle
                    var barTitle = $(bar).children('.bar-title');
                    var barTitleText = $(barTitle).children('.text');
                    $(barTitleText).css('font-size', fontSize + 'px');

                    //REMOVE K
                    barText = barText.replace('K', '');
                    num = parseInt(barText);
                    total += (num);
                    // console.log(total, num);
                    if (num > higher) {
                        higher = num;
                    }
                }
                //LEFT INDICATORS
                var max = 100;
                $('.left-indicator.max').text(max + '%');
                var mid = <?= $objetivo; ?>;
                $("#midline").css("top", ((100) - mid) + "%");
                //Translate
                $(".left-indicator.mid").css("top", ((100) - mid) + "%");
                var max = mid * 2;
                $('.left-indicator.mid').text(mid + '%');
                var low = 0;
                $('.left-indicator.low').text(low + '%');

                function animateBars() {
                    //LOOP BARS
                    for (var i = 0; i < lenght - 1; i++) {
                        var bar = bars[i + 1];
                        var barTop = $(bar).children('.bar-top');
                        var bar = $(bar).children('.bar');
                        var barText = $(barTop).children('.text').text();
                        var num = parseInt(barText);
                        max = 100;
                        var percent = (num / max) * 100;
                        percent = parseFloat(percent.toFixed(2));

                        var top = 100 - percent;
                        if (percent >= max) {
                            $(bar).css('background-color', '#088708');
                            $(bar).children('.text').text('');
                            $(bar).css('height', '0%');
                            //If bar is not :animated
                            if (!$(bar).is(':animated')) {
                                $(bar).animate({
                                    height: mid + '%'
                                }, 1000);
                            }
                            top = max - mid;
                            $(barTop).css('height', '0%');
                            $(barTop).children('.text').text(percent);
                            //If barTop is not :animated
                            if (!$(barTop).is(':animated')) {
                                $(barTop).animate({
                                    height: top + '%'
                                }, 1000);
                            }
                        } else if (percent > mid) {
                            $(bar).css('background-color', '#088708');
                            if (percent < mid + 5) {
                                $(barTop).children('.text').text('');
                                $(bar).css('height', '0%');
                                //If bar is not :animated
                                if (!$(bar).is(':animated')) {
                                    $(bar).animate({
                                        height: mid + "%"
                                    }, 1000);
                                }
                                top = percent - mid;
                                //If barTop is not :animated
                                $(bar).children('.text').text(percent);
                                $(barTop).css('height', '0%');
                                if (!$(barTop).is(':animated')) {
                                    $(barTop).animate({
                                        height: top + '%'
                                    }, 1000);
                                }
                            } else {
                                $(bar).children('.text').text('');
                                $(bar).css('height', '0%');
                                //If bar is not :animated
                                if (!$(bar).is(':animated')) {
                                    $(bar).animate({
                                        height: mid + '%'
                                    }, 1000);
                                }
                                top = percent - mid;
                                $(barTop).css('height', '0%');
                                $(barTop).children('.text').text(percent);
                                //If barTop is not :animated
                                if (!$(barTop).is(':animated')) {
                                    $(barTop).animate({
                                        height: top + '%'
                                    }, 1000);
                                }
                            }
                        }

                        if (percent <= mid) {
                            $(barTop).children('.text').text('');
                            $(barTop).css('height', '0%');
                            $(bar).css('height', '0%');
                            //If bar is not :animated
                            if (!$(bar).is(':animated')) {
                                $(bar).animate({
                                    height: percent + '%'
                                }, 1000);
                            }
                        }
                        if (percent == 0) {
                            $(barTop).children('.text').text('');
                            $(barTop).css('height', '0%');
                            $(bar).children('.text').text('');
                            $(bar).css('height', '0%');
                        }

                        // console.log(barText, percent + '%', top + '%');
                    }
                }

                function percent() {
                    //Get computer year
                    var date = new Date();
                    var year = date.getFullYear();
                    var month = date.getMonth();
                    var day = date.getDate();

                    $(".year").text(year);
                }
                percent();
                animateBars();
                run = run + 1;
                console.log(run);
            } else {
                //Get bars
                var bars = $('#bars').children();
                var lenght = bars.length;
                for (let i = 0; i < lenght - 1; i++) {
                    barmain = bars[i + 1];
                    bar = $(barmain).children('.bar');
                    bartop = $(barmain).children('.bar-top');
                    var height = $(bar).css('height');
                    var heighttop = $(bartop).css('height');
                    // console.log(height, heighttop);
                    //remove % from vars
                    height = height.replace('%', '');
                    heighttop = heighttop.replace('%', '');

                    $(bar).css('height', '0%');
                    $(bartop).css('height', '0%');

                    mid = <?= $objetivo; ?>;

                    if (height <= mid) {
                        //If bar is not :animated
                        if (!$(bar).is(':animated')) {
                            $(bar).animate({
                                height: height + "%"
                            }, 1000);
                        }
                    }
                    if (heighttop > 0) {
                        //If bar is not :animated
                        if (!$(bar).is(':animated')) {
                            $(bar).animate({
                                height: height + "%"
                            }, 1000);
                        }
                        //If bartop is not :animated
                        if (!$(bartop).is(':animated')) {
                            $(bartop).animate({
                                height: heighttop + "%"
                            }, 1000);
                        }
                    }
                    // console.log(bar, bartop);
                }
                run = run + 1;
                console.log(run);
            }
        }


        $(document).ready(function() {
            var scene1 = $('.scene-1');
            var scene2 = $('.scene-3');
            var scene3 = $('.scene-2');
            // graph();
            $(scene1).fadeIn(500);

            $('.chevron-right').click(function() {
                buttonAnimate.call(this, "#");
                //Check if scene is visible
                if ($(scene1).is(':visible')) {
                    $(scene1).hide();
                    graph();
                    $(scene2).fadeIn();
                } else if ($(scene2).is(':visible')) {
                    $(scene2).hide();
                    $(scene1).fadeIn(500);
                } else if ($(scene3).is(':visible')) {
                    $(scene3).hide();
                    $(scene1).fadeIn(500);
                }
            });
            $('.chevron-left').click(function() {
                buttonAnimate.call(this, "#");
                //Check if scene is visible
                if ($(scene1).is(':visible')) {
                    $(scene1).hide();
                    graph();
                    $(scene2).fadeIn(500);
                } else if ($(scene2).is(':visible')) {
                    $(scene2).hide();
                    $(scene1).fadeIn(500);
                } else if ($(scene3).is(':visible')) {
                    $(scene3).hide();
                    graph();
                    $(scene2).fadeIn(500);
                }
            });

            var timer = 0;
            $(document).on('click', function() {
                timer = 0;
            });

            setInterval(function() {
                console.log(timer);
                if (timer == 120) {
                    $('.chevron-right').click();
                    timer = 0;
                } else {
                    timer++;
                }
            }, 1000);

        });
    </script>
</body>

</html>