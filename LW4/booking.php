<?php
if (!isset($_SESSION['id']) && !isset($_SESSION['user_name'])) {
    echo '<h1> К сожалению вы не залогинены, пожалуйста, залогинтесь!</h1>';
    return;
}
require_once 'config.php';
$sql = 'SELECT * FROM booking as b inner join journalofrooms as j on j.BookingId = b.BookingId  inner join room r on r.RoomId = j.RoomId inner join roomtype as rt on r.RoomTypeId = rt.RoomTypeId inner join bookingstatus as bs on b.BookingStatusId = bs.BookingStatusId WHERE b.UserId ='.$_SESSION['id'];
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-bordered table-striped">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Идентификатор бронирования</th>";
        echo "<th>Дата заезда</th>";
        echo "<th>Дата выезда</th>";
        echo "<th>Статус бронирования</th>";
        echo "<th>Тип номера</th>";
        echo "<th>Вместимость</th>";
        echo "<th>Площадь</th>";
        echo "<th>Число ночей </th>";
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
            echo "<td>" . $cost . "$</td>";

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