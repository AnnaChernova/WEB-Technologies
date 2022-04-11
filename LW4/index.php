<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <base href="http://localhost:63342/LW4/" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="blocks.css">
    <script>
        $(document).ready(function () {
            $('[data-toggle="tooltip"]').tooltip();
        });

    </script>

</head>

<style>
    .center {
        margin: 10px;
        position: absolute;
        top: 50%;
        left: 50%;
        -ms-transform: translate(-50%, -50%);
        transform: translate(-50%, -50%);
    }
    .inline {
        border: 1px solid red;
        float:left;
        display:table-row;
    }
    .outer {
        background: olive;
        height: 100%;
        display: flex;
        flex-direction: column;
    }

    .should_fill_available_space{
        background: brown;
        flex-grow: 2;
    }
</style>



<body>
<div style="height: 10em">
    <div class="block1" style="height: 180px">
        <div>
            <img style="height: 180px; width: 100%; object-fit: contain" src='./images/logo.png' alt="" />
        </div>
    </div>

    <div class="block2" style="min-height: 180px">
        <h1>Отель "У Анны"</h1>
    </div>

    <div class="block3"  style="word-wrap: break-word; text-align: center; min-height: 180px">

        <div >
            <?php

            session_start();
            if (!empty($_GET['act'])) {
                session_unset();
            }
            if (isset($_SESSION['id']) && isset($_SESSION['user_name'])) {

                echo '<h2>Добро пожаловать, '.$_SESSION['user_name'].'!</h2>';
            ?>
                <form action="index.php" method="get">
                    <input type="hidden" name="act" value="run">
                    <input type="submit" value="Выйти!">
                </form>
                <?php
            }else{

//    header("Location: room.php");
                include 'index2.php';
            }

            ?>

        </div>
    </div>
</div>

<div style="width: 100%">
    <div >
        <div style="width: 100%">
            <?php
            if (isset($_SESSION['id'])){
                echo "<div class='inline'><div><h1><a href='index.php?content=userInfo.php'>Личный кабинет</a></h1></div></div>";
            }
            ?>
            <?php
            if (isset($_SESSION['id'])){
                echo  "<div class='inline'><div><h1><a href='index.php?content=room.php'>Наши Номера</a></h1></div></div>";
            } else {
                echo  "<div class='inline'><div><h1><a href='index.php?content=rooms.php'>Наши Номера</a></h1></div></div>";
            }
            ?>
            <?php
            if (isset($_SESSION['id'])){
                echo "<div class='inline'><div><h1><a href='index.php?content=booking.php'>Ваши бронирования</a></h1></div></div>";
            }
            ?>
            <div class='inline'><div><h1><a href="index.php?content=aboutus.php">О нас</a></h1></div></div>
            <div class='inline'><div><h1><a href="index.php?content=services.php">Услуги нашего отеля</a></h1></div></div>
        </div>
    </div>
</div>

<div style="height: 5em width: 90% position:relative">
    <div class="block6">
        <h1>Реклама + новости</h1>
    </div>
</div>

<div style="height: 8em  width: 90% position:relative">
    <div class="block5">
        <?php
        if (isset($_GET['content'])) {
            include $_GET['content'];
        } else {
            echo '<h1>CONTENT</h1>';
        }
        ?>
    </div>
</div>

<div class="block7">
    <h1 class="block7">Авторская работа студентки Черновой А.А.</h1>
</div>
 <div>
     <div id="id01" style="display: none" class="modal">

         <form class="modal-content animate" action="/login.php" method="post">
             <div class="imgcontainer">
                 <div class="block1">
                     <div>
                     </div>
                 </div>

             </div>

             <div class="container">
                 <label for="uname"><b>Логин</b></label>
                 <input type="text" placeholder="Введите логин" name="uname" required>

                 <label for="psw"><b>Пароль</b></label>
                 <input type="password" placeholder="Введите пароль" name="password" required>

                 <button type="submit">Войти</button>

             </div>

             <div class="container" style="background-color:#f1f1f1">
                 <button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Отменить</button>
             </div>
         </form>
     </div>

     <div id="id02" style="display: none" class="modal">

       <?php include 'createUser.php';?>
         </form>
     </div>
 </div>

</body>
</html>
