<?php
error_reporting(0);
// header('Content-Type: text/plain');
# Get csv from ../csv/gas/
$gas_csv = glob('../csv/gas/*.csv');
$gas_csv = $gas_csv[0];
# Open csv
$gas_csv = fopen($gas_csv, 'r');
# Read csv
$sheetData2 = array();
while (($data = fgetcsv($gas_csv, 1000, ";")) !== FALSE) {
    $sheetData2[] = $data;
}
fclose($gas_csv);


// return;
// echo ('<pre>');
$gas_index = 0;
$max_day_gas = 0;
foreach ($sheetData2 as $key => $value) {
    //Get last occurence of $value[10];
    if ($key > 10 && $key < 42) {
        $consumo_projetado = (int) round($value[10]); //CONSUMO PLANEJADO
        if ($consumo_projetado > $max_day_gas) {
            $max_day_gas = $consumo_projetado;
            // var_dump($value[10]);
        }
    }
}
// var_dump($max_day_gas);

// return;
foreach ($sheetData2 as $key => $value) {
    if ($key > 10 && $key < 42) {
        // echo ('<pre>');
        // var_dump($value);
        $day_gas = ''; // [9][3]
        $consumo_acumulado_gas = ''; // [9][6]
        $consumo_projetado_acum = ''; // [9][8]

        //1-Dec to dd/mm/yyyy
        $day_gas_t = $value[3];
        if ($day_gas_t == "") {
            $show = false;
        } else {
            $show = true;
            $exploded = explode('/', $day_gas_t);
            $day = $exploded[0];
            $month = $exploded[1];
        }

        switch ($month) {
            case 'jan':
                $month = '01';
                break;
            case 'fev':
                $month = '02';
                break;
            case 'mar':
                $month = '03';
                break;
            case 'abr':
                $month = '04';
                break;
            case 'mai':
                $month = '05';
                break;
            case 'jun':
                $month = '06';
                break;
            case 'jul':
                $month = '07';
                break;
            case 'ago':
                $month = '08';
                break;
            case 'set':
                $month = '09';
                break;
            case 'out':
                $month = '10';
                break;
            case 'nov':
                $month = '11';
                break;
            case 'dez':
                $month = '12';
                break;
        }

        $daymonth = $month . '/' . $day;
        $day_gas = date('d', strtotime($daymonth));
        // var_dump("$day_gas_t,$day_gas");

        $consumo_acumulado_gas = (int) round($value[6]); //Consumo real
        $consumo_projetado_acum = (int) round($value[10]); //Consumo projetado
        $consumo_projetado = (int) round($value[7]); //Consumo projetado


        $consumo_projetado_max = ($max_day_gas); //Consumo projetado max
        // echo ('<pre>');
        // var_dump($max_day_gas);
        // var_dump($value);
        // var_dump("Acum. Gasto Real $consumo_acumulado_gas", "Acum Gasto Planejado $consumo_projetado_acum", "Max Gasto Planejado $consumo_projetado_max");
        // return;

        $gas_max = $consumo_projetado_max;
        $gas_proj = $consumo_projetado_acum;
        $gas_real = $consumo_acumulado_gas;

        //To K
        $gas_max = (int) round($gas_max / 1000);
        $gas_proj = (int) round($gas_proj / 1000);
        $gas_real = (int) round($gas_real / 1000);


        $max_percent = round($gas_max / $gas_max * 100); //Maximo planejado
        $mid_percent = round($gas_real / $gas_max * 100); //Consumo real
        $min_percent = round($gas_proj / $gas_max * 100); //Minimo planejado

        $max_percent = 100 - $max_percent;
        $mid_percent = 100 - $mid_percent;
        $min_percent = 100 - $min_percent;

        // var_dump(array($max_percent, $mid_percent, $min_percent));
        if ($show !== false) {


            echo ("<div class='gas-column gas-column-$gas_index'>");

            if ($mid_percent == 100) {
            } else {
                echo ("<div style='top:" . $mid_percent . "%' class='gas-dot gas-mid gas-$gas_index'></div>");
            }

            echo ("<div style='top:" . $min_percent . "%' class='gas-dot gas-min gas-$gas_index'></div>
        <div class='gas-day'><div class='gas-text'>" . $day_gas . "</div></div>
        </div>
        ");
        }
        $gas_index++;
    }
}
