<?php
// JSON ContentType
header('Content-Type: application/json');

// PHP Debugging
// header('Content-Type:text/plain');

// ? CSV to JSON

# Glob
$dir = '../../../../../worker/csv/eficiencia/';
$files = glob($dir . '*.csv');

# Pos
$pos = array(
    'dia' => 0,
    'real' => 49,
    'objetivo' => 49 + 42,
);

# Vars
$i = 0;
$days = array();
$real = array();
$colors = array();

# Open csv
if (($handle = fopen($files[0], "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
        $i += 1;
        if ($i < 8 || $data[0] == "00/01" || $data[0] == "") {
            continue;
        } elseif (strpos($data[0], 'Balan') !== false) {
            continue;
        } elseif (strpos($data[0], 'M') !== false && strpos($data[0], 'dia') !== false) {
            $media = str_replace(',', '.', str_replace('%', '', $data[$pos['real']]));
        } else {
            $valreal = (int) str_replace('%', '', $data[$pos['real']]);
            // $valreal = 129;
            // $data[$pos['real']] = 129;
            // // $data[$pos['objetivo']] = 99;

            $days[] = $data[0];
            $real[] = str_replace(',', '.', str_replace('%', '', $data[$pos['real']]));
            $mediaobj = str_replace(',', '.', str_replace('%', '', $data[$pos['objetivo']]));
            if ($valreal >= str_replace('%', '', $data[$pos['objetivo']])) {
                $colors[] = '#088708';
            } else {
                $colors[] = '#ff0000';
            }
        }
    }
    fclose($handle);
}

// Add media at the end
$days[] = 'Média';
$real[] = $media;
$objetivo = $mediaobj;
if ($media >= $mediaobj) {
    $colors[] = '#088708';
} else {
    $colors[] = '#ff0000';
}

// var_dump($days, $real, $objetivo);
$json = array(
    'days' => $days,
    'real' => $real,
    'objetivo' => $objetivo,
    'colors' => $colors,
    // 'balance' => $balanco,
);

// var_dump($json);

echo json_encode($json);
