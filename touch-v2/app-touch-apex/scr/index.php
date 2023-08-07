<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Apex Touch v2</title>
    <link rel="shortcut icon" href="../favicon.ico" type="image/x-icon">
    <script src="../jquery.js"></script>
    <link rel="stylesheet" href="styles.css">
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
            background-size: cover;
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
            text-align: end;
            font-size: 20px;
            font-family: MontserratExtraBold;
            color: #ffffff;
            width: 110px;
        }

        .left-indicator.low {
            position: absolute;
            top: 88%;
            left: -1%;
            transform: translate(-50%, -50%);
        }

        .left-indicator.mid {
            position: absolute;
            top: 45%;
            left: -1%;
            transform: translate(-50%, -50%);
        }

        .left-indicator.max {
            position: absolute;
            top: 2.2%;
            left: -1%;
            transform: translate(-50%, -50%);
        }

        .left-indicator.day {
            position: absolute;
            top: 93%;
            left: 2%;
            transform: translate(-50%, -50%);
        }


        #bars {
            position: relative;
            top: calc(44% + 3px);
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
            background-color: #ff0000;
            top: 4px;
            position: relative;
        }

        .bar {
            display: inline-block;
            width: 100%;
            height: calc(100% - 70%);
            background-color: #088708;
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

        .last-bar {
            margin: 0 0 0 auto;
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

        .btn.home {
            border-radius: 50%;
            position: absolute;
            top: 95%;
            left: 3%;
            height: 75px;
            width: 75px;
        }

        .back-btn {
            position: absolute;
            width: 75px;
            z-index: 10;
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

        .sector {
            z-index: 10;
            text-decoration: none;
            position: absolute;
            text-align: center;
            width: 800px;
            top: 8%;
            letter-spacing: 2px;
            left: 25%;
            transform: translate(-50%, -50%);
            color: #fff;
            font-family: "Montserrat Black";
            font-size: 55px;
            /* border: 1px solid red; */
        }

        .sector>div {
            display: inline;
        }

        .chevron>img {
            height: 30px;
            margin-bottom: 2.5px;
        }

        .unit {
            display: inline;
            font-size: 20px;

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

        .btn.home {
            border-radius: 50%;
            position: absolute;
            top: 95%;
            left: 3%;
            height: 75px;
            width: 75px;
        }

        .back-btn {
            position: absolute;
            width: 75px;
            z-index: 10;
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

    <div class="scene-3">

        <div class="frame-decoration3"></div>
        <div class="frame-decoration2"></div>

        <div id="chart-title">
            SCRAP EM %
            <div class="decorationval1"></div>
        </div>
        <!-- CHARTJS -->
        <div id="chartframe2">
            <canvas id="chart2">
            </canvas>
        </div>

        <div id="chart-title-2">
            SCRAP EM R$
            <div class="decorationval1"></div>
        </div>
        <!-- CHARTJS -->
        <div id="chartframe-3">
            <canvas id="chart3">
            </canvas>
        </div>



    </div>

    </div>

</body>

<!-- Show scene-1 -->
<script>
    $(document).ready(function() {
        $(".scene-1").fadeIn(0);
        // $(".scene-3").fadeIn(5000);
    });
    // chevron right move to scne-3
    $(".chevron-right").click(function() {
        $(".scene-1").fadeOut(1);
        $(".scene-3").fadeIn(1);
    });
    // if scene-3 is active, chevron left move to scene-1
    $(".chevron-left").click(function() {
        $(".scene-3").fadeOut(1);
        $(".scene-1").fadeIn(1);
    });
    //back_btn move to home
    $("#back_btn").click(function() {
        // history back
        window.history.back();
    });
</script>
<!-- import chart_test.js by the src  -->
<script src="/apex/touch-v2/dist/js/chart.js"></script>
<script src="/apex/touch-v2/dist/js/plugin-datatables.js"></script>
<script src="chart1.js"></script>
<script src="chartval2.js"></script>

</html>