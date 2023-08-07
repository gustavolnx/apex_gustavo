<?php
// error_reporting(0);
# Get csv from ../csv/ener/
$ener_csv = glob('../csv/ener/*.csv');
$ener_csv = $ener_csv[0];
# Open csv
# File mtime
$mtime = filemtime($ener_csv);
# Month
$month = date('m', $mtime);
// var_dump($month);
$ener_csv = fopen($ener_csv, 'r');
# Read csv
$sheetData = array();
while (($data = fgetcsv($ener_csv, 1000, ";")) !== FALSE) {
    $sheetData[] = $data;
}
fclose($ener_csv);

// header('Content-Type: text/plain');
// echo ('<pre>');
foreach ($sheetData as $key => $value) {
    if ($key > 4 && $key < 36) {
        // var_dump($value);
        //Get last ocurrence of $value[16] that is not empty
        if ($value[16] != "") {
            $conbase = (int) round($value[16]);
            // var_dump($value[16], $value[15]);
        }
    }
}

// return;

$index = 0;
$maxindicator = 0;
foreach ($sheetData as $key => $value) {
    if ($key > 4 && $key < 36) {
        // echo ('<pre>');
        // var_dump($value);
        $day = ''; //[2]
        $con = ''; //[37][4]
        $max = ''; //[12]
        $mid = ''; //[11]
        $min = ''; //[13]

        //Int Data
        $con = (int) ($conbase);
        // echo ('<pre>');
        // var_dump($con);
        // var_dump($sheetData[16]);
        $max = (int) ($value[6]);
        // $mid = (int) round($value[14]);
        // $min = (int) round($value[13]);
        $midcon = (int) ($value[13]);
        // var_dump($con, $max, $mid, $min, $midcon);

        //To K
        $con = ($con / 1000); //Contratado
        $max = ($max / 1000); //Maximo planejado
        // $mid = round($mid / 1000); //Consumo real
        // $min = round($min / 1000); //Minimo planejado
        $midcon = ($midcon / 1000); //Consumo planejado
        // var_dump(array(
        //     "Planejado Total" => $con,
        //     "Planejado Max" => $max,
        //     "Consumo Real" => $midcon
        // ));


        $max_percent = ($max / $con * 100); //Planejado Max
        // $mid_percent = ($mid / $con * 100); //Planejado Mid
        // $min_percent = ($min / $con * 100); //Planejado Min
        $midcon_percent = ($midcon / $con * 100); //Consumo Real

        $max_percent = 100 - $max_percent;
        // $mid_percent = 100 - $mid_percent;
        // $min_percent = 100 - $min_percent;
        $mid_con = 100 - $midcon_percent;

        // $max_percent = 0;
        $mid_percent = 0;
        $min_percent = 0;
        // $mid_con = 0;

        if ($value[2] > 0 && $value[2] < 10) {
            $value[2] = '0' . $value[2];
        } else {
            $value[2] = $value[2];
        }

        if (preg_match('/[0-9]{2}/', $value[2])) {
            $show = true;
        } else {
            $show = false;
        }


        if ($show == true) {
            echo ("
            <div class='column column-$index'>
            <div style='top:" . $max_percent . "%' class='dot mid dot-$index'></div>");

            if ($mid_con == 100) {
            } else {
                echo ("<div style='top:" . $mid_con . "%' class='dot midcon'></div>");
            }
            // if ($mid_percent == 100) {
            // } else {
            //     echo ("<div style='top:" . $mid_percent . "%' class='dot mid dot-$index'></div>");
            // }

            echo ("<div class='day'><div class='text'>" . $value[2] . "</div></div>
        </div>
        ");
            // var_dump($max);
            if ($max > 0) {
                $maxindicator = $max;
            }
        }
        $index++;
    }
}
