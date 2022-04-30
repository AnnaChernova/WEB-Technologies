<?php
require_once 'config.php';
$sql = 'SELECT * FROM news ORDER BY news_date DESC';

if ($result = mysqli_query($link, $sql)) {
    if (mysqli_num_rows($result) > 0) {
        echo '<table class="table-news">';
        echo "<thead>";
        echo "<tr>";
        echo "</tr>";
        echo "</thead>";
        echo "<tbody>";
        $rand = mt_rand(1, mysqli_num_rows($result));
        while ($row = mysqli_fetch_array($result) ) {
            if( $rand != $row['id']){
                continue;
            }
            $from = strtotime($row['DateArrival']);
            $to = strtotime($row['DateDeparture']);
            echo "<tr>";
            echo "<td style=' font-size: larger'><b>" . $row['title'] . "</b></td>";
            echo "<td style=' font-size: medium'>" . $row['desription'] . "</td>";
            echo "<td>" . $row['news_date'] . "</td>";
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