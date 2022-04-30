<?php

const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'thehotel';

// Attempt to connect to MySQL database.
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
?>
<HTML>
<HEAD>
    <TITLE>Rooms</TITLE>
    <link href="style_room.css" type="text/css" rel="stylesheet"/>
</HEAD>

<BODY>
<div id="product-grid">
    <div class="txt-heading">Наши номера</div>
    <table style="margin-left: auto; margin-right: auto">
    <?php
    $row_counter = 0;
    $do_end_row = false;
    $product_array = $db_handle->runQuery("SELECT * FROM roomtype as rt inner join room r on r.RoomTypeId = rt.RoomTypeId ");
    if (!empty($product_array)) {
        foreach ($product_array as $key => $value) {
            ++$row_counter;
            if($row_counter === 3) {
                $do_end_row=true;
                ?> <td> <?php
            }
            else if ($row_counter === 1) {
                ?> <tr> <td> <?php
            } else {
                ?> <td> <?php
            }
            ?>
            <div class="product-item">
                <form method="post" id="message"
                      action="index.php?content=rooms.php&action=add&code=<?php echo $product_array[$key]["RoomId"]; ?>">
                    <div class="product-image" style="margin-right: auto; margin-left: auto;">
                        <img style="height: 100%; width: 100%;"src="<?php echo $product_array[$key]["Photo"]; ?>">
                    </div>
                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo '<a>' . $product_array[$key]["RoomType"] .', '. $product_array[$key]["Occupancy"].' - местный'.'<a>'; ?></div>
                        <div class="product-title"><a
                                    href="index.php?content=rooms.php&click=<?php echo $product_array[$key]["RoomId"]; ?>">Подробнее</a>
                            <p style="<?php
                            if ($_GET['click'] === $product_array[$key]["RoomId"]) {

                            } else {
                                echo 'display: none; ';
                            }
                            ?> width: 400px"><?php echo $product_array[$key]["Facilities"]; ?></p></div>
                        <div class="product-title"><?php echo 'Общая площадь номера ' . $product_array[$key]["Area"] . 'м^2'; ?></div>
                        <div class="product-price"><?php echo "Цена за сутки " . $product_array[$key]["PricePerNight"] . ' ₽'; ?></div>
                    </div>
                </form>
            <?php
            if($do_end_row===true) {
                $row_counter = 0;
                $do_end_row = false;
            ?> <td> <tr><?php
            } else {
            ?> <td> <?php
            }
        }
    }
    ?>
    </table>
</div>
</BODY>
</HTML>