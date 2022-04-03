<?php
function OpenConnection($dbuser, $dbpass)
{
    $db = "TheHotel";
    $dbhost = "127.0.0.1";

    $query = "SELECT RoomId, Occupancy, Area, Photo, RoomTypeId
            FROM Room
            WHERE RoomTypeId = 1";

    $conn = new mysqli($dbhost, $dbuser, $dbpass, $db) or die("Connect failed: %s\n" . $conn->error);
    if ($conn) echo 'Подключились к базе.<br>';

    $result = printQueryResult($conn, $query);
    $row = mysqli_fetch_row($result);
    mysqli_free_result($result);

    return $conn;
}

function CloseConnection($conn)
{
    $conn->close();
    echo "</br>Соединение было закрыто.</br>";
}

function printQueryResult($conn, $query)
{
    $result = mysqli_query($conn, $query);
    while ($row = mysqli_fetch_object($result)) {
        echo $row->RoomId;
        echo $row->Occupancy;
        echo $row->Area;
        echo $row->Photo;
        echo $row->RoomTypeId;
        #print_r($row)->RoomId;
        echo '</br>';
    }
    if (!$result) {
        $message  = 'Неверный запрос: ' . mysqli_error() . "\n";
        $message .= 'Запрос целиком: ' . $query;
        die($message);
    }
    return $result;
}

?>
