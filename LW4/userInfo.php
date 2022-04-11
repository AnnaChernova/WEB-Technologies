<div class="wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <?php
                if (!isset($_SESSION['id']) && !isset($_SESSION['user_name'])) {
                    echo '<h1> К сожалению вы не залогинены, пожалуйста, залогинтесь!</h1>';
                    return;
                }
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

                <div class="mt-5 mb-3 clearfix">
                    <h2 class="pull-left">Ваши данные</h2>
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

                        $sql = "UPDATE hoteluser SET FirstName=?, SecondName=?, Email=?, Login=?, Password=?, Phone=? WHERE UserId=".$_SESSION['id'];

                        if ($stmt = mysqli_prepare($link, $sql)) {
                            // Bind variables to the prepared statement as parameters
                            mysqli_stmt_bind_param($stmt, "ssssss", $param_FirstName, $param_SecondName,
                                $param_Email, $param_Login, $param_Password, $param_Phone);

                            // Set parameters
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
                $sql = 'SELECT * FROM hoteluser WHERE UserId='.$_SESSION['id'];
                if ($result = mysqli_query($link, $sql)) {
                    if (mysqli_num_rows($result) > 0) {
                        echo '<table class="bordery">';
                        echo "<thead>";
                        echo "<tr>";
                        echo "<th>№</th>";
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
                            echo "<td><form action=\"index.php?content=userInfo.php\" method=\"post\"><input type=\"submit\" name=\"UserId\" value=" . $user_row['UserId'] . " /></form></td>";
                            echo "<td>" . $user_row['FirstName'] . "</td>";
                            echo "<td>" . $user_row['SecondName'] . "</td>";
                            echo "<td>" . $user_row['Email'] . "</td>";
                            echo "<td>" . $user_row['Login'] . "</td>";
                            echo "<td>" . $user_row['Password'] . "</td>";
                            echo "<td>" . $user_row['Phone'] . "</td>";
                            echo "</tr>";

                            if ($_POST['UserId'] === $user_row['UserId']) {
                                echo "<td><form action=\"index.php?content=userInfo.php\" method=\"get\">";
                                echo "<input type=\"submit\" name=\"UserSaveChanges\" value=\"Сохранить\"/>";
                                echo "<input type=\"submit\" name=\"UserRevertChanges\" value=\"Отменить\"/></td>";
                                echo "<td><p><input name='FirstName' value=" . $user_row['FirstName'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='SecondName' value=" . $user_row['SecondName'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='Email' value=" . $user_row['Email'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='Login' value=" . $user_row['Login'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='Password' value=" . $user_row['Password'] . " autofocus></p> .</td>";
                                echo "<td><p><input name='Phone' value=" . $user_row['Phone'] . " autofocus></p> .</td>";
                                echo "<input style='display:none' name='content' value='userInfo.php' autofocus>";
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

        </div>
    </div>
</div>