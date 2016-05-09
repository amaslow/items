<?php

include 'DBConfig.php';

//========= new counter =======================
ob_start();
//$start=microtime(); 
//========= old counter ========================
//$ip = $_SERVER["REMOTE_ADDR"];
//
//$dt = new DateTime();
//$date_time = $dt->format('Y.m.d H:i:s');
//$date_only = $dt->format('Y.m.d');
//
//$logfile = fopen("log/log_" . $date_only . ".txt", "a") or die("can't open file");
//fwrite($logfile, $date_time . " " . $ip . "\n");
//fclose($logfile);
//exec('java -jar log/Log.jar');

if (isset($_POST['action_type'])) {
    if ($_POST['action_type'] == 'add' or $_POST['action_type'] == 'edit') {
        $item_id = mysqli_real_escape_string($link, strip_tags($_POST['id']));
        $brand = mysqli_real_escape_string($link, strip_tags($_POST['BRAND']));
        $item_no = mysqli_real_escape_string($link, strip_tags($_POST['ITEM']));
        $sap_no = mysqli_real_escape_string($link, strip_tags($_POST['SAP']));
        $qcstatus = mysqli_real_escape_string($link, strip_tags($_POST['QM_STATUS']));
        $supplier = mysqli_real_escape_string($link, strip_tags($_POST['SUPPLIER']));
        $item_s = mysqli_real_escape_string($link, strip_tags($_POST['ITEM_S']));
        $status = mysqli_real_escape_string($link, strip_tags($_POST['STATUS']));

        if ($_POST['action_type'] == 'add') {
            $sql = "insert into items set 
					BRAND = '$brand',
                                        ITEM = '$item_no',
					SAP = '$sap_no',
					SUPPLIER = '$supplier',
					ITEM_S = '$item_s',
					STATUS = '$status'";
        } else {
            $sql = "update items set 
					BRAND = '$brand',
                                        ITEM = '$item_no',
					SAP = '$sap_no',
					SUPPLIER = '$supplier',
					ITEM_S = '$item_s',
					STATUS = '$status' 
					where id = $item_id";
        }

        if (!mysqli_query($link, $sql)) {
            echo 'Error Saving Data. ' . mysqli_error($link);
            exit();
        }
    }
    header('Location: itemlist.php');
    exit();
}

$gresult = '';
if (isset($_POST["action"]) and $_POST["action"] == "edit") {
    $id = (isset($_POST["ci"]) ? $_POST["ci"] : '');
    $sql = "SELECT * FROM items WHERE id = $id;";

    $result = mysqli_query($link, $sql);

    if (!$result) {
        echo mysqli_error($link);
        exit();
    }

    $gresult = mysqli_fetch_array($result);

    include 'update.php';
    exit();
}

if (isset($_POST["action"]) and $_POST["action"] == "delete") {
    $id = (isset($_POST["ci"]) ? $_POST["ci"] : '');
    $sql = "delete from items where id = $id";

    $result = mysqli_query($link, $sql);

    if (!$result) {
        echo mysqli_error($link);
        exit();
    }
}

$item_ch = (isset($_GET["item_f"]) ? $_GET["item_f"] : 'ARTURO');
if (empty($_GET["item_f"])) {
    $item_ch = 'ARTURO';
}
$item_ch_1 = substr($item_ch, 0, 2) . "." . substr($item_ch, 2, 3) . "." . substr($item_ch, 5, 2);
$sql = "SELECT * FROM items WHERE item like '%$item_ch%' or item_s like '%$item_ch%' or sap like '%$item_ch%' or sap like '%$item_ch_1%' 
or vendor like '%$item_ch%' or supplier like '%$item_ch%' or brand like '%$item_ch%' or ean like '%$item_ch%' 
or descr_en like '%$item_ch%'
order by item;";

$result = mysqli_query($link, $sql);

if (!$result) {
    echo mysqli_error($link);
    exit();
}

while ($rows = mysqli_fetch_array($result, MYSQL_BOTH)) {
    $item_list[] = array(
        'id' => $rows['id'],
        'ITEM' => $rows['ITEM'],
        'SAP' => $rows['SAP'],
        'QM_STATUS' => $rows['QM_STATUS'],
        'DESCR_EN' => $rows['DESCR_EN'],
        'EAN' => $rows['EAN'],
        'BRAND' => $rows['BRAND'],
        'VENDOR' => $rows['VENDOR'],
        'SUPPLIER' => $rows['SUPPLIER'],
        'ITEM_S' => $rows['ITEM_S'],
        'STATUS' => $rows['STATUS'],
        'VALID_DATE' => $rows['VALID_DATE']);
}
include 'itemlist.php';
exit();
?>