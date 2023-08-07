<?php
# Get csv from ../csv/scrap/
$scrap_csv = glob('../../../../../worker/csv/scrap/*.csv');
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
$real = 8;
$objetivo = $real + 18;

## Get days
$days = [];
foreach ($sheetData as $key => $value) {
    if ($index < 3) {
        $index++;
        continue;
    } else {
        // var_dump($sheetData[$index]);
        $day = $sheetData[$index][2];
        if (preg_match('/\d{2}\/\d{2}/', $day)) {
            // var_dump($day);
            $days[] = array($day, $key);
        }
        if (strpos($day, 'M') !== false && strpos($day, 'dia') !== false) {
            // var_dump($day);
            // $media = $sheetData[$index][$real];
            // $media = str_replace(',', '.', str_replace('%', '', $media));
            // $shared['media'] = (float) trim($media);
            // var_dump($shared['media']);
        }
        $index++;
    }
}

## Get scrap percentage
$scrap = [];
foreach ($days as $day) {
    // var_dump($day);
    $scrap[] = (float) str_replace("%", "", str_replace(",", ".", $sheetData[$day[1]][$real]));
}
// var_dump($scrap);
## Define base scrap percentage
// $mid = (float) str_replace("%", "", str_replace(",", ".", $sheetData[$day[1]][$objetivo]));
// $max = (float) $mid * 2;
// $min = (float) 0.00;
// var_dump($max, $mid, $min);

## Variables
$budget = 0;
$acum = 0;
$yesterday = 0;
$monthday = 0;
$lenght = 0;
foreach ($days as $key => $value) {
    $day = $value[0];
    $val = (float) $scrap[$key];
    // var_dump($val);
    if ($val > 0) {
        $lenght += 1;
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
}
