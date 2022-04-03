<?php
include 'style.php';
?>
<div style="width:40%; margin-left: auto; margin-right: auto;">
<h3>Извещение о посылке</h3>

<form id="4" method="post">
    <p><label>Дата создания: <input type="date" id="date" name="date" value="2022-01-01"></label></p>
    <fieldset style="background-color: #cef5dc;">
        <legend>Персональная информация</legend>
        <p><label for="name">Введите имя: </label><input type="text" name="name" placeholder="Ваше имя"></p>
        <p><label>Введите e-mail: <input type="email" name="email" placeholder="Ваша почта"></label></p>
        <p><label>Комментарий: </br><textarea name="comment" placeholder="Ваш комментарий"></textarea></label>
        </p>
    </fieldset>

    <fieldset style="background-color: #cef5dc;">
        <legend>Дополнительная информация</legend>
        <p>Доставка:
            <?php
            echo "<p><input type=checkbox name='delivery[]' value=Курьер > Курьер </p>";
            echo "<p><input type=checkbox name='delivery[]' value=Самолет > Самолет </p>";
            echo "<p><input type=checkbox name='delivery[]' value=Поезд > Поезд </p>";
            echo "<p><input type=checkbox name='delivery[]' value=Автотранспорт > Автотранспорт </p>";
            ?>
        </p>
        <p>Форма посылки: <select name="form">
                <?php
                echo "<option value = Круглая> Круглая </option>";
                echo "<option value = Прямоугольная> Прямоугольная </option>";
                echo "<option value = Квадратная> Квадратная </option>";
                ?>
            </select></p>
        <p><label for="color">Цвет посылки: <input type="color" name="color"></label></p>
        <p><label for="count">Количество: <input type="number" name="count" value=1 placeholder=1></label></p>
        <table style="border-color: unset; background-color: unset; margin-right: unset; margin-left: unset">
            <td>Тара:
                <p>
                    <select name="container[]" size=4 multiple>
                        <?php
                        echo "<option value=Бьющаяся > Бьющаяся </option>";
                        echo "<option value=Хрупкая > Хрупкая </option>";
                        echo "<option value=Водопроницаемая > Водопроницаемая </option>";
                        echo "<option value=Пожароопасная > Пожароопасная </option>";
                        ?>
                    </select>
                </p>
            </td>
            <td>
                <label>Вес:
                    <p><input type="radio" name="weight" value="< 50 кг" checked> до 50 кг</p>
                    <p><input type="radio" name="weight" value="> 50 кг"> больше 50 кг</p>
                </label>
            </td>
        </table>
    </fieldset>
    <p>
        <input type="submit" value="Отправить" name="send">
        <input type="submit" value="Очистка" name="erase">
    </p>

    <?php
    if (isset($_POST['send'])) {

        if ($_POST['name'] == '') {
            echo "Введите имя";
            $flag = false;
        } else if ($_POST['email'] == '') {
            echo "Введите email";
            $flag = false;
        } else if ($_POST['form'] == '') {
            echo "Выберите форму посылки";
            $flag = false;
        } else if ($_POST['count'] == '') {
            echo "Введите количество";
            $flag = false;
        } else if (empty($_POST['delivery'])) {
            echo "Выберите тип доставки";
            $flag = false;
        } else if (empty($_POST['container'])) {
            echo "Выберите тару";
            $flag = false;
        } else $flag = true;


        if ($flag) {
            echo("Дата создания извещения:<span> " . $_POST['date'] . "</span><br/>");
            echo("Здравствуйте <span>" . $_POST['name'] . "!</span><br/>");
            echo("Ваш e-mail: <span>" . $_POST['email'] . "</span><br/>");
            echo("Ваша доставка: <span>");
            foreach ($_POST['delivery'] as $key => $value)
                echo "<br>" . "$value";
            echo("</span><br>Форма поссылки: <span>\n" . $_POST['form'] . "</span><br/>");
            echo("Количество: <span>" . $_POST['count'] . "</span><br/>");
            echo("Вес посылки: <span>" . $_POST['weight'] . "</span><br/>");
            echo("Цвет поссылки:<div style='background-color:" . $_POST['color'] . ";width: 20px;height:20px;'></div>");
            echo("<span style='color:" . $_POST['color'] . "'>Код цвета=" . $_POST['color'] . "<br/></span>");
            echo("Была использована тара: <span>");
            foreach ($_POST['container'] as $key => $value)
                echo "<br>" . "$value";
            echo("</span><br>Комментарий: <span>" . $_POST['comment'] . "<br/></span>");
        }
    } else if (isset($_POST['erase'])) {
        echo "";
    }
    ?>
</form>
</div>