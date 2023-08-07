<?php
// header('Content-Type: text/plain;');
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
            while (($data = fgetcsv($csv, 1000, ";")) !== FALSE) {
                if ($c == 0) {
                    // var_dump($data);
                    $c++;
                    continue;
                } else {

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
                    if (isset($data[7]) !== false) {
                        $value = str_replace(',', '.', str_replace('%', '', $data[7]));
                        $value = (float) trim($value);
                        // var_dump($value);
                        if ($value > 1) {
                            $info[$c]["objetivo"] = $data[9];
                            // var_dump($data[9]);
                            $info[$c]["value"] = $value;
                            $info[$c]["shortvalue"] = $value;
                            // echo ($info[$c]["shortvalue"] . '||');
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
