<?php
if (!isset($_SESSION['id']) && !isset($_SESSION['user_name'])) {
    echo '<h1> К сожалению вы не залогинены, пожалуйста, залогинтесь!</h1>';
    return;
}
const DB_SERVER = 'localhost';
const DB_USERNAME = 'root';
const DB_PASSWORD = '';
const DB_NAME = 'thehotel';

// Attempt to connect to MySQL database.
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

session_start();
require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
    switch($_GET["action"]) {
        case "add":

            if(!empty($_POST["quantity"])) {
                $productByCode = $db_handle->runQuery('SELECT * FROM roomtype as rt inner join room r on r.RoomTypeId = rt.RoomTypeId WHERE RoomId='.$_GET["code"]);
                if(!isset($_POST['dateTo'])){
                    $quan = 1;
                } else {
                    $from = strtotime($_POST['dateFrom']);
                    $to = strtotime($_POST['dateTo']);
                    if($from>=$to){
                        echo "Вы указали дату в прошлое!";
                        $quan = 0;
                    } else {
                        $secs = $to - $from;
                        $days = $secs / 86400;
                        $quan = $days;
                    }

                }
                $itemArray = array($productByCode[0]["RoomId"]=>array('name'=>$productByCode[0]["RoomType"], 'code'=>$productByCode[0]["RoomId"], 'quantity'=>$quan, 'price'=>$productByCode[0]["PricePerNight"], 'image'=>$productByCode[0]["Photo"]));


                if(!empty($_SESSION["cart_item"])) {
                    if(in_array($productByCode[0]["RoomId"],array_keys($_SESSION["cart_item"]))) {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            if($productByCode[0]["RoomId"] == $k) {
                                if(empty($_SESSION["cart_item"][$k]["quantity"])) {
                                    $_SESSION["cart_item"][$k]["quantity"] = 0;
                                }
                                $_SESSION["cart_item"][$k]["quantity"] = $quan;
                            } else {
                                $_SESSION["cart_item"][$k]["quantity"] = $quan;
                            }
                        }
                    } else {
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            $_SESSION["cart_item"][$k]["quantity"] = $quan;
                        }
                        $_SESSION["cart_item"] = array_replace_recursive($_SESSION["cart_item"],$itemArray);
                    }
                } else {
                    $_SESSION["cart_item"] = $itemArray;
                }

                if($quan===0){
                    unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "remove":
            if(!empty($_SESSION["cart_item"])) {
                foreach($_SESSION["cart_item"] as $k => $v) {
                    if($_GET["code"] == $k)
                        unset($_SESSION["cart_item"][$k]);
                    if(empty($_SESSION["cart_item"]))
                        unset($_SESSION["cart_item"]);
                }
            }
            break;
        case "empty":
            unset($_SESSION["cart_item"]);
            break;
        case "save":
            {
                $sql = "INSERT INTO booking (DateArrival, DateDeparture, DateOfBooking, UserId, BookingStatusId, UserComment, AdminComment) 
                VALUES (?, ?, ?, ?, ?, ' ', ' ')";
                echo 'skdjasl;kdjk';
                if ($stmt = mysqli_prepare($link, $sql)) {
                    // Bind variables to the prepared statement as parameters
                    echo 'skdjasl;kdjk';
                    mysqli_stmt_bind_param($stmt, "sssii", $param_name, $param_secondName, $param_email,
                        $param_userType, $param_phone);
                    $from = $_GET['dateFrom'];
                    $to = $_GET['dateTo'];
                    // Set parameters
                    echo $from;
                    echo  $to;
                    $param_name = $_GET['dateFrom'];
                    $param_secondName = $_GET['dateTo'];
                    $param_email =  date("Y-m-d");
                    $param_userType = $_SESSION['id'];
                    $param_phone = 1;
                    echo  '<br>';
                    echo $param_name;
                    echo  '<br>';

                    echo $param_secondName;
                    echo  '<br>';

                    echo $param_email;
                    echo  '<br>';

                    echo $param_userType;
                    echo  '<br>';


                    echo $param_phone;
                    if (mysqli_stmt_execute($stmt)) {
                        echo  'aa';
                        $last_id = $link->insert_id;
                        foreach($_SESSION["cart_item"] as $k => $v) {
                            echo  'aa';
                            $sql2 = "INSERT INTO journalofrooms (RoomId, BookingId, Date) 
                        VALUES (?, ?, ?)";
                            if ($stmt2 = mysqli_prepare($link, $sql2)) {
                                mysqli_stmt_bind_param($stmt2, "iis", $param_name, $param_secondName, $param_email);
                                $param_name = $k;
                                echo  $k;
                                $param_secondName = $last_id;
                                $param_email = date("Y-m-d");
                                mysqli_stmt_execute($stmt2);
                            }
                        }
                        // Records created successfully. Redirect to landing page
                        header("location: index.php");
                        exit();
                    } else {
                        echo $link->error;
                        echo "Oops! Something went wrong. Please try again later.";
                    }
                }

                // Close statement
            }
            break;
    }
}
?>
<HTML>
<HEAD>
    <TITLE>Simple PHP Shopping Cart</TITLE>
    <link href="style_room.css" type="text/css" rel="stylesheet" />

