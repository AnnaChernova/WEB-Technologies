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
    <link href="services.css" type="text/css" rel="stylesheet"/>
</HEAD>

<BODY>
<div id="product-grid">
    <div class="txt-heading">Услуги отеля</div>
    <div class="txt-h-below">
        Дополните свой отдых приятными сюрпризами. Мы украсим номер отеля для вас, проведем фотосессию в отеле или
        spa-бассейне, организуем доставку свежих цветов.
        <br><br>
        <b>Если у вас остались вопросы, свяжитесь с нами по телефону +7 (800) 050-04-34</b>
    </div>
    <table style="margin-left: auto; margin-right: auto">
        <?php
        $row_counter = 0;
        $do_end_row = false;
        $product_array = $db_handle->runQuery("SELECT * FROM service");
        if (!empty($product_array)) {
        foreach ($product_array

        as $key => $value) {
        ++$row_counter;
        if ($row_counter === 4) {
        $do_end_row = true;
        ?>
        <td> <?php
            }
            else if ($row_counter === 1) {
            ?>
            <tr>
                <td> <?php
                    } else {
                    ?>
                <td> <?php
                    }
                    ?>
                    <div class="dop-card">
                        <form method="post" id="message"
                              action="index.php?content=room.php&action=add&code=<?php echo $product_array[$key]["ServiceId"]; ?>">
                            <div class="dop-card-image">
                                <img src="<?php echo $product_array[$key]["Photo"]; ?>">
                            </div>
                            <div class="dop-card_content">
                                <h3 class="dop-card_title"><?php echo $product_array[$key]["Service"]; ?></h3>
                                <div class="dop-card_text">
                                    <table>
                                        <tbody>
                                        <tr>
                                            <td>
                                                <span class="dop-card_subtitle">СТОИМОСТЬ</span>
                                            </td>
                                            <td>
                                                <b>
                                                    <?php if ($product_array[$key]["Price"] === 0) { ?>
                                                        <!-- TODO: make it works-->
                                                        <div class="product-price"><?php echo "Бесплатно"; ?></div>
                                                    <?php } else { ?>
                                                        <div class="product-price"><?php echo "от " . $product_array[$key]["Price"] . ' ₽'; ?></div>
                                                    <?php } ?>
                                                </b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <?php echo $product_array[$key]["Description"]; ?>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                        <?php
                        if ($do_end_row === true) {
                        $row_counter = 0;
                        $do_end_row = false;
                        ?>
                <td>
            <tr><?php
                } else {
                ?>
                <td> <?php
                    }
                    }
                    }
                    ?>
    </table>
</div>
</BODY>
</HTML>