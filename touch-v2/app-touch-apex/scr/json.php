<?php
# Get csv from ../csv/scrap/
$scrap_csv = glob('../../../../../worker/csv/scrapval/*.csv');
$scrap_csv = $scrap_csv[0];
# Open csv
$scrap_csv = fopen($scrap_csv, 'r');
# Read csv
$sheetData = array();
while (($data = fgetcsv($scrap_csv, 1000, ";")) !== FALSE) {
    $sheetData[] = $data;
}
fclose($scrap_csv);


$index = 0;
$real = 20;
$objetivo = $real + 18;

## Get days
$days = [];
$indexes = [];
foreach ($sheetData as $key => $value) {
    if ($index < 3) {
        $index++;
        continue;
    } else {
        // var_dump($sheetData[$index]);
        $day = $sheetData[$index][2];
        if (preg_match('/\d{2}\/\d{2}/', $day)) {
            // var_dump($day);
            $days[] = ($day);
            $indexes[] = $key;
        }
        if (strpos($day, 'M') !== false && strpos($day, 'dia') !== false) {
            // var_dump($day);
            $media = $sheetData[$index][$real];
            $media = str_replace(',', '.', str_replace('%', '', $media));
            $shared['media'] = (float) trim($media);
            // var_dump($shared['media']);
        }
        $index++;
    }
}

// var_dump($scrap);
## Define base scrap percentage
$mid = (float) str_replace("%", "", str_replace(",", ".", $sheetData[3][$objetivo]));
$max = (float) $mid * 2;
$max = (float)10;
$min = (float) 0.00;

## Variables
$budget = 0;
$acum = 0;
$yesterday = 0;
$monthday = 0;
$lenght = 0;
$values = [];
$colors = [];
// echo '<pre>';
// var_dump($sheetData[3][$objetivo], $max, $mid, $min);
foreach ($days as $key => $value) {
    $val = (float) str_replace("%", "", str_replace(",", ".", $sheetData[$indexes[$key]][$real]));
    // var_dump($key);
    if ($val > 0) {
        $lenght += 1;
    }

    if ($val > $mid) {
        $colors[] = '#ff0000';
    } else {
        $colors[] = '#088708';
    }


    $values[] = ($val);
}

$days[] = 'Média';
// var_dump($days);
$values[] += $shared['media'];

if ($media > $mid) {
    $colors[] = '#ff0000';
} else {
    $colors[] = '#088708';
}

$data = array(
    'objective' => $mid,
    'max' => $max,
    'min' => $min,
    'days' => $days,
    'values' => $values,
    'colors' => $colors,
);

$data = json_encode($data);
echo ($data);


// return $data;
//Create chart1.json file
// $chart1 = fopen('.\chart1.json', 'w');
// fwrite($chart1, json_encode($data));
