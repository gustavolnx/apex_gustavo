<?php
// JSON ContentType
header('Content-Type: application/json');

// PHP Debugging
// header('Content-Type:text/plain');

// ? CSV to JSON

# Glob
$dir = '../../app/setores/worker/csv/gastos/all/';
$files = glob($dir . '*.csv');
// $files = scandir($dir);
// var_dump($files);
# Pos
$pos = array(
    'dia' => 0,
    'real' => 7,
    'objetivo' => 9,
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
        if ($i < 2 || $data[0] == "00/01" || $data[0] == "") {
            continue;
        } elseif (strpos($data[0], "Balan") !== false) {
            continue;
        } elseif (strpos($data[0], 'M') !== false && strpos($data[0], 'dia') !== false) {
            $media = str_replace(',', '.', str_replace('%', '', $data[$pos['real']]));
        } else {
            // var_dump($data);
            $valreal = (int) str_replace('%', '', $data[$pos['real']]);
            // $valreal = 129;
            // $data[$pos['real']] = 129;
            // var_dump($data[$pos['objetivo']]);

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

// var_dump("Dias", $days, "Valor Real", $real, "Valor Objetivo", $objetivo);
$json = array(
    'days' => $days,
    'real' => $real,
    'objetivo' => $objetivo,
    'colors' => $colors,
    // 'balance' => $balanco,
);

// var_dump($json);

echo json_encode($json);
