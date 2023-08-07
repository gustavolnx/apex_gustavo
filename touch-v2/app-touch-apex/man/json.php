<?php
//Glob ./csv/*.csv

$files = glob('./csv/*.csv');
$json = array();

$days = array();
$readyArray = array();
$notreadyArray = array();
foreach ($files as $file) {
    //Open csv
    $csv = fopen($file, 'r');
    while (($line = fgetcsv($csv, 5000, ';')) !== FALSE) {
        //Jump first line
        if (strpos($line[0], 'ORDEM') !== false || strpos($line[0], 'DATA') !== false) {
            continue;
        }
        // var_dump($line);


        // return;
        $day = $line[0];
        $ready = $line[1];
        $notready = $line[2];

        //Add to array
        array_push($days, $day);
        array_push($readyArray, $ready);
        array_push($notreadyArray, $notready);
    }
    $json = array(
        'days' => $days,
        'ready' => $readyArray,
        'notready' => $notreadyArray
    );
    fclose($csv);
};
$json = json_encode($json);
echo $json;
