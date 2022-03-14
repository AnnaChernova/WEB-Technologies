<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЧерноваАА.ЛР №2</title>

    <?php include 'style.php'; ?>
</head>

<body>
<body bgColor=#E8F6F3>

<h1>Лабораторная работа №2 «Работа с элементами управления (ЭУ) формы. Передача параметров»</h1>

<h2>Задание 1</h2>

<table>
    <tr>
        <td>
            <form id="1" method="post">
                <p><b>Работа с циклическими структурами</b></p>
                <p>
                    <select aling="center" name="drop_down_box" size="1">
                        <option value="1">Таблица умножения</option>
                        <option value="2">Подсчёт суммы нечетных чисел</option>
                        <option value="3">Переводчик</option>
                    </select>
                </p>
                <p><input name="ddb_button" type="submit" value="Ок"></p>
            </form>
        </td>

        <td>
            <form id="2" method="get">
                <p><b>Работа с файлами</b></p>
                <p><input name="file_work" type="radio" value="1">Создание файла </p>
                <p><input name="file_work" type="radio" value="2">Добавление в файл </p>
                <p><input name="file_work" type="radio" value="3">Вывод из файла </p>
                <p><input name="fw_button" type="submit" value="Ок"></p>
            </form>
        </td>
    </tr>
</table>

<?php

$file_name = "d:\\Projects\\WEB-Technologies\\LW2\\file.txt";
$elements_count = 10;
$content = "";

if (isset($_POST["drop_down_box"])) {
    switch ($_POST["drop_down_box"]) {
        case "1":
            echo "<h4>Таблица умножения</h4>";
            $rows = 10;
            $cols = 10;
            $tr = 0;
            $td = 0;
            echo "<table>";
            while ($tr++ < $rows) {
                echo "<tr>";
                $td = 0;
                while ($td++ < $cols) {
                    if ($td == 1 || $tr == 1) echo "<td class='grid'><b>" . $tr * $td . "</b></td>\n";
                    else echo "<td class='grid'>" . $tr * $td . "</td>\n";
                }
                echo "</tr>";
            }
            echo "</table>";

            break;
        case "2":
            echo "<h4>Подсчёт суммы нечётных чисел</h4>";
            $sum = 0;
            $begin = 1;
            $end = 100;

            for ($i = $begin; $i < $end; $i += 2) {

                echo $sum = (int)$sum + $i . " ";
            }
            break;
        case "3":
            echo "<h4>Переводчик</h4>";
            if (isset($_POST["word"]))
                $user_input = $_POST["word"];
            else
                $user_input = "";

            ?>
            <table>
                <tr>
                    <td>
                        <form id='3' method='post'>
                            <input type="hidden" name="drop_down_box" value="3"/>
                            <p><b>Введите слово:</b></p>
                            <p>
                                <?php echo "<input name=\"word\" type=\"text\" size='30' maxlength='30' value=\"$user_input\">" ?>
                                <input name="translate_button" type="submit" value="Ок">
                            </p>
                            <p>
                                <?php include 'translate.php';
                                translate($user_input); ?>
                            </p>
                        </form>
                    </td>
                </tr>
            </table>
            <?php
            break;
        default:
            throw new \Exception('Unexpected value');
    }
} else if (isset($_GET["file_work"])) {
    if ($_GET["file_work"] == 1) {
        $my_file = fopen($file_name, "w+");

        for ($i = 1; $i <= $elements_count; ++$i) {
            $content = $content . $i . " элемент\n";
        }

        fwrite($my_file, $content);
        fclose($my_file);

        echo "<p class='center'> Файл $file_name был создан и записан. </p>";
    } else if ($_GET["file_work"] == 2) {
        if(file_exists($file_name)){
            $my_file = fopen($file_name, "a");
            $content = "Новый элемент\n";
            fwrite($my_file, $content);
            fclose($my_file);
            echo "<p class='center'> В файл $file_name добавлен новый элемент. </p>";
        } else {
            echo "<p class='center'> Файл $file_name не был создан.\n
                Для возможности добавления содержимого 
                необходимо сперва создать файл. </p>";
        }
    } else if ($_GET["file_work"] == 3) {
        if(file_exists($file_name)) {
            $content = file($file_name);
            echo "<h4 class='center'>"."Содержимое файла"."<br></h4>";
            foreach ($content as $string) {
                echo "<text class='center'>".$string."<br></text>";
            }
        }
    }
}
?>

<h2>Задание 2</h2>

<?php include 'ParcelNotice.php'; ?>

</body>
</html>