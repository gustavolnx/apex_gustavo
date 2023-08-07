<?php
header('Content-Type: application/json, charset=utf-8');
$path = '../../../../app/setores/worker/csv/gastos/bu/';
//Glob from $path
$files = glob($path . '*.csv');

$account = [];
$spendings = [];
$limit = [];
$json = [];

foreach ($files as $file) {
    $csv = fopen($file, 'r');
    while (($data = fgetcsv($csv, 1000, ";")) !== FALSE) {
        //Jump first line
        if ($data[0] == 'Account') {
            continue;
        }
        $bu = $data[4];
        //Decode UTF-8
        $account[] = mb_convert_encoding($bu, "UTF-8", "ISO-8859-1");
        $limit[] = $data[5];
        $spendings[] = $data[6];
    }
    $json = array(
        'account' => $account,
        'limit' => $limit,
        'spendings' => $spendings
    );
    // var_dump($json);
    fclose($csv);
}
$json = json_encode($json);
// var_dump($json);
echo ($json);
