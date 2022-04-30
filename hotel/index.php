<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <!--    <title>Dashboard</title>-->
    <!--    <base href="http://localhost:63342/"/>-->
    <link rel="stylesheet" href="blocks.css">
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
</head>

<body>
<header class="header header--inner">
    <table style="table-layout: fixed; width:100%;height: 10px;">
        <tr>
            <td style="    width: 20%;">
                <div class="header_wrap">
                    <a href="/" class="h-logo">
                        <img style="height: 250px; width: 250px; object-fit: contain" src="/images/just_logo.png" alt="">
                    </a>
                </div>
            </td>
            <td style="    width: 80%;">
                <div class="header_wrap">
                    <img style="  display: block;
    margin-left: auto;
    margin-right: auto;" src="/images/small-text.png" alt="">
                </div>
            </td>
            <td style="    width: 10%;">
                <div class="h-right">
                    <div class="nav-icon">
                        <div>
                            <?php
                            session_start();
                            if (!empty($_GET['act'])) {
                                session_unset();
                            }
                            if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

                                echo '<h2 style="font-size: medium; color: white;">Добро пожаловать, ' . $_SESSION['user_name'] . '!</h2>';
                                ?>
                                <form action="index.php?content=rooms.php" method="get">
                                    <input type="hidden" name="act" value="run">
                                    <input type="hidden" name="content" value="rooms.php">
                                    <input type="submit" value="Выйти!">
                                </form>
                                <?php
                            } else {
//    header("Location: rooms_loged_in.php");
                                include 'index2.php';
                            }
                            ?>
                        </div>
                        <div class="nav-icon_line"></div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</header>


<div class="navigation-panel">
    <table style="position: center; margin-left: auto; margin-right: auto;">
        <tr>
            <td>
                <div class="head-links">
                    <div class="head-links_body">
                        <a href="index.php?content=abouthotel.php" class="head-links_item ">Об отеле</a>
                        <?php
                        if (isset($_SESSION['id'])) {
                            echo "<a href='index.php?content=userInfo.php' class='head-links_item'>Личный кабинет</a>";
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['id'])) {
                            echo "<a href='index.php?content=rooms_loged_in.php' class='head-links_item'>Номера и стоимость</a>";
                        } else {
                            echo "<a href='index.php?content=rooms.php' class='head-links_item'>Номера и стоимость</a>";
                        }
                        ?>
                        <?php
                        if (isset($_SESSION['id'])) {
                            echo "<a href='index.php?content=booking.php' class='head-links_item'>Ваши бронирования</a>";
                        }
                        ?>
                        <a href="index.php?content=services.php" class="head-links_item ">Услуги отеля</a>
                        <a href="index.php?content=aboutus.php" class="head-links_item ">О нас</a>
                    </div>
                </div>
            </td>

        </tr>
        <tr>
            <td>
                <br>
            </td>
        </tr>
    </table>
</div>

<div>
    <div>
        <?php include 'news.php'; ?>
    </div>
</div>

<div style="text-align: center; margin-left:auto; margin-right: auto">
    <?php
    if (isset($_GET['content'])) {
        include $_GET['content'];
    } else {
        include "aboutus.php";
    }
    ?>
</div>

<footer class="footer">
    <div class="footer_content">
        <div class="f-contact">
            <div class="f-contact_item">
                Работа выполнена студенткой ГУАП, Черновой Анной<br>
                Группа №1842<br>
            </div>
        </div>
    </div>
</footer>

<div>
    <div id="id01" style="display: none; margin-top: 10%" class="modal">
        <form class="modal-content animate" action="/login.php" method="post">
            <div class="container">
                <label for="uname"><b>Логин</b></label>
                <input type="text" placeholder="Введите логин" name="uname" required>

                <label for="psw"><b>Пароль</b></label>
                <input type="password" placeholder="Введите пароль" name="password" required>

                <button type="submit">Войти</button>

            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">
                    Отменить
                </button>
            </div>
        </form>
    </div>

    <div id="id02" style="display: none; margin-top: 15%" class="modal">

        <?php include 'createUser.php'; ?>
        </form>
    </div>
</div>

</body>
</html>
