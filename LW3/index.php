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
                    <a href="createUser.php" class="btn btn-success pull-right">
                        <i class="fa fa-plus"></i> Добавить нового пользователя</a>
                    <h2 class="pull-left">Найти пользователя по фильтру "тип"</h2>

                </div>
                <?php
                if (isset($_POST['clear'])) {
                    $UserType = '';
                    $RoomType = '';
                    $RoomOccupancy = '';
                    $UserId = '';
                    unset($_POST['clear'], $_POST['UserType'], $_POST['RoomType'], $_POST['Occupancy']);
                } else {
                    $UserId = $_POST['UserId'];
                    $UserType = $_POST['UserType'];
                    $RoomType = $_POST['RoomType'];
                    $RoomOccupancy = $_POST['Occupancy'];
                }
                ?>
                <form name="search" method="post">
                    <select aling="center" name="UserType" size="1">

                        <?php
                        require_once "config.php";
                        if (empty($_POST['UserType'])) {
                            echo "<option value=\"\" selected disabled hidden>Выберите тип пользователя</option>";
                        }
                        $sql_userType_filter = "SELECT distinct UserType from hoteluser;";
                        if ($result_userType_filter = mysqli_query($link, $sql_userType_filter)) {
                            if (mysqli_num_rows($result_userType_filter) > 0) {
                                while ($row3 = mysqli_fetch_array($result_userType_filter)) {
                                    if ($_POST['UserType'] === $row3['UserType']) {
                                        $property = "selected";
                                    } else {
                                        $property = "";
                                    }
                                    echo '<option ' . $property . ' value="' . $row3['UserType'] . '">' . $row3['UserType'] . '</option>';
                                }
                                mysqli_free_result($result_userType_filter);
                            } else {
                                echo '<div class="alert alert-danger"><em>Не найдены типы пользователей.</em></div>';
                            }
                        } else {
                            echo "Oops! Something went wrong. Please try again later.";
                        }
                        ?>
                    </select>
                    <div>
                        <br>
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
                require_once "config.php";
                if (isset($_GET['UserSaveChanges'])) {
                    onFunc();
                }
                if (isset($_GET['UserRevertChanges'])) {
                    offFunc();
                }

                function onFunc()
                {
                    // Validate name
                    $name = trim($_GET["FirstName"]);
                    if (empty($name)) {
                        echo "Please enter a name.";
                    }

                    // Validate secondName
                    $secondName = trim($_GET["SecondName"]);
                    if (empty($secondName)) {
                        echo "Please enter the secondName.";
                    }

                    // Validate email
                    $email = trim($_GET["Email"]);
                    if (empty($email)) {
                        echo "Please enter a email.";
                    }

                    // Validate email
                    $login = trim($_GET["Login"]);
                    if (empty($login)) {
                        echo "Please enter a login.";
                    }

                    // Validate email
                    $password = trim($_GET["Password"]);
                    if (empty($password)) {
                        echo "Please enter a password.";
                    }

                    // Validate email
                    $phone = trim($_GET["Phone"]);
                    if (empty($phone)) {
                        echo "Please enter a phone.";
                    }

                    // Check input errors before inserting in database
                    if (!empty($name) && !empty($secondName) && !empty($email) && !empty($login) && !empty($password) && !empty($phone)) {
                        // Prepare an update statement
                        $link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

                        $sql = "UPDATE hoteluser SET FirstName=?, SecondName=?, Email=?, Login=?, Password=?, Phone=? WHERE UserId=?";

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ssssssi", $param_FirstName, $param_SecondName,
                                $param_Email, $param_Login, $param_Password, $param_Phone, $param_Id);

                            // Set parameters
                            $param_Id = $_GET['UserId'];
                            $param_FirstName = $name;
                            $param_SecondName = $secondName;
                            $param_Email = $email;
                            $param_Login = $login;
                            $param_Password = $password;
                            $param_Phone = $phone;

                            // Attempt to execute the prepared statement
                            if (mysqli_stmt_execute($stmt)) {
                                // Records updated successfully. Redirect to landing page
                            } else {
                                echo "Oops! Something went wrong. Please try again later.";
                            }
                        }

                        // Close statement
                        mysqli_stmt_close($stmt);
                    }

                    // Close connection
                    mysqli_close($link);
                }

                function offFunc()
                {
                }

                // Attempt select query execution
                $sql = "SELECT * FROM hoteluser WHERE UserType like '%$UserType%';";
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
                        while ($user_row = mysqli_fetch_array($result)) {
                            echo "<tr>";
                            echo "<td><form action=\"index.php\" method=\"post\"><input type=\"submit\" name=\"UserId\" value=" . $user_row['UserId'] . " /></form></td>";
                            echo "<td>" . $user_row['UserType'] . "</td>";
                            echo "<td>" . $user_row['FirstName'] . "</td>";
                            echo "<td>" . $user_row['SecondName'] . "</td>";
                            echo "<td>" . $user_row['Email'] . "</td>";
                            echo "<td>" . $user_row['Login'] . "</td>";
                            echo "<td>" . $user_row['Password'] . "</td>";
                            echo "<td>" . $user_row['Phone'] . "</td>";
                            echo "</tr>";

                            if ($_POST['UserId'] === $user_row['UserId']) {
                                echo "<td><form action=\"index.php\" method=\"get\">";
                                echo "<input type=\"submit\" name=\"UserSaveChanges\" value=\"Сохранить\"/>";
                                echo "<input type=\"submit\" name=\"UserRevertChanges\" value=\"Отменить\"/></td>";
                                echo "<td><p><input name='UserId' hidden value=" . $user_row['UserId'] . " autofocus><input name='UserType' value=" . $user_row['UserType'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='FirstName' value=" . $user_row['FirstName'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='SecondName' value=" . $user_row['SecondName'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='Email' value=" . $user_row['Email'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='Login' value=" . $user_row['Login'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='Password' value=" . $user_row['Password'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='Phone' value=" . $user_row['Phone'] . " autofocus></p> .</td>";
                                echo "</form>";
                            }
                        }
                        echo "</tbody>";
                        echo "</table>";
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
                    <h2 class="pull-left">Номера отеля "У Анны"</h2>
                </div>
                <form name="search" method="post">
                    <table>
                        <tr>
                            <td>
                                <select aling="center" name="RoomType" size="1">
                                    <?php
                                    require_once "config.php";
                                    if (empty($_POST['RoomType'])) {
                                        echo "<option value=\"\" selected disabled hidden>Выберите тип номера</option>";
                                    }
                                    $sql_roomType_filter = "SELECT distinct RoomType from roomtype;";
                                    if ($result_roomType_filter = mysqli_query($link, $sql_roomType_filter)) {
                                        if (mysqli_num_rows($result_roomType_filter) > 0) {
                                            while ($row4 = mysqli_fetch_array($result_roomType_filter)) {
                                                if ($_POST['RoomType'] === $row4['RoomType']) {
                                                    $property4 = "selected";
                                                } else {
                                                    $property4 = "";
                                                }
                                                echo '<option value="' . $row4['RoomType'] . '">' . $row4['RoomType'] . '</option>';
                                            }
                                            mysqli_free_result($result_roomType_filter);
                                        } else {
                                            echo '<div class="alert alert-danger"><em>Не найдены типы пользователей.</em></div>';
                                        }
                                    } else {
                                        echo "Oops! Something went wrong. Please try again later.";
                                    }
                                    ?>
                                </select>
                            </td>
                            <td>
                                <select aling="center" name="Occupancy" size="1">
                                    <?php
                                    require_once "config.php";
                                    if (empty($_POST['Occupancy'])) {
                                        echo "<option value=\"\" selected disabled hidden>Выберите вместимость номера</option>";
                                    }
                                    $sql_roomOcc_filter = "SELECT distinct Occupancy from room;";
                                    if ($result_roomOcc_filter = mysqli_query($link, $sql_roomOcc_filter)) {
                                        if (mysqli_num_rows($result_roomOcc_filter) > 0) {
                                            while ($row5 = mysqli_fetch_array($result_roomOcc_filter)) {
                                                if ($_POST['Occupancy'] === $row5['Occupancy']) {
                                                    $property5 = "selected";
                                                } else {
                                                    $property5 = "";
                                                }
                                                echo '<option value="' . $row5['Occupancy'] . '">' . $row5['Occupancy'] . '</option>';
                                            }
                                            mysqli_free_result($result_roomOcc_filter);
                                        } else {
                                            echo '<div class="alert alert-danger"><em>Не найдены типы пользователей.</em></div>';
                                        }
                                    } else {
                                        echo "Oops! Something went wrong. Please try again later.";
                                    }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div>
                                    <br>
                                    <div><input type="submit" name="search" value="Найти"><br><br>
                                    </div>
                                    <div><input type="submit" name="clear" value="Очистить"><br><br>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                </form>
                <?php

                $direction = 1; // default
                // Include config file
                require_once "config.php";
                $isAsc = isset($_GET['direction']) ? (bool)$_GET['direction'] : 1;

                if (isset($_GET['sort'])) {
                    $sort = $_GET['sort'];
                } else {
                    $sort = "PricePerNight";
                }
                // Attempt select query execution
                $sql2 = "SELECT * FROM roomtype rt inner join room r on r.RoomTypeId = rt.RoomTypeId WHERE r.Occupancy like '%$RoomOccupancy%' and rt.RoomType like '%$RoomType' ORDER BY " . $sort . " " . ($isAsc ? "ASC" : "DESC") . ";";
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