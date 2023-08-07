<?php
//Get txt content
$dir = "./config/config.txt";
$myfile = fopen($dir, "r") or die("Unable to open file!");
$exploded = explode("\n", fread($myfile, filesize($dir)));

$video = trim($exploded[0]);
$date = $exploded[1];
//Format date YYYY-MM-DD
$date = explode("/", $date);
$date = $date[2] . "-" . $date[1] . "-" . $date[0];
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
    <script src="/apex/touch-v2/dist/js/anime.js"></script>
    <style>
        * {
            -webkit-user-select: none;
            /* Safari */
            -ms-user-select: none;
            /* IE 10 and IE 11 */
            user-select: none;
            /* Standard syntax */
        }

        * {
            -webkit-user-select: none;
            /* Safari */
            -ms-user-select: none;
            /* IE 10 and IE 11 */
            user-select: none;
            /* Standard syntax */
        }

        * {
            overflow: hidden;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 1920px;
            height: 1080px;
            overflow: hidden;
            background-color: #15171b;
        }

        #video {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;
            width: 1920px;
            height: 1080px;
            overflow: hidden;
        }

        #square>#top {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 2;
            overflow: hidden;
        }

        #square>#lower {
            position: absolute;
            top: 0px;
            left: 0px;
            z-index: 1;
            overflow: hidden;
        }

        @font-face {
            font-family: "Geometria-Bold";
            src: url('./Geometria-Bold.ttf');
        }

        @font-face {
            font-family: "Geometria-ExtraBold";
            src: url('./Geometria-ExtraBold.ttf');
        }

        #square>#text {
            position: absolute;
            top: 71%;
            left: 77%;
            z-index: 3;
            width: 300px;
            height: 250px;
            /* border: 3px solid red; */

            vertical-align: bottom;
            text-align: center;
            font-size: 9em;
            color: white;
            font-family: "Geometria-Bold";
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

        .scene {
            background-color: #fff;
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .scene>img {
            position: absolute;
            width: 100%;
            top: 50%;
            transform: translateY(-50%);
            object-fit: cover;
        }
    </style>
</head>

<body>
    <a href="#" class="btn home back-btn">
        <img src="../../back.png">
    </a>
    <div class="chevron-right">
        <style>
            .chevron-right {
                width: 50px;
                filter: invert(360);
                position: absolute;
                top: 50%;
                left: 100%;
                transform: translate(-120%, -50%);
                z-index: 10;
            }
        </style>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="white" class="bi bi-chevron-right" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708z" />
        </svg>
    </div>
    <div class="chevron-left">
        <style>
            .chevron-left {
                width: 50px;
                filter: invert(360);
                position: absolute;
                top: 50%;
                left: 0%;
                transform: translate(0%, -50%);
                z-index: 10;
            }
        </style>
        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="white" class="bi bi-chevron-left" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 0 1 0 .708L5.707 8l5.647 5.646a.5.5 0 0 1-.708.708l-6-6a.5.5 0 0 1 0-.708l6-6a.5.5 0 0 1 .708 0z" />
        </svg>
    </div>
    <div style="color: #fff; font-size:20px;" class="pre-text">
        <?php
        #Scandir .\media for image files
        $dir = "./media";
        $files = scandir($dir);
        $files = array_diff(scandir($dir), array('.', '..'));
        $files = array_values($files);
        // var_dump($files);
        $index = 1;
        foreach ($files as $file) {
            echo "<div class='scene scene-{$index}'>";
            echo "<img src='./media/" . $file . "'><br>";
            echo "</div>";
            $index++;
        }
        ?>
    </div>
    <!-- LAST SCENE -->
    <!-- SCENE 0 -->
    <?php
    echo "<div class='scene scene-{$index}'>";
    ?>
    <div id="square">
        <div id="text">150</div><img id="top" src="./square.png"><img id="lower" src="./square-grey.png">
    </div>
    <div id="hud"></div>
    <div id="video"></div>
    </div>
    <script>
        // Hide all scene
        $(".scene").hide();
        // Show scene-1
        $(".scene-1").show();

        $(".chevron-right").click(function() {
            //buttonAnimate(this)
            buttonAnimate.call(this, '#');
            //Get current scene
            var scene = $(".scene:visible");
            //Get current scene number
            var sceneNumber = scene.attr("class").split(" ")[1].split("-")[1];
            //Get next scene number
            var nextSceneNumber = parseInt(sceneNumber) + 1;
            //Check if next scene exists
            if ($(".scene-" + nextSceneNumber).length == 0) {
                //If not, go to first scene
                nextSceneNumber = 1;
            }
            //Hide current scene
            scene.hide();
            //Show next scene
            $(".scene-" + nextSceneNumber).show();
        });

        $(".chevron-left").click(function() {
            //buttonAnimate(this)
            buttonAnimate.call(this, '#');
            //Get current scene
            var scene = $(".scene:visible");
            //Get current scene number
            var sceneNumber = scene.attr("class").split(" ")[1].split("-")[1];
            //Get next scene number
            var nextSceneNumber = parseInt(sceneNumber) - 1;
            //Check if next scene exists
            if ($(".scene-" + nextSceneNumber).length == 0) {
                //If not, go to last scene
                nextSceneNumber = <?php echo $index ?>;
            }
            //Hide current scene
            scene.hide();
            //Show next scene
            $(".scene-" + nextSceneNumber).show();
        });

        function buttonAnimate(href) {
            //Get position
            var button = $(this);
            var width = button.width();
            var height = button.height();
            //If button is not :animated
            if (!button.is(':animated')) {
                //Animate button
                button.animate({
                    width: '+=10px',
                    height: '+=10px',
                }, 400, function() {
                    button.animate({
                        width: '-=10px',
                        height: '-=10px',
                    }, 400)
                });
            }
            setTimeout(function() {
                window.location.href = href;
            }, 875);
        }


        $(document).ready(function() {
            $(".back-btn").click(function() {
                //History back
                window.history.back();
            });
        });

        //Insert video into div
        var video = document.createElement("video");
        var stats = "<?php echo $video; ?>"
        if (stats == 1) {
            //Hide square>top
            $("#top").hide();
            //Text color
            $("#text").css("color", "#403f3d");
        }
        video.src = "./" + stats + ".mp4";
        video.autoplay = true;
        video.loop = true;

        document.getElementById("video").appendChild(video);

        //Calculate date difference
        var date = new Date("<?php echo $date; ?>");
        var today = new Date();
        var diff = Math.abs(date - today);
        var days = Math.ceil(diff / (1000 * 60 * 60 * 24));
        days = days - 1;
        $("#text").text(days);

        $(".scene.scene-2").ready(function() {
            anime({
                targets: '#text, #top, #lower',
                opacity: [0, 1],
                translateX: [100, 0],
                duration: 2000,
                easing: 'easeOutExpo'
            });
        });
    </script>
</body>

</html>