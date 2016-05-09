<?php
ob_start();

function open($name = "", $trybe = "r", $value = "0") {
    if (file_exists($name)) {
        $file = fopen($name, $trybe);
        flock($file, 1);
        if (filesize($name) > 0)
            return fread(fopen($name, $trybe), filesize($name));
        else
            return $value;
        flock($file, 3);
        fclose($file);
    }
}

function save($name = "", $date = "", $trybe = "w") {
    if (file_exists($name)) {
        $file = fopen($name, $trybe);
        flock($file, 2);
        fwrite($file, $date);
        flock($file, 3);
        fclose($file);
    }
}

$scr[0] = "log/ip.txt";
$scr[1] = "log/dane.txt";
$scr[2] = "log/log.txt";


$current_ip = $_SERVER['REMOTE_ADDR'];
$time_current = (date("G") * 3600) + (date("i") * 60) + date("s");      //date(G)*60+date(i); 3600 = 1h; 
$time_online = 600;
$time_delay = 900;
$date = date("Y-m-d", time());
$online = 1;
$variable = False;
$data_new = '';


$data = explode(chr(1), open($scr[1]));
if (!strcmp($data[2], $date)) {
    $tab1 = explode(chr(1), open($scr[0]));
    for ($x = 0; $x <= count($tab1) - 2; $x+=2) {
        if (!strcmp($current_ip, $tab1[$x])) {
            if ($time_current - $time_delay < $tab1[$x + 1])
                $variable = True;
        }
        else {
            if ($time_current - $time_delay < $tab1[$x + 1]) {
                $data_new .= $tab1[$x] . chr(1) . $tab1[$x + 1] . chr(1);
                if ($time_current - $time_online < $tab1[$x + 1])
                    $online++;
            }
        }
    }
    if ($variable == 0) {
        $data[0]++;
        $data[1]++;
        save($scr[1], $data[0] . chr(1) . $data[1] . chr(1) . $data[2]);
        $line_new = "$data[0]-" . chr(1) . "- $data[1]-" . chr(1) . "- $online-" . chr(1) . date("- Y-m-d -" . chr(1) . "- G:i:s -", time()) . chr(1) . "- $current_ip-" . chr(13) . chr(10);
        save($scr[2], $line_new, "a");
    }
} else {
    save($scr[0]);
    $data[0]++;
    $data[1] = 1;
    save($scr[1], $data[0] . chr(1) . $data[1] . chr(1) . $date);
    $line_new = "$data[0]-" . chr(1) . "- $data[1]-" . chr(1) . "- $online-" . chr(1) . date("- Y-m-d -" . chr(1) . "- G:i:s -", time()) . chr(1) . "- $current_ip-" . chr(13) . chr(10);
    save($scr[2], $line_new, "a");
}
$data_new .= $current_ip . chr(1) . $time_current . chr(1);
save($scr[0], $data_new);
echo "visits: <font color=#ADCAFF><b>$data[0]</b></font>";
echo " / today: <font color=#ADCAFF><b>$data[1]</b></font>";
echo " / on-line: <font color=#ADCAFF><b>$online</b></font>";
?>