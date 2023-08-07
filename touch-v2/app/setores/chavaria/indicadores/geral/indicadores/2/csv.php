<?php
// header('Content-Type: text/plain;');
$path = '../../../../../worker/csv/absorcao/';
$dir = scandir($path);
// var_dump($dir);
foreach ($dir as $file) {
    if ($file != '.' && $file != '..') {
        //Get mtime
        $mtime = filemtime($path . $file);
        // if ($mtime > time() - 60 * 60 * 168) {
        //Open csv
        $csv = fopen($path . $file, 'r');
        if ($file !== FALSE) {
            $c = 0;
            // echo ("<pre>");
            while (($data = fgetcsv($csv, 1000, ";")) !== FALSE) {
                if ($c < 6) {
                    // var_dump($data);
                    $c++;
                    continue;
                } else {
                    $real = 4;
                    if (strpos($data[0], 'Balan') !== false) {
                        $balanço = $data[$real];
                    }
                    $objetivo = 12;
                    $day = explode(";", $data[0]);
                    if (preg_match('/^[0-9]{2}\/[0-9]{2}$/', $day[0]) == false) {
                        if (strpos($day[0], 'M') !== false && strpos($day[0], 'dia') !== false) {
                            // var_dump($day[0]);
                            $media = $data[$real];
                            $media = str_replace(',', '.', str_replace('%', '', $media));
                            $shared['media'] = (float) trim($media);
                            // var_dump($info['media']);
                        }
                        continue;
                    } else if (strpos($day[0], '00/01') !== false) {
                        continue;
                    } else {
                        $day = $day[0];
                        $info[$c]["day"] = $day;
                    }

                    // var_dump($data);
                    if (isset($data[$real]) !== false) {
                        $value = str_replace(',', '.', str_replace('%', '', $data[$real]));
                        $value = (float) trim($value);
                        if ($value > 1) {
                            $info[$c]["objetivo"] = $data[$objetivo];
                            $info[$c]["value"] = $value;
                            $info[$c]["shortvalue"] = $value;
                            $monthday = $data[0];
                            // var_dump($monthday);
                            // return;
                        } elseif ($value < 0) {
                            $info[$c]["objetivo"] = $data[$objetivo];
                            $info[$c]["value"] = $value;
                            $info[$c]["shortvalue"] = $value;
                            $monthday = $data[0];
                        } else {
                            $info[$c]["objetivo"] = $data[$objetivo];
                            $info[$c]["value"] = "0";
                        }
                    } else {
                        $info[$c]["objetivo"] = $data[$objetivo];
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
