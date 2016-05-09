<!DOCTYPE html>
<html>
    <head>
        <title>Item - Update</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link href="style.css" rel="stylesheet" type="text/css" />

        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.2.min.js"></script>

        <script type="text/javascript">

            
            $(document).ready(function() {
                $('#tab1').find('input, textarea').prop('readonly',true);
                $("#content1 div").hide(); // Initially hide all content

                $("#tabs li:first").attr("id","current"); // Activate first tab

                $("#content1 div:first").fadeIn(); // Show first tab content

                $('#tabs a').click(function(e) {

                    e.preventDefault();

                    $("#content1 div").hide(); //Hide all content

                    $("#tabs li").attr("id",""); //Reset id's

                    $(this).parent().attr("id","current"); // Activate this

                    $('#' + $(this).attr('title')).fadeIn(); // Show content for current tab

                });

            })();
            
            $('input.cert-fld').filter(function () {
                return $(this).text() === 'MISSING';
            }).css('color', 'red');
            
            function Validate() {
                var valid = true;
                var message = '';
                var item = document.getElementById("item");
                var brand = document.getElementById("brand");

                if (item.value.trim() == '') {
                    valid = false;
                    message = message + '*Item number is required' + '\n';
                }
                if (brand.value.trim() == '') {
                    valid = false;
                    message = message + '*Brand name is required';
                }

                if (valid == false) {
                    alert(message);
                    return false;
                }
            }

            function GotoHome() {
                //                window.location = 'index.php?';
                window.history.back();
            }
            
            
            function ShowDoC(item){
                var myWin = window.open('G/S&L_Data/QC/Certificates for customers/'+item+'_DoC.pdf');
            }
            
            function readOnlyCheckBox() {
                return false;
            }

        </script>
        <?php
        $sapWithoutDots = str_replace(".", "", $gresult["SAP"]);
        $directory = "G/S&L_Data/Product Content/PRODUCTS/" . $sapWithoutDots . "/";
        $linkG = "http://172.17.18.92/items/";
        $oldDocDirectory = "G/S&L_Data/QC/Certificates for customers/";
        ?>
    </head>
    <body>
        <div class="wrapper">
            <!--            <div class="content"  style="width: 100% !important;">-->
            <div class="content">
                <table>
                    <tr>
                        <td>
                            <table class="toptable">
                                <tr>
                                    <td colspan="2">
                                        <?php
                                        $col = $gresult["QM_STATUS"];
                                        echo '<div><svg height="26" width="26">
                                        <circle cx="13" cy="13" r="13" stroke="black" stroke-width="1" fill="' . $col . '" />
                                        </svg></div>';
                                        ?>
                                        <label style="line-height:27px;" for="item">Item Nr: </label>
                                        <input type="text" name="item" style="font-size:25px; height:27px;" 
                                               value="<?php echo (isset($gresult) ? $gresult["ITEM"] : ''); ?>" 
                                               id="item" class="txt-fld" readonly/>
                                    </td>
                                    <td>
                                        <label style="line-height:27px;" for="sap">SAP Nr: </label>
                                        <input type="text" name="sap" style="font-size:25px; height:27px;" 
                                               value="<?php echo (isset($gresult) ? $gresult["SAP"] : ''); ?>" 
                                               id="sap" class="txt-fld" size="8" readonly/>
                                    </td>
                                    <td style="text-align: right">
                                        <label style="line-height:27px;" for="brand">Brand: </label>
                                        <input type="text" name="brand" style="height:27px; font-style: italic;"
                                               value="<?php echo (isset($gresult) ? $gresult["BRAND"] : ''); ?>" 
                                               id="BRAND" class="txt-fld" size="12" readonly/>
                                    </td>
                                </tr>    
                                <tr>
                                    <td>
                                        <label for="vendor">Vendor: </label>
                                        <input type="text" name="vendor" 
                                               value="<?php echo (isset($gresult) ? $gresult["VENDOR"] : ''); ?>" 
                                               id="vendor" class="txt-fld" size="2" readonly/>
                                    </td>                                
                                    <td>
                                        <label for="supplier">Supplier: </label>
                                        <input type="text" name="supplier" 
                                               value="<?php echo (isset($gresult) ? $gresult["SUPPLIER"] : ''); ?>" 
                                               id="supplier" class="txt-fld" size="35" readonly/>
                                    </td>
                                    <td colspan="2">
                                        <label for="item_s">Supplier Item Nr: </label>
                                        <input type="text" name="item_s" 
                                               value="<?php echo (isset($gresult) ? $gresult["ITEM_S"] : ''); ?>" 
                                               id="item_s" class="txt-fld" readonly/>
                                    </td>

                                </tr>
                                <tr>
                                    <td>
                                        <label for="status">SAP Status: </label>
                                        <input type="text" name="status" 
                                               value="<?php echo (isset($gresult) ? $gresult["STATUS"] : ''); ?>" 
                                               id="status" class="txt-fld" size="1" readonly/>
                                        <br><?php
                                        $setstatus = $gresult["STATUS"];

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
                                        <label for="hierarchy">Hierarchy: </label>
                                        <input type="text" name="hierarchy" 
                                               value="<?php echo (isset($gresult) ? $gresult["HIERARCHY"] : ''); ?>" 
                                               id="hierarchy" class="txt-fld" size="2" readonly/>
                                        <br><?php
                                        $sethierarchy = $gresult["HIERARCHY"];
                                        switch ($sethierarchy) {
                                            case "S0100": echo "<i>Fire (Dennis Hungs / Michiel van de Riet)</i>";
                                                break;
                                            case "S0200": echo "<i>Door-entry (Dennis Hungs / Ross Anderson)</i>";
                                                break;
                                            case "S0300": echo "<i>Camera (Dennis Hungs / Sven Emmen)</i>";
                                                break;
                                            case "S0400": echo "<i>Alarm (Dennis Hungs / Ad Daamen)</i>";
                                                break;
                                            case "S0500": echo "<i>Home-automation (Dennis Hungs / Ad Daamen)</i>";
                                                break;
                                            case "S0600": echo "<i>Personal care (Dennis Hungs / Sven Emmen)</i>";
                                                break;
                                            case "S0900": echo "<i>Other (Dennis Hungs / Michiel van de Riet)</i>";
                                                break;
                                            case "S1000": echo "<i>Functional (Mark Lankhaar / Jan-Willem Francke)</i>";
                                                break;
                                            case "S1100": echo "<i>Indoor (Mark Lankhaar / Marcel Trouw)</i>";
                                                break;
                                            case "S1200": echo "<i>Outdoor (Mark Lankhaar / Jan-Willem Francke)</i>";
                                                break;
                                            case "S1300": echo "<i>Bulbs (Mark Lankhaar / Kit YingKong)</i>";
                                                break;
                                            case "S1400": echo "<i>Smartlights (Mark Lankhaar / Ad Netten)</i>";
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <label for="valid">Valid in SAP since: </label>
                                        <input type="text" name="valid" 
                                               value="<?php echo (isset($gresult) ? $gresult["VALID_DATE"] : ''); ?>" 
                                               id="valid" class="txt-fld" size="6" readonly/>
                                    </td>
                                    <td>
                                        <label for="valid">Return place: </label>
                                        <input type="text" name="valid" 
                                               value="<?php echo (isset($gresult) ? $gresult["RETURN_PLACE"] : ''); ?>" 
                                               id="valid" class="txt-fld" size="9" readonly/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="ean">EAN: </label>
                                        <input type="text" name="ean" 
                                               value="<?php echo (isset($gresult) ? $gresult["EAN"] : ''); ?>" 
                                               id="ean" class="txt-fld" size="12" readonly/>
                                    </td>
                                    <td style="text-align: left">
                                        <label for="ean_inn">EAN inner box: </label>
                                        <input type="text" name="ean_inn" 
                                               value="<?php echo (isset($gresult) ? $gresult["EAN_INN"] : ''); ?>" 
                                               id="ean_inn" class="txt-fld" size="12" readonly/>
                                    </td>
                                    <td>
                                        <label for="ean_out">EAN outer box: </label>
                                        <input type="text" name="ean_out" 
                                               value="<?php echo (isset($gresult) ? $gresult["EAN_OUT"] : ''); ?>" 
                                               id="ean_out" class="txt-fld" size="12" readonly/>
                                    </td>
                                    <td>
                                        <label for="location">Pickup location: </label>
                                        <input type="text" name="location" 
                                               value="<?php echo (isset($gresult) ? $gresult["LOCATION"] : ''); ?>" 
                                               id="location" class="txt-fld" size="6" readonly/>
                                    </td>                                    
                                </tr>

                            </table>
                        </td>
                        <td 
                        <?php
                        if (!isset($gresult["REMARKS_AUTH"]) || !strlen($gresult["REMARKS_AUTH"]) > 0) {
                            echo ' rowspan="2"';
                        }
                        ?>
                            >
                                <?php
                                $imgFile = $directory . "LR_" . $sapWithoutDots . "_2.jpg";
                                $imgFileHR = $directory . "HR_" . $sapWithoutDots . "_2.jpg";
                                $imgFile10 = $directory . "LR_" . $sapWithoutDots . "_10.jpg";
                                $imgFile10HR = $directory . "HR_" . $sapWithoutDots . "_10.jpg";
                                $imgFile3 = $directory . "LR_" . $sapWithoutDots . "_3.jpg";
                                $imgFile3HR = $directory . "HR_" . $sapWithoutDots . "_3.jpg";
                                
                                if (file_exists($imgFile)) {
                                    $data = getimagesize($imgFile);
                                    $imgWidth = $data[0];
                                    $imgHeight = $data[1];
                                    $winWidth = 250;
                                    $winHeight = 270;
                                    if ($imgHeight / $imgWidth > $winHeight / $winWidth) {
                                        $newHeight = $winHeight;
                                        $newWidth = ($imgWidth / $imgHeight) * $newHeight;
                                        $imgFile_new = $imgFile;
                                        $imgFileHR_new = $imgFileHR;
                                    } else {
                                        $newWidth = $winWidth;
                                        $newHeight = ($imgHeight / $imgWidth) * $newWidth;
                                        $imgFile_new = $imgFile;
                                        $imgFileHR_new = $imgFileHR;
                                    }
                                } elseif (file_exists($imgFile10)) {
                                    $data = getimagesize($imgFile10);
                                    $imgWidth = $data[0];
                                    $imgHeight = $data[1];
                                    $winWidth = 250;
                                    $winHeight = 270;
                                    if ($imgHeight / $imgWidth > $winHeight / $winWidth) {
                                        $newHeight = $winHeight;
                                        $newWidth = ($imgWidth / $imgHeight) * $newHeight;
                                        $imgFile_new = $imgFile10;
                                        $imgFileHR_new = $imgFile10HR;
                                    } else {
                                        $newWidth = $winWidth;
                                        $newHeight = ($imgHeight / $imgWidth) * $newWidth;
                                        $imgFile_new = $imgFile10;
                                        $imgFileHR_new = $imgFile10HR;
                                    }
                                } elseif (file_exists($imgFile3)) {
                                    $data = getimagesize($imgFile3);
                                    $imgWidth = $data[0];
                                    $imgHeight = $data[1];
                                    $winWidth = 250;
                                    $winHeight = 270;
                                    if ($imgHeight / $imgWidth > $winHeight / $winWidth) {
                                        $newHeight = $winHeight;
                                        $newWidth = ($imgWidth / $imgHeight) * $newHeight;
                                        $imgFile_new = $imgFile3;
                                        $imgFileHR_new = $imgFile3HR;
                                    } else {
                                        $newWidth = $winWidth;
                                        $newHeight = ($imgHeight / $imgWidth) * $newWidth;
                                        $imgFile_new = $imgFile3;
                                        $imgFileHR_new = $imgFile3HR;
                                    }
                                }
                                ?>
                            <a href="<?php echo $imgFileHR_new; ?>" 
                               target="_blank"><img src="<?php echo $imgFile_new; ?>" alt="No Image Available" 
                                                 style="width:<?php echo $newWidth ?>px;height:<?php echo $newHeight ?>px; margin-left: 20px;"/>
                            </a>

                        </td>
                    </tr>
                    <tr>
                        <td>
                            <table class="descrtable">
                                <tr>
                                    <td>
                                        <label for="descr_en">EN: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="descr_en" 
                                               value="<?php echo (isset($gresult) ? $gresult["DESCR_EN"] : ''); ?>" 
                                               id="descr_en" class="descr-fld" readonly/>
                                    </td>
                                    <td>
                                        <label for="descr_de">DE: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="descr_de" 
                                               value="<?php echo (isset($gresult) ? $gresult["DESCR_DE"] : ''); ?>" 
                                               id="descr_de" class="descr-fld" readonly/>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="descr_fr">FR: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="descr_fr" 
                                               value="<?php echo (isset($gresult) ? $gresult["DESCR_FR"] : ''); ?>" 
                                               id="descr_fr" class="descr-fld" readonly/>
                                    </td>                        
                                    <td>
                                        <label for="descr_nl">NL: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="descr_nl" 
                                               value="<?php echo (isset($gresult) ? $gresult["DESCR_NL"] : ''); ?>" 
                                               id="descr_nl" class="descr-fld" readonly/>
                                    </td>
                                </tr>
                                <tr>                        
                                    <td>
                                        <label for="descr_es">ES: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="descr_es" 
                                               value="<?php echo (isset($gresult) ? $gresult["DESCR_ES"] : ''); ?>" 
                                               id="descr_es" class="descr-fld" readonly/>
                                    </td>
                                    <td>
                                        <label for="descr_pl">PL: </label>
                                    </td>
                                    <td>
                                        <input type="text" name="descr_pl" 
                                               value="<?php echo (isset($gresult) ? $gresult["DESCR_PL"] : ''); ?>" 
                                               id="descr_pl" class="descr-fld" readonly/>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <?php
                        if (isset($gresult["REMARKS_AUTH"]) && strlen($gresult["REMARKS_AUTH"]) > 0) {
                            echo '<td>Authority remarks:<br/>';
                            echo '<textarea style="color: red; border-top-color: red; border-right-color: red; border-bottom-color: red; border-left-color: red" rows="3" cols="50" class="remark_auth-field" readonly>' . (isset($gresult) ? $gresult["REMARKS_AUTH"] : '') . '</textarea>';
                            echo '</td>';
                        }
                        ?>
                    </tr>
                </table>
                <?php
                if (isset($gresult["COMPONENT1"]) && strlen($gresult["COMPONENT1"]) > 0) {
                    $id_set = $gresult["id"];
                    $sql_comp = "SELECT 
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT1,9) FROM items WHERE id= $id_set)) as qm_status_comp1,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT1,9) FROM items WHERE id= $id_set)) as id_status_comp1,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT2,9) FROM items WHERE id= $id_set)) as qm_status_comp2,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT2,9) FROM items WHERE id= $id_set)) as id_status_comp2,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT3,9) FROM items WHERE id= $id_set)) as qm_status_comp3,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT3,9) FROM items WHERE id= $id_set)) as id_status_comp3,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT4,9) FROM items WHERE id= $id_set)) as qm_status_comp4,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT4,9) FROM items WHERE id= $id_set)) as id_status_comp4,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT5,9) FROM items WHERE id= $id_set)) as qm_status_comp5,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT5,9) FROM items WHERE id= $id_set)) as id_status_comp5,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT6,9) FROM items WHERE id= $id_set)) as qm_status_comp6,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT6,9) FROM items WHERE id= $id_set)) as id_status_comp6,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT7,9) FROM items WHERE id= $id_set)) as qm_status_comp7,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT7,9) FROM items WHERE id= $id_set)) as id_status_comp7,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT8,9) FROM items WHERE id= $id_set)) as qm_status_comp8,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT8,9) FROM items WHERE id= $id_set)) as id_status_comp8,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT9,9) FROM items WHERE id= $id_set)) as qm_status_comp9,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT9,9) FROM items WHERE id= $id_set)) as id_status_comp9,
                        (SELECT qm_status FROM items WHERE sap=(SELECT left(COMPONENT10,9) FROM items WHERE id= $id_set)) as qm_status_comp10,
                        (SELECT id FROM items WHERE sap=(SELECT left(COMPONENT10,9) FROM items WHERE id= $id_set)) as id_status_comp10 
                        FROM items WHERE id=$id_set;";
                    $result_comp = mysqli_query($link, $sql_comp);
                    if (!$result_comp) {
                        echo mysqli_error($link);
                        exit();
                    }
                    $gresult_comp = mysqli_fetch_array($result_comp);

                    mysqli_close($link);

                    echo '<label id="comp-label">Components:</label>';
                    echo '<table class="components">';
                    echo '<tr>';
                    if (isset($gresult["COMPONENT1"]) && strlen($gresult["COMPONENT1"]) > 0) {
                        $col_comp1 = $gresult_comp["qm_status_comp1"];
                        $id_comp1 = $gresult_comp["id_status_comp1"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp1 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp1 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT1"] : '') . '" />';
                        echo '</form>';
                        echo '</td>';
                    }
                    if (isset($gresult["COMPONENT2"]) && strlen($gresult["COMPONENT2"]) > 0) {
                        $col_comp2 = $gresult_comp["qm_status_comp2"];
                        $id_comp2 = $gresult_comp["id_status_comp2"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp2 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp2 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT2"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp2" value="' . (isset($gresult) ? $gresult["COMPONENT2"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    if (isset($gresult["COMPONENT3"]) && strlen($gresult["COMPONENT3"]) > 0) {
                        $col_comp3 = $gresult_comp["qm_status_comp3"];
                        $id_comp3 = $gresult_comp["id_status_comp3"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp3 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp3 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT3"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp3" value="' . (isset($gresult) ? $gresult["COMPONENT3"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    if (isset($gresult["COMPONENT4"]) && strlen($gresult["COMPONENT4"]) > 0) {
                        $col_comp4 = $gresult_comp["qm_status_comp4"];
                        $id_comp4 = $gresult_comp["id_status_comp4"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp4 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp4 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT4"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp4" value="' . (isset($gresult) ? $gresult["COMPONENT4"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    if (isset($gresult["COMPONENT5"]) && strlen($gresult["COMPONENT5"]) > 0) {
                        $col_comp5 = $gresult_comp["qm_status_comp5"];
                        $id_comp5 = $gresult_comp["id_status_comp5"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp5 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp5 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT5"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp5" value="' . (isset($gresult) ? $gresult["COMPONENT5"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    echo '</tr>';
                    echo '<tr>';
                    if (isset($gresult["COMPONENT6"]) && strlen($gresult["COMPONENT6"]) > 0) {
                        $col_comp6 = $gresult_comp["qm_status_comp6"];
                        $id_comp6 = $gresult_comp["id_status_comp6"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp6 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp6 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT6"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp6" value="' . (isset($gresult) ? $gresult["COMPONENT6"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    if (isset($gresult["COMPONENT7"]) && strlen($gresult["COMPONENT7"]) > 0) {
                        $col_comp7 = $gresult_comp["qm_status_comp7"];
                        $id_comp7 = $gresult_comp["id_status_comp7"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp7 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp7 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT7"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp7" value="' . (isset($gresult) ? $gresult["COMPONENT7"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    if (isset($gresult["COMPONENT8"]) && strlen($gresult["COMPONENT8"]) > 0) {
                        $col_comp8 = $gresult_comp["qm_status_comp8"];
                        $id_comp8 = $gresult_comp["id_status_comp8"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp8 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp8 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT8"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp8" value="' . (isset($gresult) ? $gresult["COMPONENT8"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    if (isset($gresult["COMPONENT9"]) && strlen($gresult["COMPONENT9"]) > 0) {
                        $col_comp9 = $gresult_comp["qm_status_comp9"];
                        $id_comp9 = $gresult_comp["id_status_comp9"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp9 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp9 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT9"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp9" value="' . (isset($gresult) ? $gresult["COMPONENT9"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    if (isset($gresult["COMPONENT10"]) && strlen($gresult["COMPONENT10"]) > 0) {
                        $col_comp10 = $gresult_comp["qm_status_comp10"];
                        $id_comp10 = $gresult_comp["id_status_comp10"];
                        echo '<td>';
                        echo '<div><svg height="16" width="16">
                                <circle cx="8" cy="8" r="8" stroke="black" stroke-width="1" fill="' . $col_comp10 . '" />
                              </svg></div>';
                        echo '<form method="post" action="index.php">';
                        echo '<input type="hidden" name="ci" value="' . $id_comp10 . '" />';
                        echo '<input type="hidden" name="action" value="edit" />';
                        echo '<input type="submit" value="' . (isset($gresult) ? $gresult["COMPONENT10"] : '') . '" />';
                        echo '</form>';
                        //echo '<input type="text" name="comp10" value="' . (isset($gresult) ? $gresult["COMPONENT10"] : '') . '" class="comp-fld" readonly/>';
                        echo '</td>';
                    }
                    echo '</tr>';
                    echo '</table>';
                }
                ?>
            </div>
            <ul id="tabs">
                <li><a href="#" title="tab1">Product Content</a></li>
                <li><a href="#" title="tab2">Certificates</a></li>
                <li><a href="#" title="tab3">Standards</a></li>
                <li><a href="#" title="tab4">Specifications</a></li>
                <?php
                if ($gresult["EUP"] == 1) {
                    echo '<li><a href="#" title="tab5">ErP Data sheet</a></li>';
                }
                ?>

                <!--                <li><a href="#" title="tab6">Sample sheet</a></li>-->
            </ul>
            <div id="content1">            
                <div id="tab1">
                    <table class="prodcon">
                        <?php
                        $files = scandir($directory);
                        $pic_count = $man_count = $pac_count = $enlabel_count = $vid_count = $doc_count = $td_count = 0;
                        $pic_arrayLR = $pic_arrayMR = $pic_arrayHR = $man_array = $pac_array = $enlabel_array = $vid_array = $doc_array = $td_array = array();

                        foreach ($files as $value) {
                            if ((substr($value, 0, 2) == "LR" && substr($value, -4) == ".jpg") || (substr($value, 0, 2) == "LR" && substr($value, -4) == ".JPG")) {
                                $pic_count++;
                                array_push($pic_arrayLR, $value);
                            }
                            if ((substr($value, 0, 2) == "MR" && substr($value, -4) == ".jpg") || (substr($value, 0, 2) == "MR" && substr($value, -4) == ".JPG")) {
                                $pic_count++;
                                array_push($pic_arrayMR, $value);
                            }
                            if ((substr($value, 0, 2) == "HR" && substr($value, -4) == ".jpg") || (substr($value, 0, 2) == "HR" && substr($value, -4) == ".JPG")) {
                                $pic_count++;
                                array_push($pic_arrayHR, $value);
                            }
                            if (substr($value, 0, 6) == "Manual" || substr($value, 0, 12) == "Installation"
                                    || substr($value, 0, 17) == "Safetyinstruction" || substr($value, 0, 11) == "Maintenance"
                                    || substr($value, 0, 12) == "Productsheet" || substr($value, 0, 9) == "Guarantee"
                                    || substr($value, 0, 5) == "Flyer" || substr($value, 0, 19) == "Productpresentation"
                                    || substr($value, 0, 4) == "Menu" || substr($value, 0, 8) == "Appendix") {
                                $man_count++;
                                array_push($man_array, $value);
                            }
                            if (substr($value, 0, 7) == "Package" || substr($value, 0, 5) == "Inlay" || substr($value, 0, 7) == "Display"
                                    || substr($value, 0, 6) == "Rating" || substr($value, 0, 10) == "Collilabel" || substr($value, 0, 10) == "Silkscreen"
                                    || substr($value, 0, 6) == "Carton" || substr($value, 0, 7) == "Sticker" || substr($value, 0, 10) == "onlinetext"
                                    || substr($value, 0, 7) == "CDlabel" || substr($value, 0, 9) == "Multipack") {
                                $pac_count++;
                                array_push($pac_array, $value);
                            }
                            if (substr($value, 0, 11) == "Energylabel") {
                                $enlabel_count++;
                                array_push($enlabel_array, $value);
                            }
                            if (substr($value, 3, 5) == "Video" || substr($value, 0, 8) == "Ringtone") {
                                $vid_count++;
                                array_push($vid_array, $value);
                            }
                            if (substr($value, 0, 3) == "DoC" || substr($value, 0, 3) == "DoP") {
                                $doc_count++;
                                array_push($doc_array, $value);
                            }
                            if (substr($value, -3) == "zip" || substr($value, 0, 3) == "CCC") {
                                $td_count++;
                                array_push($td_array, $value);
                            }
                        }
                        if ($pic_count > 0) {
                            echo "<th> Pictures </th>";
                        }
                        if ($man_count > 0) {
                            echo "<th> Manuals , Productsheets </th>";
                        }
                        if ($pac_count > 0) {
                            echo "<th> Packages , Inlays , Labels </th>";
                        }
                        if ($enlabel_count > 0) {
                            echo "<th> Energylabels </th>";
                        }
                        if ($vid_count > 0) {
                            echo "<th> Product videos , Ringtones </th>";
                        }
                        if ($doc_count > 0) {
                            echo "<th> DoC  &  DoP </th>";
                        }
                        if ($td_count > 0) {
                            echo "<th> TD </th>";
                        }
                        ?>
                        <tr>
                            <?php
                            if ($pic_count > 0) {
                                echo "<td><table class='pictures'><th>Low Resolution</th><th>Medium Resolution</th><th>High Resolution</th><tr>";
                                echo "<td>";
                                natsort($pic_arrayLR);
                                foreach ($pic_arrayLR as $value) {
                                    if (strlen(substr_replace(substr_replace($value, null, -4), null, 0, 11)) == 2) {
                                        $foto_num = substr_replace(substr_replace($value, null, -4), null, 0, 11);
                                    } else {
                                        $foto_num = '0' . substr_replace(substr_replace($value, null, -4), null, 0, 11);
                                    }
                                    switch ($foto_num) {
                                        case 02: $fotonummering = 'Side view right angle';
                                            break;
                                        case 03: $fotonummering = 'Front view';
                                            break;
                                        case 04: $fotonummering = 'Side view left angle';
                                            break;
                                        case 05: $fotonummering = 'Side view right';
                                            break;
                                        case 06: $fotonummering = 'Side view left';
                                            break;
                                        case 07: $fotonummering = 'Back view';
                                            break;
                                        case 08: $fotonummering = 'Top view';
                                            break;
                                        case 09: $fotonummering = 'Energy label';
                                            break;
                                        case 10: $fotonummering = 'Product set 1';
                                            break;
                                        case 11: $fotonummering = 'Product set 2';
                                            break;
                                        case 12: $fotonummering = 'Product set 3';
                                            break;
                                        case 13: $fotonummering = 'Product part 1';
                                            break;
                                        case 14: $fotonummering = 'Product part 2';
                                            break;
                                        case 15: $fotonummering = 'Product part 3';
                                            break;
                                        case 16: $fotonummering = 'Product part 4';
                                            break;
                                        case 17: $fotonummering = 'Product part 5';
                                            break;
                                        case 18: $fotonummering = 'Product detail 1';
                                            break;
                                        case 19: $fotonummering = 'Product detail 2';
                                            break;
                                        case 20: $fotonummering = 'Product detail 3';
                                            break;
                                        case 21: $fotonummering = 'Sphere picture 1';
                                            break;
                                        case 22: $fotonummering = 'Sphere picture 2';
                                            break;
                                        case 23: $fotonummering = 'Sphere picture 3';
                                            break;
                                        case 24: $fotonummering = 'Product package 3D';
                                            break;
                                        case 25: $fotonummering = 'Product package front';
                                            break;
                                        case 26: $fotonummering = 'Product package left';
                                            break;
                                        case 27: $fotonummering = 'Product package top';
                                            break;
                                        case 28: $fotonummering = 'Product package back';
                                            break;
                                        case 29: $fotonummering = 'Product package right';
                                            break;
                                        case 30: $fotonummering = 'Product package bottom';
                                            break;
                                        case 31: $fotonummering = 'Icon 1';
                                            break;
                                        case 32: $fotonummering = 'Icon 2';
                                            break;
                                        case 33: $fotonummering = 'Icon 3';
                                            break;
                                        case 34: $fotonummering = 'ERP Spectrum';
                                            break;
                                        case 35: $fotonummering = 'Square picture 1';
                                            break;
                                        case 36: $fotonummering = 'Square picture 1';
                                            break;
                                        case 37: $fotonummering = 'Square picture 2';
                                            break;
                                        case 38: $fotonummering = 'Square picture 3';
                                            break;
                                        case 39: $fotonummering = 'Square picture 4';
                                            break;
                                        case 40: $fotonummering = 'Square picture 5';
                                            break;
                                        case 41: $fotonummering = 'Square picture 6';
                                            break;
                                        case 42: $fotonummering = 'Square picture 7';
                                            break;
                                        case 43: $fotonummering = 'Square picture 8';
                                            break;
                                        case 44: $fotonummering = 'Square picture 9';
                                            break;
                                        case 45: $fotonummering = 'Square picture 10';
                                            break;
                                        case 46: $fotonummering = 'Icon 4';
                                            break;
                                        case 47: $fotonummering = 'Icon 5';
                                            break;
                                        case 48: $fotonummering = 'Icon 6';
                                            break;
                                        case 49: $fotonummering = 'Icon 7';
                                            break;
                                        case 50: $fotonummering = 'Icon 8';
                                            break;
                                        case 51: $fotonummering = 'Icon 9';
                                            break;
                                        case 52: $fotonummering = 'Icon 10';
                                            break;
                                    }
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' class='tooltip'>"
//                                    . str_replace("LR_" . $sapWithoutDots, null, str_replace(".jpg", null, str_replace(".JPG", null, $value))) . "</a><br/>";
                                    . $fotonummering . "<span><img class='callout' src='" . $linkG . $directory . $value . "'></span></a><br/>";
                                }
                                echo "</td>";
                                echo "<td>";
                                natsort($pic_arrayMR);
                                foreach ($pic_arrayMR as $value) {
                                    if (strlen(substr_replace(substr_replace($value, null, -4), null, 0, 11)) == 2) {
                                        $foto_num = substr_replace(substr_replace($value, null, -4), null, 0, 11);
                                    } else {
                                        $foto_num = '0' . substr_replace(substr_replace($value, null, -4), null, 0, 11);
                                    }
                                    switch ($foto_num) {
                                        case 02: $fotonummering = 'Side view right angle';
                                            break;
                                        case 03: $fotonummering = 'Front view';
                                            break;
                                        case 04: $fotonummering = 'Side view left angle';
                                            break;
                                        case 05: $fotonummering = 'Side view right';
                                            break;
                                        case 06: $fotonummering = 'Side view left';
                                            break;
                                        case 07: $fotonummering = 'Back view';
                                            break;
                                        case 08: $fotonummering = 'Top view';
                                            break;
                                        case 09: $fotonummering = 'Energy label';
                                            break;
                                        case 10: $fotonummering = 'Product set 1';
                                            break;
                                        case 11: $fotonummering = 'Product set 2';
                                            break;
                                        case 12: $fotonummering = 'Product set 3';
                                            break;
                                        case 13: $fotonummering = 'Product part 1';
                                            break;
                                        case 14: $fotonummering = 'Product part 2';
                                            break;
                                        case 15: $fotonummering = 'Product part 3';
                                            break;
                                        case 16: $fotonummering = 'Product part 4';
                                            break;
                                        case 17: $fotonummering = 'Product part 5';
                                            break;
                                        case 18: $fotonummering = 'Product detail 1';
                                            break;
                                        case 19: $fotonummering = 'Product detail 2';
                                            break;
                                        case 20: $fotonummering = 'Product detail 3';
                                            break;
                                        case 21: $fotonummering = 'Sphere picture 1';
                                            break;
                                        case 22: $fotonummering = 'Sphere picture 2';
                                            break;
                                        case 23: $fotonummering = 'Sphere picture 3';
                                            break;
                                        case 24: $fotonummering = 'Product package 3D';
                                            break;
                                        case 25: $fotonummering = 'Product package front';
                                            break;
                                        case 26: $fotonummering = 'Product package left';
                                            break;
                                        case 27: $fotonummering = 'Product package top';
                                            break;
                                        case 28: $fotonummering = 'Product package back';
                                            break;
                                        case 29: $fotonummering = 'Product package right';
                                            break;
                                        case 30: $fotonummering = 'Product package bottom';
                                            break;
                                        case 31: $fotonummering = 'Icon 1';
                                            break;
                                        case 32: $fotonummering = 'Icon 2';
                                            break;
                                        case 33: $fotonummering = 'Icon 3';
                                            break;
                                        case 34: $fotonummering = 'ERP Spectrum';
                                            break;
                                        case 35: $fotonummering = 'Square picture 1';
                                            break;
                                        case 36: $fotonummering = 'Square picture 1';
                                            break;
                                        case 37: $fotonummering = 'Square picture 2';
                                            break;
                                        case 38: $fotonummering = 'Square picture 3';
                                            break;
                                        case 39: $fotonummering = 'Square picture 4';
                                            break;
                                        case 40: $fotonummering = 'Square picture 5';
                                            break;
                                        case 41: $fotonummering = 'Square picture 6';
                                            break;
                                        case 42: $fotonummering = 'Square picture 7';
                                            break;
                                        case 43: $fotonummering = 'Square picture 8';
                                            break;
                                        case 44: $fotonummering = 'Square picture 9';
                                            break;
                                        case 45: $fotonummering = 'Square picture 10';
                                            break;
                                        case 46: $fotonummering = 'Icon 4';
                                            break;
                                        case 47: $fotonummering = 'Icon 5';
                                            break;
                                        case 48: $fotonummering = 'Icon 6';
                                            break;
                                        case 49: $fotonummering = 'Icon 7';
                                            break;
                                        case 50: $fotonummering = 'Icon 8';
                                            break;
                                        case 51: $fotonummering = 'Icon 9';
                                            break;
                                        case 52: $fotonummering = 'Icon 10';
                                            break;
                                    }
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' class='tooltip'>"
                                    . $fotonummering . "<span><img class='callout' src='" . $linkG . $directory . $value . "'></span></a><br/>";
                                }
                                echo "</td>";
                                echo "<td>";
                                natsort($pic_arrayHR);
                                foreach ($pic_arrayHR as $value) {
                                    if (strlen(substr_replace(substr_replace($value, null, -4), null, 0, 11)) == 2) {
                                        $foto_num = substr_replace(substr_replace($value, null, -4), null, 0, 11);
                                    } else {
                                        $foto_num = '0' . substr_replace(substr_replace($value, null, -4), null, 0, 11);
                                    }
                                    switch ($foto_num) {
                                        case 02: $fotonummering = 'Side view right angle';
                                            break;
                                        case 03: $fotonummering = 'Front view';
                                            break;
                                        case 04: $fotonummering = 'Side view left angle';
                                            break;
                                        case 05: $fotonummering = 'Side view right';
                                            break;
                                        case 06: $fotonummering = 'Side view left';
                                            break;
                                        case 07: $fotonummering = 'Back view';
                                            break;
                                        case 08: $fotonummering = 'Top view';
                                            break;
                                        case 09: $fotonummering = 'Energy label';
                                            break;
                                        case 10: $fotonummering = 'Product set 1';
                                            break;
                                        case 11: $fotonummering = 'Product set 2';
                                            break;
                                        case 12: $fotonummering = 'Product set 3';
                                            break;
                                        case 13: $fotonummering = 'Product part 1';
                                            break;
                                        case 14: $fotonummering = 'Product part 2';
                                            break;
                                        case 15: $fotonummering = 'Product part 3';
                                            break;
                                        case 16: $fotonummering = 'Product part 4';
                                            break;
                                        case 17: $fotonummering = 'Product part 5';
                                            break;
                                        case 18: $fotonummering = 'Product detail 1';
                                            break;
                                        case 19: $fotonummering = 'Product detail 2';
                                            break;
                                        case 20: $fotonummering = 'Product detail 3';
                                            break;
                                        case 21: $fotonummering = 'Sphere picture 1';
                                            break;
                                        case 22: $fotonummering = 'Sphere picture 2';
                                            break;
                                        case 23: $fotonummering = 'Sphere picture 3';
                                            break;
                                        case 24: $fotonummering = 'Product package 3D';
                                            break;
                                        case 25: $fotonummering = 'Product package front';
                                            break;
                                        case 26: $fotonummering = 'Product package left';
                                            break;
                                        case 27: $fotonummering = 'Product package top';
                                            break;
                                        case 28: $fotonummering = 'Product package back';
                                            break;
                                        case 29: $fotonummering = 'Product package right';
                                            break;
                                        case 30: $fotonummering = 'Product package bottom';
                                            break;
                                        case 31: $fotonummering = 'Icon 1';
                                            break;
                                        case 32: $fotonummering = 'Icon 2';
                                            break;
                                        case 33: $fotonummering = 'Icon 3';
                                            break;
                                        case 34: $fotonummering = 'ERP Spectrum';
                                            break;
                                        case 35: $fotonummering = 'Square picture 1';
                                            break;
                                        case 36: $fotonummering = 'Square picture 1';
                                            break;
                                        case 37: $fotonummering = 'Square picture 2';
                                            break;
                                        case 38: $fotonummering = 'Square picture 3';
                                            break;
                                        case 39: $fotonummering = 'Square picture 4';
                                            break;
                                        case 40: $fotonummering = 'Square picture 5';
                                            break;
                                        case 41: $fotonummering = 'Square picture 6';
                                            break;
                                        case 42: $fotonummering = 'Square picture 7';
                                            break;
                                        case 43: $fotonummering = 'Square picture 8';
                                            break;
                                        case 44: $fotonummering = 'Square picture 9';
                                            break;
                                        case 45: $fotonummering = 'Square picture 10';
                                            break;
                                        case 46: $fotonummering = 'Icon 4';
                                            break;
                                        case 47: $fotonummering = 'Icon 5';
                                            break;
                                        case 48: $fotonummering = 'Icon 6';
                                            break;
                                        case 49: $fotonummering = 'Icon 7';
                                            break;
                                        case 50: $fotonummering = 'Icon 8';
                                            break;
                                        case 51: $fotonummering = 'Icon 9';
                                            break;
                                        case 52: $fotonummering = 'Icon 10';
                                            break;
                                    }
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' class='tooltip'>"
                                    . $fotonummering . "<span><img class='callout' src='" . $linkG . $directory . $value . "'></span></a><br/>";
                                }
                                echo "</td>";
                                echo "</tr></table></td>";
                            }

                            if ($man_count > 0) {
                                echo "<td>";
                                foreach ($man_array as $value) {
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' >"
                                    . str_replace(".pdf", null, str_replace(".pptx", null, str_replace("_LR", null, str_replace("_" . $sapWithoutDots, null, $value)))) . "</a><br/>";
                                }
                                echo "</td>";
                            }

                            if ($pac_count > 0) {
                                echo "<td>";
                                foreach ($pac_array as $value) {
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' >"
                                    . str_replace(".pdf", null, str_replace(".doc", null, str_replace(".docx", null, str_replace("_LR", null, str_replace("_" . $sapWithoutDots, null, $value))))) . "</a><br/>";
                                }
                                echo "</td>";
                            }

                            if ($enlabel_count > 0) {
                                echo "<td style='font-size: 14px;'>";
                                foreach ($enlabel_array as $value) {
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' class='tooltip'>"
                                    . str_replace("_" . $sapWithoutDots, null, str_replace(".png", null, $value)) . "<span><img class='callout_en' src='" . $linkG . $directory . $value . "'></span></a><br/>";
                                }
                                echo "</td>";
                            }

                            if ($vid_count > 0) {
                                echo "<td>";
                                foreach ($vid_array as $value) {
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' >"
                                    . str_replace(".mp3", null, str_replace("LR_", null, str_replace("HR_", null, str_replace(".wav", null, str_replace(".mp4", null, str_replace(".mov", null, str_replace("_" . $sapWithoutDots, null, $value))))))) . "</a><br/>";
                                }
                                echo "</td>";
                            }
                            if ($doc_count > 0) {
                                echo "<td>";
//                                $item = $gresult["ITEM"];
//                                $lengthItem = strlen($item);
//                                $oldDocFiles = scandir($oldDocDirectory);
//                                foreach ($oldDocFiles as $oldDocValue) {
//                                    if (substr($oldDocValue, 0, $lengthItem) == $item && strlen($oldDocValue) == $lengthItem + 8) {
//                                        echo "<a href='".$linkG . $oldDocDirectory . $oldDocValue . "' target='_blank' >"
//                                        . $oldDocValue . "</a><br/><br/>";}}
                                foreach ($doc_array as $value) {
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' >"
                                    . str_replace("_LR", null, str_replace("_" . $sapWithoutDots, null, $value)) . "</a><br/>";
                                }
                                echo "</td>";
                            }
                            if ($td_count > 0) {
                                echo "<td>";
                                foreach ($td_array as $value) {
                                    echo "<a href='" . $linkG . $directory . $value . "' target='_blank' >"
                                    . str_replace(".pdf", null, str_replace(".zip", null, str_replace("_" . $sapWithoutDots, null, $value))) . "</a><br/>";
                                }
                                echo "</td>";
                            }
                            ?>
                        </tr>
                    </table>
                </div>
                <div id="tab2">

                    <form id="frmContact" method="POST" action="index.php" 		
                          onSubmit="return Validate();">
                        <input type="hidden" name="id" 
                               value="<?php echo (isset($gresult) ? $gresult["id"] : ''); ?>" />

                        <table class="certtable">
                            <tr>
                                <td>
                                    <label for="oem">OEM Certificate: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="oem" 
                                           value="" <?php echo ($gresult["OEM"] ? ' checked="checked"' : ''); ?>
                                           id="oem" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="oem_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["OEM_CE"] : ''); ?>" 
                                           id="oem_ce" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="oem_from">valid from: </label>
                                    <input type="date" name="oem_from"
                                           value="<?php echo (isset($gresult) ? $gresult["OEM_DATE_FROM"] : ''); ?>"
                                           id="oem_from" size="7" class="date-fld" readonly/>
                                </td>
                                <td>
                                    <label for="oem_to">valid till: </label>
                                </td>
                                <td>
                                    <input type="date" name="oem_to"
                                           value="<?php echo (isset($gresult) ? $gresult["OEM_DATE_TO"] : ''); ?>"
                                           id="oem_to" class="date-fld" readonly/>
                                </td>
                                <td></td>
                                <td>
                                    <label for="batt1">1. Battery Rep.: </label>
                                    <input type="checkbox" name="batt1" 
                                           value="" <?php echo ($gresult["BATT"] ? ' checked="checked"' : ''); ?>
                                           id="batt1" onClick="return readOnlyCheckBox()"/>
                                    <input type="text" name="batt1_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["BATT_M"] : ''); ?>"
                                           id="batt1_tr" class="cert-fld" readonly size="16"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="nf">NF Cert.nr / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="nf" 
                                           value="" <?php echo ($gresult["NF"] ? ' checked="checked"' : ''); ?>
                                           id="nf" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="nf_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["NF_CE"] : ''); ?>" 
                                           id="nf_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="nf_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["NF_TR"] : ''); ?>"
                                           id="nf_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="nf_date">valid till: </label>
                                </td>
                                <td>
                                    <input type="date" name="nf_date"
                                           value="<?php echo (isset($gresult) ? $gresult["NF_DATE"] : ''); ?>"
                                           id="nf_date" class="date-fld" readonly/>
                                </td>
                                <td></td>
                                <td>
                                    <label for="batt1">2. Battery Rep.: </label>
                                    <input type="checkbox" name="batt2" 
                                           value="" <?php echo ($gresult["BATT2"] ? ' checked="checked"' : ''); ?>
                                           id="batt2" onClick="return readOnlyCheckBox()"/>
                                    <input type="text" name="batt2_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["BATT_TR2"] : ''); ?>"
                                           id="batt2_tr" class="cert-fld" readonly size="16"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="gs">GS Cert.nr / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="gs" 
                                           value="" <?php echo ($gresult["GS"] ? ' checked="checked"' : ''); ?>
                                           id="gs" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="gs_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["GS_CE"] : ''); ?>" 
                                           id="gs_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="gs_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["GS_TR"] : ''); ?>"
                                           id="gs_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="gs_date">valid till: </label>
                                </td>
                                <td>
                                    <input type="date" name="gs_date"
                                           value="<?php echo (isset($gresult) ? $gresult["GS_DATE"] : ''); ?>"
                                           id="gs_date" class="date-fld" readonly/>
                                </td>
                                <td>
                                    <label for="gs_nb"> NB: </label>
                                    <input type="text" name="gs_nb"
                                           value="<?php echo (isset($gresult) ? $gresult["GS_NB"] : ''); ?>"
                                           id="gs_nb" class="nb-fld" readonly/>
                                </td>                                
                                <td>
                                    <label for="cdf">CDF: </label>
                                    <input type="checkbox" name="cdf" 
                                           value="" <?php echo ($gresult["GS_CDF"] ? ' checked="checked"' : ''); ?>
                                           id="cdf" onClick="return readOnlyCheckBox()"/>
                                    <span>
                                        <label for="pah">PAH: </label>
                                        <input type="checkbox" name="pah" 
                                               value="" <?php echo ($gresult["PAH"] ? ' checked="checked"' : ''); ?>
                                               id="pah" onClick="return readOnlyCheckBox()"/>
                                        <input type="text" name="pah_ce"
                                               value="<?php echo (isset($gresult) ? $gresult["PAH_CE"] : ''); ?>"
                                               id="pah_ce" class="cert-fld" readonly size="8"/></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="lvd">LVD Directive / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="lvd" 
                                           value="" <?php echo ($gresult["LVD"] ? ' checked="checked"' : ''); ?>
                                           id="lvd" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="lvd_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["LVD_CE"] : ''); ?>" 
                                           id="lvd_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="lvd_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["LVD_TR"] : ''); ?>"
                                           id="lvd_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="lvd_date">valid from: </label>
                                </td>
                                <td>
                                    <input type="date" name="lvd_date"
                                           value="<?php echo (isset($gresult) ? $gresult["LVD_DATE"] : ''); ?>"
                                           id="lvd_date" class="date-fld" readonly/>
                                </td>
                                <td>
                                    <label for="lvd_nb"> NB: </label>
                                    <input type="text" name="lvd_nb"
                                           value="<?php echo (isset($gresult) ? $gresult["LVD_NB"] : ''); ?>"
                                           id="lvd_nb" class="nb-fld" readonly/>
                                </td>
                                <td style="text-align: right;">
                                    <label for="reach">REACH:</label>
                                    <input type="checkbox" name="reach" 
                                           value="" <?php echo ($gresult["REACH"] ? ' checked="checked"' : ''); ?>
                                           id="reach" onClick="return readOnlyCheckBox()"/>
                                    <input type="text" name="reach_ce"
                                           value="<?php echo (isset($gresult) ? $gresult["REACH_CE"] : ''); ?>"
                                           id="reach_ce" class="cert-fld" readonly size="8"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="emc">EMC Directive / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="emc" 
                                           value="" <?php echo ($gresult["EMC"] ? ' checked="checked"' : ''); ?>
                                           id="emc" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="emc_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["EMC_CE"] : ''); ?>" 
                                           id="emc_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="emc_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["EMC_TR"] : ''); ?>"
                                           id="emc_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="emc_date">valid from: </label>
                                </td>
                                <td>
                                    <input type="date" name="emc_date"
                                           value="<?php echo (isset($gresult) ? $gresult["EMC_DATE"] : ''); ?>"
                                           id="emc_date" class="date-fld" readonly/>
                                </td>
                                <td>
                                    <label for="emc_nb"> NB: </label>
                                    <input type="text" name="emc_nb"
                                           value="<?php echo (isset($gresult) ? $gresult["EMC_NB"] : ''); ?>"
                                           id="emc_nb" class="nb-fld" readonly/>
                                </td>                                
                            </tr>
                            <tr>
                                <td>
                                    <label for="rf">R&TTE Directive / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="rf" 
                                           value="" <?php echo ($gresult["RF"] ? ' checked="checked"' : ''); ?>
                                           id="rf" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="rf_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["RF_CE"] : ''); ?>" 
                                           id="rf_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="rf_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["RF_TR"] : ''); ?>"
                                           id="rf_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="rf_date">valid from: </label>
                                </td>
                                <td>
                                    <input type="date" name="rf_date"
                                           value="<?php echo (isset($gresult) ? $gresult["RF_DATE"] : ''); ?>"
                                           id="rf_date" class="date-fld" readonly/>
                                </td>
                                <td>
                                    <label for="rf_nb"> NB: </label>
                                    <input type="text" name="rf_nb"
                                           value="<?php echo (isset($gresult) ? $gresult["RF_NB"] : ''); ?>"
                                           id="rf_nb" class="nb-fld" readonly/>
                                </td>
                                <td>
                                    <label for="rf_nbn"> NB nr: </label>
                                    <input type="text" name="rf_nbn"
                                           value="<?php echo (isset($gresult) ? $gresult["RF_NBN"] : ''); ?>"
                                           id="rf_nbn" class="cert-fld" readonly size="2"/>

                                    <label for="rf_f"> Frequency: </label>
                                    <input type="text" name="rf_f"
                                           value="<?php echo (isset($gresult) ? $gresult["RF_F"] : ''); ?>"
                                           id="rf_f" class="cert-fld" readonly size="6"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="erp">ErP Regulation / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="erp" 
                                           value="" <?php echo ($gresult["EUP"] ? ' checked="checked"' : ''); ?>
                                           id="erp" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="erp_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["EUP_CE"] : ''); ?>" 
                                           id="erp_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="erp_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["EUP_TR"] : ''); ?>"
                                           id="erp_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="erp_date">valid from: </label>
                                </td>
                                <td>
                                    <input type="date" name="erp_date"
                                           value="<?php echo (isset($gresult) ? $gresult["EUP_DATE"] : ''); ?>"
                                           id="erp_date" class="date-fld" readonly/>
                                </td>
                                <td>
                                    <input type="text" name="erp_status"
                                           value="<?php echo (isset($gresult) ? $gresult["EUP_STATUS"] : ''); ?>"
                                           id="erp_status" size="16" readonly/>                                    
                                </td>
                                <td>
                                    <label for="flux"> Flux report: </label>
                                    <input type="checkbox" name="flux"
                                           value="" <?php echo ($gresult["FLUX"] ? ' checked="checked"' : ''); ?>
                                           id="flux" onClick="return readOnlyCheckBox()"/>
                                    <input type="text" name="flux_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["FLUX_TR"] : ''); ?>"
                                           id="flux_tr" readonly/>                                    
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="rohs">RoHS Directive / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="rohs" 
                                           value="" <?php echo ($gresult["ROHS"] ? ' checked="checked"' : ''); ?>
                                           id="rohs" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="rohs_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["ROHS_CE"] : ''); ?>" 
                                           id="rohs_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="rohs_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["ROHS_TR"] : ''); ?>"
                                           id="rohs_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="rohs_date">valid from: </label>
                                </td>
                                <td>
                                    <input type="date" name="rohs_date"
                                           value="<?php echo (isset($gresult) ? $gresult["ROHS_DATE"] : ''); ?>"
                                           id="rohs_date" class="date-fld" readonly/>
                                </td>
                                <td>
                                    <label for="rohs_nb"> NB: </label>
                                    <input type="text" name="rohs_nb"
                                           value="<?php echo (isset($gresult) ? $gresult["ROHS_NB"] : ''); ?>"
                                           id="rohs_nb" class="nb-fld" readonly/>
                                </td>
                                <td style="text-align: right;">
                                    <label for="doc">Supplier DoC: </label>
                                    <input type="checkbox" name="doc" 
                                           value="" <?php echo ($gresult["DOC"] ? ' checked="checked"' : ''); ?>
                                           id="doc" onClick="return readOnlyCheckBox()"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="cpr">CPR Cert.nr. / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="cpr" 
                                           value="" <?php echo ($gresult["CPD"] ? ' checked="checked"' : ''); ?>
                                           id="cpr" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="cpr_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["CPD_CE"] : ''); ?>" 
                                           id="cpr_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="cpr_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["CPD_TR"] : ''); ?>"
                                           id="cpr_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="cpr_date">valid from: </label>
                                </td>
                                <td>
                                    <input type="date" name="cpr_date"
                                           value="<?php echo (isset($gresult) ? $gresult["CPD_DATE"] : ''); ?>"
                                           id="cpr_date" class="date-fld" readonly/>
                                </td>
                                <td>
                                    <label for="cpr_nb"> NB: </label>
                                    <input type="text" name="cpr_nb"
                                           value="<?php echo (isset($gresult) ? $gresult["CPD_NB"] : ''); ?>"
                                           id="cpr_nb" class="nb-fld" readonly/>
                                </td>
                                <td style="text-align: right;">
                                    <label for="doi">Supplier DoI: </label>
                                    <input type="checkbox" name="doi" 
                                           value="" <?php echo ($gresult["DOI"] ? ' checked="checked"' : ''); ?>
                                           id="doi" onClick="return readOnlyCheckBox()"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="vds">VdS Cert.nr. / Rep.nr: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="vds" 
                                           value="" <?php echo ($gresult["VDS"] ? ' checked="checked"' : ''); ?>
                                           id="vds" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="vds_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["VDS_CE"] : ''); ?>" 
                                           id="vds_ce" class="cert-fld" readonly/>
                                </td>
                                <td>/
                                    <input type="text" name="vds_tr"
                                           value="<?php echo (isset($gresult) ? $gresult["VDS_TR"] : ''); ?>"
                                           id="vds_tr" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="vds_date">valid till: </label>
                                </td>
                                <td>
                                    <input type="date" name="vds_date"
                                           value="<?php echo (isset($gresult) ? $gresult["VDS_DATE"] : ''); ?>"
                                           id="vds_date" class="date-fld" readonly/>
                                </td>
                                <td></td>
                                <td style="text-align: right;">
                                    <label for="phth">Phthalaten Rep.: </label>
                                    <input type="checkbox" name="phth" 
                                           value="" <?php echo ($gresult["PHTH"] ? ' checked="checked"' : ''); ?>
                                           id="phth" onClick="return readOnlyCheckBox()"/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="bosec">BOSEC Certificate: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="bosec" 
                                           value="" <?php echo ($gresult["BOSEC"] ? ' checked="checked"' : ''); ?>
                                           id="bosec" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="bosec_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["BOSEC_CE"] : ''); ?>" 
                                           id="bosec_ce" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="bosec_date">valid till: </label>
                                    <input type="date" name="bosec_date"
                                           value="<?php echo (isset($gresult) ? $gresult["BOSEC_DATE"] : ''); ?>"
                                           id="bosec_date" class="date-fld" readonly/>
                                </td>
                                <td colspan="6" rowspan="3">
                                    <textarea rows="5" cols="75" class="remark-field" readonly><?php echo (isset($gresult) ? $gresult["REMARKS"] : ''); ?></textarea>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="ffu">FFU Certificate: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="ffu" 
                                           value="" <?php echo ($gresult["KOMO"] ? ' checked="checked"' : ''); ?>
                                           id="ffu" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="ffu_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["KOMO_CE"] : ''); ?>" 
                                           id="ffu_ce" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="ffu_date">valid till: </label>
                                    <input type="date" name="ffu_date"
                                           value="<?php echo (isset($gresult) ? $gresult["KOMO_DATE"] : ''); ?>"
                                           id="ffu_date" class="date-fld" readonly/>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <label for="other">Other Cert.nr. / Rep.nr.: </label>
                                </td>
                                <td>
                                    <input type="checkbox" name="other" 
                                           value="" <?php echo ($gresult["KK"] ? ' checked="checked"' : ''); ?>
                                           id="other" onClick="return readOnlyCheckBox()"/>
                                </td>
                                <td>
                                    <input type="text" name="other_ce" 
                                           value="<?php echo (isset($gresult) ? $gresult["KK_CE"] : ''); ?>" 
                                           id="other_ce" class="cert-fld" readonly/>
                                </td>
                                <td>
                                    <label for="other_date">valid till: </label>
                                    <input type="date" name="other_date"
                                           value="<?php echo (isset($gresult) ? $gresult["KK_DATE"] : ''); ?>"
                                           id="other_date" class="date-fld" readonly/>
                                </td>
                            </tr>                            
                        </table>
                        <input type="hidden" name="action_type" value="<?php echo (isset($gresult) ? 'edit' : 'add'); ?>"/>

                    </form>
                </div>
                <div id="tab3">
                    <table class="normtable">
                        <?php
                        if (isset($gresult["EMC1"])) {
                            echo '<th style="color:rgb(0,0,255)";>EMC Standards:</th>';
                        }
                        if (isset($gresult["LVD1"])) {
                            echo '<th style="color:rgb(0,102,51)";>LVD Standards:</th>';
                        }
                        if (isset($gresult["RF1"])) {
                            echo '<th style="color:rgb(153,51,255)";>R&TTE Standards:</th>';
                        }
                        if (isset($gresult["CPD1"])) {
                            echo '<th style="color:rgb(0,102,102)";>Other Standards:</th>';
                        }
                        ?>
                        <tr>
                            <?php
                            if (isset($gresult["EMC1"])) {
                                echo '<td style="color:rgb(0,0,255)";>';
                                echo (isset($gresult) ? $gresult["EMC1"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC2"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC3"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC4"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC5"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC6"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC7"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC8"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC9"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["EMC10"] : '');
                                echo '</td>';
                            }

                            if (isset($gresult["LVD1"])) {
                                echo '<td style="color:rgb(0,102,51)";>';
                                echo (isset($gresult) ? $gresult["LVD1"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["LVD2"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["LVD3"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["LVD4"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["LVD5"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["LVD6"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["LVD7"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["LVD8"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["LVD9"] : '');
                                echo '</td>';
                            }

                            if (isset($gresult["RF1"])) {
                                echo '<td style="color:rgb(153,51,255)";>';
                                echo (isset($gresult) ? $gresult["RF1"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["RF2"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["RF3"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["RF4"] : '');
                                echo '</td>';
                            }

                            if (isset($gresult["CPD1"])) {
                                echo '<td style="color:rgb(0,102,102)";>';
                                echo (isset($gresult) ? $gresult["CPD1"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["CPD2"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["CPD3"] : '') . "<br/>";
                                echo (isset($gresult) ? $gresult["CPD4"] : '');
                                echo '</td>';
                            }
                            ?>
                        </tr>

                    </table>

                </div>
                <div id="tab4"><i>(under construction)</i></div>
                <div id="tab5">
                    <table style="width: 99%;">
                        <tr>
                            <td>
                                <table class="erp_top">
                                    <tr>
                                        <td>
                                            <?php echo (isset($gresult["KIND_BULB"]) ? '<label>Kind of lamp: </label>' . $gresult["KIND_BULB"] : ''); ?>
                                        </td>
                                        <td>
                                            <?php echo (isset($gresult["ITEM_BULB"]) ? '<label>Included bulb: </label>' . $gresult["ITEM_BULB"] : ''); ?>
                                        </td>
                                        <td>
                                            <?php echo ($gresult["INT_LED"] == 1 ? 'Integrated LED' : ''); ?>
                                        </td>
                                        <td>
                                            <?php echo (isset($gresult["SPECIAL_USE"]) ? '<label>Speclal use: </label>' . $gresult["SPECIAL_USE"] : ''); ?>
                                        </td>
                                    </tr>
                                </table>
                                <label style="color: green; font-style: italic; font-size: smaller; margin-left: 10px;">Packaging</label>
                                <table class="erp_packing">
                                    <tr>
                                        <td>
                                            <label>Nominal voltage (V): </label><?php echo (isset($gresult["VOLTAGE"]) ? $gresult["VOLTAGE"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Switching cycles: </label><?php echo (isset($gresult["SWICYC"]) ? $gresult["SWICYC"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Nominal beam angle(°): </label><?php echo (isset($gresult["BEAM"]) ? $gresult["BEAM"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Suitable for accent lighting: </label><?php echo (($gresult["ACCENT"] == 1) ? 'Yes' : 'No'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nominal current (mA): </label><?php echo (isset($gresult["AMPERE"]) ? $gresult["AMPERE"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Colour temperature (K): </label><?php echo (isset($gresult["KELVIN"]) ? $gresult["KELVIN"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Color rendering Ra:  > </label><?php echo (isset($gresult["RA"]) ? $gresult["RA"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Dimensions (mm):   Φ(w):  </label><?php echo (isset($gresult["DIMENSION_FI"]) ? $gresult["DIMENSION_FI"] : 'N/A'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nominal lamp power (W): </label><?php echo (isset($gresult["WATTAGE"]) ? $gresult["WATTAGE"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Energy efficiency class: </label><?php echo (isset($gresult["ENCLAS"]) ? $gresult["ENCLAS"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Equivalent (W): </label><?php echo (isset($gresult["COMPAR"]) ? $gresult["COMPAR"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Dimensions (mm):   l(h):  </label><?php echo (isset($gresult["DIMENSION_L"]) ? $gresult["DIMENSION_L"] : 'N/A'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nominal luminous flux (lm): </label><?php echo (isset($gresult["LUMEN"]) ? $gresult["LUMEN"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Warm-up time to 60% (<2s): </label><?php echo (isset($gresult["STAR60"]) ? $gresult["STAR60"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Base / fitting: </label><?php echo (isset($gresult["FITTIN"]) ? $gresult["FITTIN"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Dimensions (mm):   d:  </label><?php echo (isset($gresult["DIMENSION_D"]) ? $gresult["DIMENSION_D"] : 'N/A'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Nominal life time (h): </label><?php echo (isset($gresult["LIFETIME"]) ? $gresult["LIFETIME"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Dimmable: </label><?php echo (isset($gresult["DIMMER"]) ? $gresult["DIMMER"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Mercury content (mg): < </label><?php echo (isset($gresult["KWIK"]) ? $gresult["KWIK"] : 'N/A'); ?>
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                                <label style="color: blue; font-style: italic; font-size: smaller; margin-left: 10px;">Website</label>
                                <table class="erp_web">
                                    <tr>
                                        <td>
                                            <label>Measured wattage (0.1 W): </label><?php echo (isset($gresult["WATTAGE_RATED"]) ? $gresult["WATTAGE_RATED"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Colour name: </label><?php echo (isset($gresult["COLOUR"]) ? $gresult["COLOUR"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Power factor (X.X): </label><?php echo (isset($gresult["POWER_FACTOR"]) ? $gresult["POWER_FACTOR"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Lamp survival factor (>0.90): ></label><?php echo (isset($gresult["LICHTB"]) ? $gresult["LICHTB"] : 'N/A'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Measured luminous flux (lm): </label><?php echo (isset($gresult["LUMEN_RATED"]) ? $gresult["LUMEN_RATED"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Rated beam angle(°): </label><?php echo (isset($gresult["BEAM_R"]) ? $gresult["BEAM_R"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Lumen maintenace factor (>0.80): ></label><?php echo (isset($gresult["LUMEN_FACTOR"]) ? $gresult["LUMEN_FACTOR"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Color consistency (LED only): <</label><?php echo (isset($gresult["COLOR_CONS"]) ? $gresult["COLOR_CONS"] : 'N/A'); ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Measured life time (h): </label><?php echo (isset($gresult["LIFETIME_RATED"]) ? $gresult["LIFETIME_RATED"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Indoor / outdoor use: </label><?php echo (isset($gresult["INDOOR"]) ? $gresult["INDOOR"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Starting time (<0.5s): <</label><?php echo (isset($gresult["START_TIME"]) ? $gresult["START_TIME"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Rated peak in candela (cd): </label><?php echo (isset($gresult["CANDELA"]) ? $gresult["CANDELA"] : 'N/A'); ?>
                                        </td>
                                    </tr>
                                </table>
                                <label style="color: coral; font-style: italic; font-size: smaller; margin-left: 10px;">Extra</label>
                                <table class="erp_extra">
                                    <tr>
                                        <td>
                                            <label>Shape: </label><?php echo (isset($gresult["SHAPE"]) ? $gresult["SHAPE"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Number of LEDs: </label><?php echo (isset($gresult["LED_NUMBER"]) ? $gresult["LED_NUMBER"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>Type of LED: </label><?php echo (isset($gresult["LED_Type"]) ? $gresult["LED_Type"] : 'N/A'); ?>
                                        </td>
                                        <td>
                                            <label>UV block: </label><?php echo (($gresult["UV"] == 1) ? 'Yes' : 'N/A'); ?>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                            <td>
                                <?php
                                $erp_spectrum = "G/S&L_Data/QC/Spectrum/LR_" . $sapWithoutDots . "_34.jpg";
                                if (file_exists($erp_spectrum)) {
                                    $data = getimagesize($erp_spectrum);
                                    $imgWidth = $data[0];
                                    $imgHeight = $data[1];
                                    $winWidth = 200;
                                    $winHeight = 150;
                                    if ($imgHeight / $imgWidth > $winHeight / $winWidth) {
                                        $newHeight = $winHeight;
                                        $newWidth = ($imgWidth / $imgHeight) * $newHeight;
                                    } else {
                                        $newWidth = $winWidth;
                                        $newHeight = ($imgHeight / $imgWidth) * $newWidth;
                                    }
                                    ?>
                                    <img src="<?php echo $erp_spectrum ?>" style="width:<?php echo $newWidth ?>px ;height:<?php echo $newHeight ?>px ; margin-left: 20px;"/>
                                <?php } ?>
                            </td>
                        </tr>
                    </table>
                </div>

<!--                <div id="tab6"><i>(under construction)</i></div>-->

            </div>
            <div style="text-align: center; padding: 10px; background: gray;">
<!--                <input class="btn" type="submit" name="save" id="save" value="Save" disabled/>-->
                <form action="http://172.17.18.92/items/index.php">
                <input class="btn" type="submit" value="Back to list"/>
                </form>
<!--                <input class="btn" type="button" name="DoC" id="DoC" value="Show DoC"
                       onclick="ShowDoC('<?php echo $item; ?>');"/>-->
<!--                <iframe id="myFrame" style="display:none" width="500" height="300"></iframe>-->

            </div>
        </div>
    </body>
</html>