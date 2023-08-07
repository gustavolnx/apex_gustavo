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

        * {
            overflow: hidden;
        }

        html,
        body {
            margin: 0;
            padding: 0;
            width: 100%;
            height: 100%;
            background-color: #15171b;
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

        /** SVG Shadow */
        .chevron-right svg {
            filter: drop-shadow(0px 0px 3px rgba(0, 0, 0, 1));
        }

        .chevron-left svg {
            filter: drop-shadow(0px 0px 3px rgba(0, 0, 0, 1));
        }

        .chevron-left {
            position: absolute;
            top: 50%;
            left: 2%;
            transform: translate(-50%, -50%);
            z-index: 10;
        }

        #start {
            position: absolute;
            top: 0;
            left: 0;
            z-index: 0;


            width: 100%;
            height: 100%;
            background-image: url('./default/start.png');
            background-size: cover;
        }

        #end {
            width: 100%;
            height: 100%;
            background-image: url('./default/end.png');
            background-size: cover;
        }

        #no-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);

            color: white;
            font-size: 8em;
            text-align: center;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            z-index: 50;
        }

        video {
            position: absolute;
            z-index: 0;
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
    <!-- HUD Control -->
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

    <!-- Scenes -->
    <?php
    $dir = "./scenes";
    $files = scandir($dir);
    //Order files asc
    sort($files, SORT_NATURAL);
    // var_dump($files);
    $status = "Content";
    $c = 0;
    foreach ($files as $file) {
        if ($file != "." && $file != ".." && $files >= 3) {
            // var_dump($file);
            $id = explode(".", $file)[0];
            //If file type image
            if (explode(".", $file)[1] == "png" || explode(".", $file)[1] == "jpg" || explode(".", $file)[1] == "jpeg" || explode(".", $file)[1] == "gif") {
                echo "
                <div class='dinamic-scene' style='width:100%;height:100%; id='scene-$c'>
                    <img src='$dir/$file' style='width:100%;height:100%;'>
                </div>
                ";
            }
            //If file type video
            if (explode(".", $file)[1] == "mp4" || explode(".", $file)[1] == "webm" || explode(".", $file)[1] == "ogg") {
                echo "
                <div class='dinamic-scene' style='width:100%;height:100%; id='scene-$c'>
                    <video src='$dir/$file' style='width:100%;height:100%;'></video>
                </div>
                ";
            }
        }
        //Get array size
        $sceneQuantity = count($files);
        if ($sceneQuantity <= 2) {
            $status = "No content";
        }
        $c++;
    }
    if ($status == 'No content') {
        echo "<div id='no-content'>Aguardando novos comunicados!</div>";
    }
    ?>
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

        //Get all .dinamic-scene and hide them
        var dinamicScene = $('.dinamic-scene');
        for (let i = 0; i < dinamicScene.length; i++) {
            if (i > 0) {
                const element = dinamicScene[i];
                $(element).hide();
            }
        }
        $(document).ready(function() {
            //If first scene is video, start it
            if ($('#scene-2').children('video').length > 0) {
                $('#scene-2').children('video').trigger('play');
            }
            $('.chevron-right').click(function() {
                buttonAnimate.call(this, "#");
                //Get scene quantity
                var sceneQuantity = $('.dinamic-scene').length;
                for (let i = 0; i < sceneQuantity; i++) {
                    const element = $('.dinamic-scene')[i];
                    if ($(element).is(':visible')) {
                        //If video is visible and playing stop it
                        if ($(element).children('video').length > 0) {
                            $(element).children('video').trigger('pause');
                        }
                        //If dinamic-scene-max, continue to first scene
                        if (i + 1 == sceneQuantity) {
                            $(element).hide();
                            $($('.dinamic-scene')[0]).fadeIn(500);
                            //If there is a video chidren
                            if ($($('.dinamic-scene')[0]).children('video').length > 0) {
                                $($('.dinamic-scene')[0]).children('video').get(0).currentTime = 0;
                                $($('.dinamic-scene')[0]).children('video').trigger('play');
                            }
                            //if there is a img children
                            if ($($('.dinamic-scene')[0]).children('img').length > 0) {
                                //Wait and trigger next scene
                                clearTimeout(nextscene);
                                nextscene = setTimeout(function() {
                                    //If image is still visible, trigger next scene
                                    if ($($('.dinamic-scene')[0]).is(':visible')) {
                                        $('.chevron-right').trigger('click');
                                    }
                                }, 15000);
                            }
                            break;
                        }
                        $(element).hide();
                        $($('.dinamic-scene')[i + 1]).fadeIn(500);
                        //If there is a video chidren
                        if ($($('.dinamic-scene')[i + 1]).children('video').length > 0) {
                            $($('.dinamic-scene')[i + 1]).children('video').get(0).currentTime = 0;
                            $($('.dinamic-scene')[i + 1]).children('video').trigger('play');
                        }
                        //if there is a img children
                        if ($($('.dinamic-scene')[i + 1]).children('img').length > 0) {
                            //Wait and trigger next scene
                            clearTimeout(nextscene);
                            nextscene = setTimeout(function() {
                                //If image is still visible, trigger next scene
                                if ($($('.dinamic-scene')[i + 1]).is(':visible')) {
                                    $('.chevron-right').trigger('click');
                                }
                            }, 15000);
                        }
                        break;
                    }
                }
            });

            $('.chevron-left').click(function() {
                buttonAnimate.call(this, "#");
                //Get scene quantity
                var sceneQuantity = $('.dinamic-scene').length;
                for (let i = 0; i < sceneQuantity; i++) {
                    const element = $('.dinamic-scene')[i];
                    if ($(element).is(':visible')) {
                        //If video is visible and playing stop it
                        if ($(element).children('video').length > 0) {
                            $(element).children('video').trigger('pause');
                        }
                        //If dinamic-scene-min, continue to last scene
                        if (i - 1 == -1) {
                            $(element).hide();
                            $($('.dinamic-scene')[sceneQuantity - 1]).fadeIn(500);
                            //If there is a video children
                            if ($($('.dinamic-scene')[sceneQuantity - 1]).children('video').length > 0) {
                                $($('.dinamic-scene')[sceneQuantity - 1]).children('video').get(0).currentTime = 0;
                                $($('.dinamic-scene')[sceneQuantity - 1]).children('video').trigger('play');
                            }
                            //if there is a img children
                            if ($($('.dinamic-scene')[sceneQuantity - 1]).children('img').length > 0) {
                                //Wait and trigger next scene
                                clearTimeout(nextscene);
                                nextscene = setTimeout(function() {
                                    //If image is visible, next scene
                                    if ($($('.dinamic-scene')[sceneQuantity - 1]).children('img').is(':visible')) {
                                        $('.chevron-right').trigger('click');
                                    }
                                }, 15000);
                            }
                            break;
                        }
                        $(element).hide();

                        $($('.dinamic-scene')[i - 1]).fadeIn(500);
                        //If there is a video children
                        if ($($('.dinamic-scene')[i - 1]).children('video').length > 0) {
                            $($('.dinamic-scene')[i - 1]).children('video').get(0).currentTime = 0;
                            $($('.dinamic-scene')[i - 1]).children('video').trigger('play');
                        }
                        //if there is a img children
                        if ($($('.dinamic-scene')[i - 1]).children('img').length > 0) {
                            //Wait and trigger next scene
                            clearTimeout(nextscene);
                            nextscene = setTimeout(function() {
                                //If image is visible, next scene
                                if ($($('.dinamic-scene')[i - 1]).children('img').is(':visible')) {
                                    $('.chevron-right').trigger('click');
                                }
                            }, 15000);
                        }
                        break;
                    }
                }
            });
        });

        $(document).ready(function() {
            //Wait 15s and trigger next scene
            setTimeout(function() {
                $('.chevron-right').trigger('click');
            }, 15000);
        });
    </script>
</body>

</html>