</HEAD>
<BODY>
<div id="shopping-cart">
    <div class="txt-heading">
        Заезд
        <input type="date" name="dateFrom" form="message" value="<?php
        if($_POST['dateFrom']){
            echo date("Y-m-d", strtotime($_POST['dateFrom']));
        }else {
            echo date("Y-m-d");
        }
        ?>">
        Выезд
        <input type="date" name="dateTo" form="message" value="<?php if(isset($_POST['dateTo'])){
            echo date("Y-m-d", strtotime($_POST['dateTo']));
        }else {
            echo date("Y-m-d", strtotime(date("Y-m-d") . ' +1 day'));
        }?>">
    </div>
    <br>
    <div class="txt-heading">Ваше бронирование</div>

    <a id="btnEmpty" href="index.php?content=room.php&action=empty">Очистить бронирование</a>
    <a id="btnProve" href="<?php
    echo "index.php?content=room.php&action=save&dateTo=".$_POST['dateTo']."&dateFrom=".$_POST['dateFrom']
    ?>">Подтвердить бронирование</a>
    <?php
    if(isset($_SESSION["cart_item"])){
        $total_quantity = 0;
        $total_price = 0;
        ?>
        <table class="tbl-cart" cellpadding="10" cellspacing="1">
            <tbody>
            <tr>
                <th style="text-align:left;">Тип номера</th>
                <th style="text-align:left;">Номер комнаты</th>
                <th style="text-align:right;" width="5%">Число ночей</th>
                <th style="text-align:right;" width="10%">Стоимость одной ночи</th>
                <th style="text-align:right;" width="10%">Общая стоимость</th>
                <th style="text-align:center;" width="5%">Удалить</th>
            </tr>

            <?php
            foreach ($_SESSION["cart_item"] as $item){
                $item_price = $item["quantity"]*$item["price"];
                ?>
                <tr>
                    <td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
                    <td><?php echo $item["code"]; ?></td>
                    <td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
                    <td  style="text-align:right;"><?php echo "$ ".$item["price"]; ?></td>
                    <td  style="text-align:right;"><?php echo "$ ". number_format($item_price,2); ?></td>
                    <td style="text-align:center;"><a href="index.php?content=room.php&action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Remove Item" /></a></td>
                </tr>
                <?php
                $total_quantity += $item["quantity"];
                $total_price += ($item["price"]*$item["quantity"]);
            }
            ?>

            <tr>
                <td colspan="2" align="right">Total:</td>
                <td align="right"><?php echo $total_quantity; ?></td>
                <td align="right" colspan="2"><strong><?php echo "$ ".number_format($total_price, 2); ?></strong></td>
                <td></td>
            </tr>
            </tbody>
        </table>
        <?php
    } else {
        ?>
        <div class="no-records">Вы пока не забронировали номер</div>
        <?php
    }
    ?>
</div>

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
                        <div style="display: none" class="cart-action"><input type="text" class="product-quantity" name="quantity" value="<?php
                            if(!isset($_POST['dateTo'])){
                                echo '1';
                            } else {
                                $from = strtotime($_POST['dateFrom']);
                                $to = strtotime($_POST['dateTo']);
                                $secs = $to - $from;
                                $days = $secs / 86400;
                                echo $days;
                            }
                            ?>" size="2" /> Ночей</div>
                        <div class="cart-action" style="clear: both;"><input type="submit" value="Забронировать номер" class="btnAddAction" /></div>
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