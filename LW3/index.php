<!DOCTYPE html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .wrapper {
            margin: 0 auto;
        }
    </style>
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>
<body>
<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Найти пользователя</h2>
                    <a href="createUser.php" class="btn btn-success pull-right">
                        <i class="fa fa-plus"></i> Добавить нового пользователя</a>
                </div>
                <?php
                if (isset($_POST['clear'])) {
                    $type = '';
                    $name = '';
                    $secondName = '';
                    $email = '';
                    unset($_POST['clear']);
                } else {
                    $type = $_POST['userType'];
                    $name = $_POST['name'];
                    $secondName = $_POST['secondName'];
                    $email = $_POST['email'];
                }
                ?>
                <form name="search" method="post">
                    <input type="text" name="userType" placeholder="Тип" value="<?php echo $type; ?>"><br><br>
                    <input type="text" name="name" placeholder="Имя" value="<?php echo $name; ?>"><br><br>
                    <input type="text" name="secondName" placeholder="Фамилия"
                           value="<?php echo $secondName; ?>"><br><br>
                    <input type="text" name="email" placeholder="Почта" value="<?php echo $email; ?>"><br><br>
                    <div>
                        <div><input type="submit" name="search" value="Найти"><br><br>
                        </div>
                        <div><input type="submit" name="clear" value="Очистить"><br><br>
                        </div>
                    </div>
                </form>
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Список пользователей</h2>
                </div>
                <?php
                // Include config file
                require_once "config.php";

                // Attempt select query execution
                $sql = "SELECT * FROM hoteluser WHERE UserType like '%$type%' and FirstName like '%$name%' and SecondName like '%$secondName%' and Email like '%$email%'";
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Тип</th>";
                        echo "<th>Имя</th>";
                        echo "<th>Фамилия</th>";
                        echo "<th>Почта</th>";
                        echo "<th>Логин</th>";
                        echo "<th>Пароль</th>";
                        echo "<th>Телефон</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td>" . $row['UserId'] . "</td>";
                            echo "<td>" . $row['UserType'] . "</td>";
                            echo "<td>" . $row['FirstName'] . "</td>";
                            echo "<td>" . $row['SecondName'] . "</td>";
                            echo "<td>" . $row['Email'] . "</td>";
                            echo "<td>" . $row['Login'] . "</td>";
                            echo "<td>" . $row['Password'] . "</td>";
                            echo "<td>" . $row['Phone'] . "</td>";
                            echo "<td>" . '<a href="updateUser.php?UserId=' . $row['UserId'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>' . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result);
                    } else {
                        echo '<div class="alert alert-danger"><em>Результат не найден.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }
                ?>
            </div>

            <div class="col-md-12">
                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Виды номеров отеля "У Анны"</h2>
                </div>
                <?php
                if (isset($_POST['clear'])) {
                    $name = '';
                    $secondName = '';
                    $email = '';
                    unset($_POST['clear']);
                } else {
                    $name = $_POST['name'];
                    $secondName = $_POST['secondName'];
                    $email = $_POST['email'];
                }
                $direction = 1; // default
                // Include config file
                $isAsc = isset($_GET['direction']) ? (bool)$_GET['direction'] : 1;

                if (isset($_GET['sort'])) {
                    $sort = $_GET['sort'];
                } else {
                    $sort = "PricePerNight";
                }
                // Attempt select query execution
                $sql2 = "SELECT * FROM roomtype rt inner join room r on r.RoomTypeId = rt.RoomTypeId ORDER BY " . $sort . " " . ($isAsc ? "ASC" : "DESC") . ";";

                $result = $link->query($sql);
                if ($result2 = mysqli_query($link, $sql2)) {
                    if (mysqli_num_rows($result2) > 0) {
                        echo '<table class="table table-bordered table-striped">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>#</th>";
                        echo "<th>Тип</th>";
                        echo "<th >Описание</th>";
                        echo "<th>" . '<a href="?sort=PricePerNight&direction=' . !$isAsc . '">Цена</a>' . "</th>";
                        echo "<th>" . '<a href="?sort=Area&direction=' . !$isAsc . '">Площадь</a>' . "</th>";
                        echo "<th>" . '<a href="?sort=Occupancy&direction=' . !$isAsc . '">Вместимость</a>' . "</th>";
                        echo "</tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row1 = mysqli_fetch_array($result2)) {
                            echo "<tr>";
                            echo "<td>" . $row1['RoomId'] . "</td>";
                            echo "<td>" . $row1['RoomType'] . "</td>";
                            echo "<td>" . $row1['Facilities'] . "</td>";
                            echo "<td>" . $row1['PricePerNight'] . "$</td>";
                            echo "<td>" . $row1['Area'] . " метров квадратных</td>";
                            echo "<td>" . $row1['Occupancy'] . " - местный</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                        // Free result set
                        mysqli_free_result($result2);
                    } else {
                        echo '<div class="alert alert-danger"><em>Пользователей еще не создано.</em></div>';
                    }
                } else {
                    echo "Oops! Something went wrong. Please try again later.";
                }

                // Close connection
                mysqli_close($link);
                ?>
            </div>
        </div>
    </div>
</div>
</body>
</html>