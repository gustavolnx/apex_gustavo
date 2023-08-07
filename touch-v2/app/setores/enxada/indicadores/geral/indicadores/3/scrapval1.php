<?php
header('Content-Type: text/plain');
# Get csv from ../csv/scrap/
$scrap_csv = glob('../../../../../worker/csv/scrapval/*.csv');
$scrap_csv = $scrap_csv[0];
# Open csv
$scrap_csv = fopen($scrap_csv, 'r');
# Read csv
$sheetData = array();
while (($data = fgetcsv($scrap_csv, 1000, ";")) !== FALSE) {
    // var_dump($data);
    $sheetData[] = $data;
}
fclose($scrap_csv);

# Setup variables
$index = 0;
$real = 8;
$objetivo = 17;

## DAYS ARRAY
$days = [];
$indexes = [];
foreach ($sheetData as $key => $value) {
    if ($index < 3) {
        $index++;
        continue;
    } else {
        // var_dump($sheetData[$index][2]);
        $day = $sheetData[$index][2];
        if (preg_match('/\d{2}\/\d{2}/', $day)) {
            $days[] = ($day);
            $indexes[] = $key;
        }
        $index++;
    }
}

## Variables
$values_real = [];
$values_obj = [];
$colors_real = [];
$colors_obj = [];


## USING DAYS INDEX GET VALUES REAL
foreach ($days as $key => $value) {
    $val = (float) str_replace("%", "", str_replace(",", ".", $sheetData[$indexes[$key]][$real]));
    if ($val > 0) {
        $values_real[] = ($val);
    } else {
        $values_real[] = 'N/A';
    }
}
$colors_real = '#008dff';

## USING DAYS INDEX GET VALUES OBJECTIVE
foreach ($days as $key => $value) {
    $val = (float) str_replace("%", "", str_replace(",", ".", $sheetData[$indexes[$key]][$objetivo]));
    if ($val > 0) {
        $values_obj[] = ($val);
    } else {
        $values_obj[] = 'N/A';
    }
}
$colors_obj = '#a8a8a8';


$data = array(
    'days' => $days,
    'real' => $values_real,
    'objetivo' => $values_obj,
    'colors_real' => $colors_real,
    'colors_obj' => $colors_obj,
);

$data = json_encode($data);
echo ($data);


// return $data;
//Create chart1.json file
// $chart1 = fopen('.\chart1.json', 'w');
// fwrite($chart1, json_encode($data));
