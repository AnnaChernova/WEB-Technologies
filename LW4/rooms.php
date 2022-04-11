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
    <TITLE>Simple PHP Shopping Cart</TITLE>
    <link href="style_room.css" type="text/css" rel="stylesheet" />

</HEAD>
<BODY>

<div id="product-grid">
    <div class="txt-heading">Наши номера</div>

    <?php

    $product_array = $db_handle->runQuery("SELECT * FROM roomtype as rt inner join room r on r.RoomTypeId = rt.RoomTypeId ");
    if (!empty($product_array)) {
        foreach($product_array as $key=>$value){
            ?>
            <div class="product-item">
                <form method="post" id="message" action="index.php?content=room.php&action=add&code=<?php echo $product_array[$key]["RoomId"]; ?>">
                    <div class="product-image"><img style='height: 100%; width: 100%; object-fit: contain' src="<?php echo $product_array[$key]["Photo"]; ?>"></div>
                    <div class="product-tile-footer">
                        <div class="product-title"><?php echo '<a>'.$product_array[$key]["RoomType"].'<a>'; ?></div>
                        <div class="product-title"> <a href="index.php?content=room.php&click=<?php echo $product_array[$key]["RoomId"]; ?>">Подробнее</a><p style="<?php
                            if($_GET['click']===$product_array[$key]["RoomId"]){

                            } else {
                                echo 'display: none';
                            }
                            ?>"><?php echo $product_array[$key]["Facilities"]; ?></p></div>
                        <div class="product-title"><?php echo 'Комната на '.$product_array[$key]["Occupancy"].' человек, общая площадь номера '.$product_array[$key]["Area"].'м^2'; ?></div>
                        <div class="product-price"><?php echo "Цена за одну ночь $".$product_array[$key]["PricePerNight"]; ?></div>
                    </div>
                </form>
            </div>
            <?php
        }
    }
    ?>
</div>
</BODY>
</HTML>