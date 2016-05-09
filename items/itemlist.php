<?php
include_once 'index.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>QC ITEMS DATABASE</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="style.css" rel="stylesheet" type="text/css" />
        <script src="sorttable.js" type="text/javascript"></script>
        <script type="text/javascript">
            function ConfirmDelete() {
                var d = confirm('Do you really want to delete data?');
                if (d == false) {
                    return false;
                }
            }
        </script>
    </head>
    <body onload="document.getElementById('filter').focus()">

        <div class="wrapper">
            <div class="content" >
                <?php include 'header.php'; ?> <br>
                <!--                <a href="update.php" class="link-btn" disabled>Add New Item</a>-->

                <form action="index.php" metod ="get" name="itemFilter" class="itemFilter">
                    Enter the search phrase <input type='text' id="filter" name='item_f' value=''> and click ENTER 
                    <br>
                    (searching between: <i>Item Nr</i>, <i>SAP Nr</i>, <i>Description</i>, <i>EAN code</i>, <i>Brand name</i>, <i>Supplier number or Supplier name</i>, <i>Supplier item Nr</i>)
                    <span>found <b><?php echo count($item_list) ?></b> items</span>
                </form> 
                <br/>
                <table class="sortable">
                    <thead>
                        <tr>
                            <th>
                                QC Status
                            </th>
                            <th>
                                Item Nr
                            </th>
                            <th>
                                SAP Nr
                            </th>
                            <th>
                                Description
                            </th>
                            <th>
                                EAN
                            </th>
                            <th>
                                Brand
                            </th>
                            <th>
                                Supplier Nr<br> and Name
                            </th>
                            <th>
                                Supplier Item Nr
                            </th>
                            <th>
                                SAP Status
                            </th>
                            <th>
                                Valid in SAP<br> since
                            </th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($item_list as $item_info) : ?>
                            <tr>
                                <?php
                                $col = $item_info["QM_STATUS"];
//
//                                switch ($setqcstatus) {
//                                    case "GREEN": $col = "green";
//                                        break;
//                                    case "RED": $col = "red";
//                                        break;
//                                    case "ORANGE": $col = "orange";
//                                        break;
//                                    default: $col = "white";
//                                }
                                ?>
                                <td>
                                    <div style="display:none;"><?php echo $col; ?></div>
                                    <svg height="20" width="20">
                                    <circle cx="10" cy="10" r="10" stroke="black" stroke-width="1" fill="<?php echo $col; ?>" />
                                    </svg>
                                </td>
                                <td style="text-align: left; font-size: 16px;">
                                    <?php echo $item_info["ITEM"]; ?>
                                </td>
                                <td>
                                    <?php echo $item_info["SAP"]; ?>
                                </td>
                                <td style="text-align: left;">
                                    <?php echo $item_info["DESCR_EN"]; ?>
                                </td>
                                <td>
                                    <?php echo $item_info["EAN"]; ?>
                                </td>
                                <td>
                                    <?php echo $item_info["BRAND"]; ?>
                                </td>
                                <td>
                                    <i><?php echo $item_info["VENDOR"]; ?></i><br>
                                    <?php echo $item_info["SUPPLIER"]; ?>
                                </td>
                                <td>
                                    <?php echo $item_info["ITEM_S"]; ?>
                                </td>
                                <td>
                                    <?php echo $item_info["STATUS"]; ?>
                                    <br>
                                    <?php
                                    $setstatus = $item_info["STATUS"];

                                    switch ($setstatus) {
                                        case "B1": echo "<i>Decline</i>";
                                            break;
                                        case "B3": echo "<i>Purchase block – no successor</i>";
                                            break;
                                        case "G0": echo "<i>ID phase</i>";
                                            break;
                                        case "G1": echo "<i>Introduction phase</i>";
                                            break;
                                        case "G2": echo "<i>Active</i>";
                                            break;
                                        case "G3": echo "<i>op=op (ending)</i>";
                                            break;
                                        case "P1": echo "<i>Promotion item</i>";
                                            break;
                                        case "U0": echo "<i>End of life time</i>";
                                            break;
                                        case "N/A": echo "<i>No SAP no.</i>";
                                            break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php echo $item_info["VALID_DATE"]; ?>
                                </td>
                                <td>
                                    <form method="post" action="index.php">
                                        <input type="hidden" name="ci" 
                                               value="<?php echo $item_info["id"]; ?>" />
                                        <input type="hidden" name="action" value="edit" />
                                        <input type="submit" value="Details" />
                                    </form> 
                                </td>
    <!--                                <td>
                                    <form method="POST" action="index.php" 
                                          onSubmit="return ConfirmDelete();">
                                        <input type="hidden" name="ci" 
                                               value="<?php echo $item_info["id"]; ?>" />
                                        <input type="hidden" name="action" value="delete" />
                                        <input type="submit" value="Delete" disabled />
                                    </form>
                                </td>-->
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table><br/>
            </div>
        </div>
        <footer id="footer">
                <?php include 'footer.php'; ?>
        </footer>
    </body>
</html>