<?php
header('Content-Type: application/json');

// ? CSV to JSON

# Glob
$dir = '../../../../../worker/csv/absorcao/';
$files = glob($dir . '*.csv');

# Pos
$pos = array(
    'dia' => 0,
    'real' => 53,
    'objetivo' => 53 + 42,
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
        if ($i < 9 || $data[0] == '00/01') {
            continue;
        } elseif (strpos($data[0], 'Balan') !== false) {
            $balanco = $data[$pos['real']];
        } elseif (strpos($data[0], 'M') !== false && strpos($data[0], 'dia') !== false) {
            $media = $data[$pos['real']];
        } else {
            $days[] = $data[0];
            // $data[$pos['real']] = 14119;
            $real[] = $data[$pos['real']];
            $mediaobj = $data[$pos['objetivo']];
            // $objetivo[] = $data[$pos['objetivo']];
            if ($data[$pos['real']] >= $data[$pos['objetivo']]) {
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
    'balance' => $balanco,
);
echo json_encode($json);
