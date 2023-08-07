<?php
// header('Content-Type: text/plain');
header('Content-Type: application/json');
# Get csv from ../csv/scrap/
$scrap_csv = glob('../csv/scrap/*.csv');
$scrap_csv = $scrap_csv[0];
# Open csv
$scrap_csv = fopen($scrap_csv, 'r');
# Read csv
$sheetData = array();
while (($data = fgetcsv($scrap_csv, 1000, ";")) !== FALSE) {
    $sheetData[] = $data;
}
fclose($scrap_csv);

# Get days
$days = '';
$scrap = '';
$colors = [];

foreach ($sheetData as $key => $value) {
    if ($key == 1) {
        $days = $value;
    }
    if ($key == 4) {
        $scrap = $value;
    }
    if ($key == 5) {
        $obj = str_replace(",", ".", $value[2]);
    }
}

// var_dump($days);
// var_dump($scrap);
// var_dump($obj);


# Loop through days to keep only the date
foreach ($days as $key => $value) {
    # Use regex for date (dd/mm) and keep only the date
    if (preg_match('/\d{2}\/\d{2}/', $value, $matches) === 1) {
        $days[$key] = $matches[0];
    } else {
        unset($days[$key]);
    }
}
# Arrangement of the array
$days = array_values($days);

# Add "Media" to the array
$days[] = "Média";

// var_dump($days);


# Loop through scrap to keep only the value
foreach ($scrap as $key => $value) {
    if ($key > 1) {
        if ($value == '') {
            continue;
        }
        if ($value == '#DIV/0!') {
            $value = "0";
        }
        $value = str_replace(",", ".", $value);
        $scrapfiltered[] = $value;
    }
}
# Arrangement of the array
$scrap = array_values($scrap);

// var_dump($scrapfiltered);

# Loop through scrapfiltered to get colors
foreach ($scrapfiltered as $key => $value) {
    if ($value < $obj) {
        $colors[] = "#088708";
    } else {
        $colors[] = "#FF0000";
    }
}



$data = array(
    'days' => $days,
    'values' => $scrapfiltered,
    'objective' => $obj,
    'colors' => $colors,
);

echo json_encode($data);
