<?php
header('Content-Type: text/plain');
$path = '../../../../app/setores/worker/csv/gastos/all/';
//Glob from $path
$files = glob($path . '*.csv');

$days = [];
$plannedArray = [];
$actualArray = [];
$barColors = [];

foreach ($files as $file) {
    $csv = fopen($file, 'r');
    while (($data = fgetcsv($csv, 1000, ";")) !== FALSE) {
        //Jump first line
        if ($data[0] == 'Data' || $data[0] == '00/01' || $data[0] == '') {
            continue;
        }
        if (strpos($data[0], 'Balan') !== false) {
            $balance = $data[13];
            continue;
        }
        if (strpos($data[0], 'M') !== false && strpos($data[0], 'dia') !== false) {
            $day = 'Média';
            $planned = $data[12];
            $actual = $data[13];
            $days[] = $day;
            $plannedArray[] = $planned;
            $actualArray[] = $actual;
            continue;
        }
        // var_dump($data);
        $day = $data[0];
        $planned = $data[12];
        $actual = $data[13];
        // var_dump(array($day, $planned, $actual));


        //Add to arrays
        $days[] = $day;
        $plannedArray[] = $planned;
        $actualArray[] = $actual;

        if ($actual > $planned) {
            $barColors[] = '#ff0000';
        } else {
            $barColors[] = '#088708';
        }
    }
    $json = array(
        'days' => $days,
        'planned' => $plannedArray,
        'actual' => $actualArray,
        'colors' => $barColors,
        'balance' => $balance,
    );
    fclose($csv);
}
$json = json_encode($json);
// var_dump($json);
echo ($json);
