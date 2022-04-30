<?php
$location_str = "Отель находится в 5 мин ходьбы от станции метро «Адмиралтейская», 7 минутах ходьбы от станции метро «Невский проспект» и станции метро «Маяковская» и 10 мин езды от Московского вокзала и ТЦ \"Галерея\".";
$help_str = "Мы готовы помочь вам с выбором!";
$good_str = "Мы всегда рады вас видеть!";
?>
<link href="style_room.css" type="text/css" rel="stylesheet"/>
<link href="services.css" type="text/css" rel="stylesheet"/>
<style>
    .table-about-us {
        margin-right: auto;
        margin-left: auto;
        /*border: #888888 1px solid; !* TODO: deleter for production *!*/
        border-spacing: 15px;
        font-size: large;
    }

    .contact-image {
        height: 128px;
        width: 128px;
        background-color: #FFF;
        border-radius: 30%;
    }

    .bottom-info {
        margin-right: auto;
        margin-left: auto;
        text-align: center;
        font-size: large;
        width: 500px;
        font-family: Arial;
    }
</style>

<br>
<h2 style="text-align: center">
    <?php
    echo $good_str;
    ?>
</h2>
<br><br><br>

<table class="table-about-us">
    <tr>
        <td>

        </td>
        <td>

        </td>
        <td align="center">
            <b>Телефон</b>
        </td>
        <td align="center">
            <b>Часы работы</b
        </td>
        <td align="center">
            <b>Электронная почта</b
        </td>
    </tr>
    <tr>
        <td>
            <img class="contact-image" src="contacts-images/director.jpg">
        </td>
        <td align="center">
            <b>Рудо Саед<br>Генеральный директор<br>(приёмная)</b>
        </td>
        <td>
            +7 (812) 050-00-50
        </td>
        <td>
            пн-пт, 10ч-18ч
        </td>
        <td>
            director@annashotel.ru
        </td>
    </tr>
    <tr>
        <td>
            <img class="contact-image" src="contacts-images/sales.jpg">
        </td>
        <td align="center">
            <b>Дина<br>Отдел продаж</b>
        </td>
        <td>
            +7 (812) 050-00-55
        </td>
        <td>
            ежедневно, 9ч-21ч
        </td>
        <td>
            sales@annashotel.ru
        </td>
    </tr>
    <tr>
        <td>
            <img class="contact-image" src="contacts-images/reception.jpg">
        </td>
        <td align="center">
            <b>Екатерина<br>Служба приема и размещения</b>
        </td>
        <td>
            +7 (812) 050-00-35
        </td>
        <td>
            круглосуточно
        </td>
        <td>
            reception@annashotel.ru
        </td>
    </tr>
    <tr>
        <td>
            <img class="contact-image" src="contacts-images/spa.jpg">
        </td>
        <td align="center">
            <b>Ольга<br>СПА-центр</b>
        </td>
        <td>
            +7 (812) 050-00-38
        </td>
        <td>
            ежедневно, 9ч-21ч
        </td>
        <td>
            spa@annashotel.ru
        </td>
    </tr>
    <tr>
        <td>
            <img class="contact-image" src="contacts-images/shief.jpg">
        </td>
        <td align="center">
            <b>Дмитрий<br>Шеф-повар ресторана</b>
        </td>
        <td>
            +7 (812) 050-00-41
        </td>
        <td>
            ежедневно, 9ч-21ч
        </td>
        <td>
            restaurant@annashotel.ru
        </td>
    </tr>
</table>
<br>
<div class="bottom-info">
    ООО «Отель У Анны» <br>
    ИНН/КПП: 123456789101/3781620900 <br>
    Юридический адрес/Фактический адрес: <br>
    190000, г. Санкт-Петербург, ул. Большая Питерская, д.7 <br>
    Единый телефон: + 7 (812) 050-00-00 <br> <br>

    Или свяжитесь с нами!
    <br>
    <?php
    if(isset($_POST['submit'])){
        $to = "email@example.com"; // this is your Email address
        $from = $_POST['email']; // this is the sender's Email address
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $subject = "Форма обратной связи";
        $message = $first_name . " " . $last_name . " написал из формы на сайте:" . "\n\n" . $_POST['message'];

        $headers = "From:" . $from;
        $headers2 = "From:" . $to;
        mail($to,$subject,$message,$headers);
        echo "Письмо отправлено. Спасибо " . $first_name . ", мы свяжемся с вами в ближайшее время!";
    }
    ?>


    <form action="" method="post">
        Ваше имя: <input type="text" name="first_name"><br>
        Ваша фамилия: <input type="text" name="last_name"><br>
        Email: <input type="text" name="email"><br>
        Сообщение:<br><textarea rows="5" name="message" cols="30"></textarea><br>
        <input type="submit" name="submit" value="Отправить">
    </form>
</div>
<br><br>