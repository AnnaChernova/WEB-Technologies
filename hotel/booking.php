<HTML>
<HEAD>
    <TITLE>Rooms</TITLE>
    <link href="userInfo.css" type="text/css" rel="stylesheet"/>
    <link href="style_room.css" type="text/css" rel="stylesheet"/>
    <link href="services.css" type="text/css" rel="stylesheet"/>
</HEAD>
<div class="txt-lk-heading">Ваши бронирования</div>
<form action="index.php?content=booking.php" method="post">
    <select name="TYPE">
        <option value="" >Любой</option>
        <option value="Эконом" <?php  if($_POST['TYPE'] === "Эконом"){ echo 'selected="selected"';}?>>Эконом</option>
        <option value="Стандарт" <?php  if($_POST['TYPE'] === "Стандарт"){ echo 'selected="selected"';}?>>Стандарт</option>
        <option value="Делюкс" <?php  if($_POST['TYPE'] === "Делюкс"){ echo 'selected="selected"';}?>>Делюкс</option>
        <option value="Люкс" <?php  if($_POST['TYPE'] === "Люкс"){ echo 'selected="selected"';}?>>Люкс</option>
    </select>
    <select name="STATUS">
        <option value="" >Любой</option>
        <option value="Забронировано" <?php  if($_POST['STATUS'] === "Забронировано"){ echo 'selected="selected"';}?>>Забронировано</option>
        <option value="Подтверждено администратором" <?php  if($_POST['STATUS'] === "Подтверждено администратором"){ echo 'selected="selected"';}?>>Подтверждено администратором</option>
        <option value="Отменено администратором" <?php  if($_POST['STATUS'] === "Отменено администратором"){ echo 'selected="selected"';}?>>Отменено администратором</option>
        <option value="Отменено пользователем" <?php  if($_POST['STATUS'] === "Отменено пользователем"){ echo 'selected="selected"';}?>>Отменено пользователем</option>
        <option value="Активно" <?php  if($_POST['STATUS'] === "Активно"){ echo 'selected="selected"';}?>>Активно</option>
        <option value="Завершено" <?php  if($_POST['STATUS'] === "Завершено"){ echo 'selected="selected"';}?>>Завершено</option>
    </select>
    <select name="COLUMN">
        <option value="DateArrival" <?php  if($_POST['COLUMN'] === "DateArrival"){ echo 'selected="selected"';}?>>Дата заезда</option>
        <option value="DateDeparture" <?php  if($_POST['COLUMN'] === "DateDeparture"){ echo 'selected="selected"';}?>>Дата выезда</option>
        <option value="Occupancy" <?php  if($_POST['COLUMN'] === "Occupancy"){ echo 'selected="selected"';}?>>Количество гостей</option>
        <option value="Area" <?php  if($_POST['COLUMN'] === "Area"){ echo 'selected="selected"';}?>>Площадь</option>
    </select>

    <select name="SORT">
        <option value="ASC" <?php  if($_POST['SORT'] === "ASC"){ echo 'selected="selected"';}?>>ASC</option>
        <option value="DESC" <?php  if($_POST['SORT'] === "DESC"){ echo 'selected="selected"';}?>>DESC</option>
    </select>
    <input name="search" type="submit" value="Найти"/>
</form>
<?php
if (!isset($_SESSION['id']) && !isset($_SESSION['user_name'])) {
    echo '<h1> К сожалению вы не залогинены, пожалуйста, залогинтесь!</h1>';
    return;
}
if (!isset($_POST['COLUMN'])){
    $_POST['COLUMN']='DateArrival';
}
if (!isset($_POST['SORT'])){
    $_POST['SORT']='ASC';
}
require_once 'config.php';
$sql = 'SELECT * FROM booking as b inner join journalofrooms as j on j.BookingId = b.BookingId  inner join room r on r.RoomId = j.RoomId inner join roomtype as rt on r.RoomTypeId = rt.RoomTypeId inner join bookingstatus as bs on b.BookingStatusId = bs.BookingStatusId  WHERE rt.RoomType like \'%'.$_POST['TYPE'].'%\' AND bs.Status like \'%'.$_POST['STATUS'].'%\' AND b.UserId ='.$_SESSION['id'].' ORDER BY '.$_POST['COLUMN'].' '.$_POST['SORT'];
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table-lk">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Номер бронирования</th>";
        echo "<th>Дата заезда</th>";
        echo "<th>Дата выезда</th>";
        echo "<th>Текущий статус бронирования</th>";
        echo "<th>Тип номера</th>";
        echo "<th>Количество гостей</th>";
        echo "<th>Площадь</th>";
        echo "<th>Число ночей</th>";
        echo "<th>Полная стоимость номера</th>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        while ($row = mysqli_fetch_array($result)) {
            $from = strtotime($row['DateArrival']);
            $to = strtotime($row['DateDeparture']);
            $secs = $to - $from;
            $days = $secs / 86400;
            $cost = $row['PricePerNight']*$days;
            echo "<tr>";
            echo "<td>" . $row['BookingId'] . "</td>";
            echo "<td>" . $row['DateArrival'] . "</td>";
            echo "<td>" . $row['DateDeparture'] . "</td>";
            echo "<td>" . $row['Status'] . "</td>";
            echo "<td>" . $row['RoomType'] . "</td>";
            echo "<td>" . $row['Occupancy'] . "чел.</td>";
            echo "<td>" . $row['Area'] . "m^2</td>";
            echo "<td>" . $days . "</td>";
            echo "<td>" . $cost . " ₽</td>";

            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
        // Free result set
        mysqli_free_result($result);
    } else {
        echo '<div class="alert alert-danger"><em>У вас еще нет бронирований.</em></div>';
    }
} else {
    echo "Oops! Something went wrong. Please try again later.";
}
?>
</HTML>
