<?php
// phpinfo();
// header('Content-Type: text/plain;');
header('Content-Type: application/json; charset=utf-8');
$dir = scandir('../../app/setores/worker/csv/gastos/all/');
foreach ($dir as $file) {
    if ($file != '.' && $file != '..') {
        //Get mtime
        $mtime = filemtime('../../app/setores/worker/csv/gastos/all/' . $file);
        // if ($mtime > time() - 60 * 60 * 168) {
        //Open csv
        $csv = fopen('../../app/setores/worker/csv/gastos/all/' . $file, 'r');
        if ($file !== FALSE) {
            $c = 0;
            // echo ("<pre>");
            while (($data = fgetcsv($csv, 5000, ";")) !== FALSE) {
                if ($c == 0) {
                    // var_dump($data);
                    $c++;
                    continue;
                } else {
                    if (strpos($data[0], 'M') !== false && strpos($data[0], 'dia') !== false) {
                        $media = $data[15];
                        $media = substr($media, 3);
                        $media = (int)trim($media);
                        // var_dump($media);
                    }
                    if (strpos($data[0], 'Balan') !== false) {
                        $val = $data[15];
                        $balanço = $val;
                    }
                    ### DAY DD/MM
                    $day = explode(";", $data[0]);
                    if (preg_match('/^[0-9]{2}\/[0-9]{2}$/', $day[0]) == false) {
                        continue;
                    } else if (strpos($day[0], '00/01') !== false) {
                        continue;
                    } else {
                        $day = $day[0];
                        $info[$c]["day"] = $day;
                    }
                    // var_dump($data);
                    ### VALUE
                    if (isset($data[15]) !== false) {
                        $value = substr($data[15], 3);
                        $value = (int)trim($value);
                        // var_dump($value);
                        if ($value > 1) {
                            $info[$c]["objetivo"] = $data[14];
                            // var_dump($data[14]);
                            $info[$c]["value"] = $value;
                            $info[$c]["shortvalue"] = round($value) . "K";
                            ### Percent
                            if (isset($data[9]) !== false) {
                                if ($data[9] !== "") {
                                    $budget = trim($data[9]);
                                }
                            }
                            if (isset($data[8]) !== false) {
                                if ($data[8] !== "") {
                                    $acum = trim($data[8]);
                                }
                            }
                            if (isset($data[7]) !== false) {
                                if ($data[7] !== "") {
                                    $yesterday = trim($data[7]);
                                }
                            }
                            $monthday = $data[0];
                            // var_dump($monthday);
                        } else {
                            $info[$c]["value"] = "0";
                        }
                    } else {
                        $info[$c]["value"] = "0";
                    }
                }
                $c++;
            }
            // var_dump($info);
        }
        fclose($csv);
        // }
    }
}

// var_dump($info);

$arrDias = array();
foreach ($info as $key => $value) {
    $arrDias[] = $value["day"];
}
// var_dump($arrDias);

$arrObjetivo = array();
foreach ($info as $key => $value) {
    @$arrObjetivo[] = (int)substr($value["objetivo"], 0, 3);
}
$arrObjetivo = $arrObjetivo[0];
// var_dump($arrObjetivo);

$arrValue = array();
$arrColors = array();
foreach ($info as $key => $value) {
    $arrValue[] = $value["value"];
    if ($value["value"] > $arrObjetivo) {
        $arrColors[] = "#008100";
    } else {
        $arrColors[] = "#FF0000";
    }
}
// var_dump($arrValue);
// var_dump($arrColors);
$arrDias[] = "Média";
// var_dump($media);
$arrValue[] = $media;


$json = array(
    'days' => $arrDias,
    'real' => $arrValue,
    'objetivo' => $arrObjetivo,
    'colors' => $arrColors,
    'balance' => $balanço,
);
echo json_encode($json);
