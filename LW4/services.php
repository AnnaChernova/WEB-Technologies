<?php

require_once 'config.php';
$sql = 'select * from service';
if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table table-bordered table-striped">';
        echo "<thead>";
        echo "<tr>";
        echo "<th>Название</th>";
        echo "<th>Описание</th>";
        echo "<th>Цена</th>";
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
            echo "<td>" . $row['Service'] . "</td>";
            echo "<td>" . $row['Description'] . "</td>";
            echo "<td>" . $row['Price'] . "</td>";
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