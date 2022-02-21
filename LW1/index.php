<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ЧерноваАА.ЛР №1</title>
    <style>
        img {
            width: 100px;
            border-radius: 10px;
        }

        h1 {
            background-color: #117A65;
            padding: 3px;
        }

        h2 {
            background-color: #138D75;
            padding: 2px;
        }
    </style>
</head>

<body bgColor=#E8F6F3>

<h1 align="center">Лабораторная работа №1 «Типы данных. Алгоритмические структуры»</h1>

<h2 align="center">Задание 1</h2>

<?php
$name = "Анна";
$surname = "Чернова";
$patronymic = "Антоновна";
$birthday = "9.10.1999";
$city = "Санкт-Петербург";
$height = 165;
$weight = 43;
$picture = "<img src='photo.jpg' alt= >";
?>
<table align="center" border=3>
    <!-- Первая строка таблицы -->
    <tr>
        <th>Фамилия</th>
        <th>Имя</th>
        <th>Отчество</th>
        <th>Дата рождения</th>
        <th>Место рождения</th>
    </tr>

    <!-- Вторая строка таблицы -->
    <tr align="center">
        <td><?php echo $surname; ?></td>
        <td><?php echo $name; ?></td>
        <td><?php echo $patronymic; ?></td>
        <td><?php echo $birthday; ?></td>
        <td><?php echo $city; ?></td>
    </tr>

    <!-- Третья строка таблицы -->
    <tr align='center'>
        <th colspan=5>Дополнительная информация</th>
    </tr>

    <!-- Четвёртая строка таблицы -->
    <tr align='center'>
        <td rowspan=2><?php echo $picture; ?></td>
        <th colspan=2>Рост</th>
        <td colspan=2><?php echo $height; ?></td>
    </tr>

    <!-- Пятая строка таблицы -->
    <tr align='center'>
        <th colspan=2>Вес</th>
        <td colspan=2><?php echo $weight; ?></td>
    </tr>
</table>
<?php
unset($name);
unset($surname);
unset($patronymic);
unset($birthday);
unset($city);
unset($height);
unset($weight);
unset($picture);
?>

<h2 align="center">Задание 2</h2>
<h4 align="center">Определение массы тела по Индексу Кетле</h4>
<p align="center">
    <?php
    $Height = rand(110, 220)/100; // Случайный рост в диапазоне от 1.1(м) до 2.2(м)
    $Weight = rand(30, 130); // Случайный вес в диапазоне от 30 до 130
    $BMI = $Weight / ($Height * $Height); // Индекс массы тела (англ. body mass index (BMI))

    echo "Рост = $Height (м) <br>";
    echo "Вес = $Weight (кг) <br>";
    echo "Индекс массы тела: $BMI <br>";
    ?>

<h4 align="center">Результат</h4>
<p align="center">
    <?php
    switch ($BMI) {
        case $BMI < 18.5:
            echo "Классификация: Дефицит массы тела.<br>Риск сопутствующих заболеваний: Низкий.";
            break;
        case $BMI >= 18.5 and $BMI <= 24.9:
            echo "Классификация: Нормальная масса тела.<br>Риск сопутствующих заболеваний: Обычный.";
            break;
        case $BMI >= 25.0 and $BMI <= 29.9:
            echo "Классификация: Избытчная масса тела.<br>Риск сопутствующих заболеваний:Повышенный.";
            break;
        case $BMI >= 30.0 and $BMI <= 34.9:
            echo "Классификация: Ожирение 1 степени.<br>Риск сопутствующих заболеваний: Высокий.";
            break;
        case $BMI >= 35.0 and $BMI <= 39.9:
            echo "Классификация: Ожирение 2 степени.<br>Риск сопутствующих заболеваний: Очень высокий.";
            break;
        case $BMI >= 40.0:
            echo "Классификация: Ожирение 3 степени.<br>Риск сопутствующих заболеваний: Чрезвычайно высокий.";
            break;
    }
    unset($Height);
    unset($Weight);
    unset($BMI);
    ?>

<h2 align="center">Задание 3</h2>
<h4 align="center">Номера - двумерный ассоциативный массив</h4>
<table align="center" border="3">
    <?php
    $services = array(
        "Номер" => array("Эконом", "Стандарт", "Делюкс", "Люкс"),
        "Цена" => array("70$", "120$", "250$", "400$"),
        "Размер" => array("20 кв/м", "25 кв/м", "55 кв/м", "84 кв/м"),
        "Вид с окон" => array("На двор", "На ресторанный дворик", "На море", "На море"),
        "Ванна/душ в номере" => array("Душ", "Тропический душ", "Ванна", "Ванна с джакузи")
    );

    // Шапка таблицы.
    echo "<tr>";
    foreach ($services as $first_key => $first) {
        echo "<th>$first_key</th>";
    }
    echo "</tr>";

    // Содержимое таблицы.
    for ($i = 0; $i <= count($first) - 1; $i++) {
        echo "<tr>";
        foreach ($services as $first_key => $first) {
            echo "<td>$first[$i]</td>";
        }
        echo "</tr>";
    }

    unset($services);
    ?>
</table>

<h4 align="center">Номера - многомерный ассоциативный массив</h4>
<table align="center" border="3">
    <?php
    $services = array(
        "Дешёвые номера" => array(
            "Эконом" => array(
                "Цена" => "70$",
                "Размер" => "20 кв/м",
                "Вид с окон" => "На двор",
                "Ванна/душ в номере" => "Душ"
            ),
            "Стандарт" => array(
                "Цена" => "120$",
                "Размер" => "25 кв/м",
                "Вид с окон" => "На ресторанный дворик",
                "Ванна/душ в номере" => "Тропический душ"
            )
        ),
        "Дорогие номера" => array(
            "Делюкс" => array(
                "Цена" => "250$",
                "Размер" => "55 кв/м",
                "Вид с окон" => "На море",
                "Ванна/душ в номере" => "Ванна"
            ),
            "Люкс" => array(
                "Цена" => "400$",
                "Размер" => "84 кв/м",
                "Вид с окон" => "На море",
                "Ванна/душ в номере" => "Ванна с джакузи"
            )
        )
    );

    echo "<tr>";
    foreach ($services as $key => $val) {
        echo "<td align = center colspan = '8'>$key</td>";
    }
    echo "</tr>";

    echo "<tr>";
    foreach ($services as $key1 => $val1) {
        foreach ($val1 as $key2 => $val2) {
            echo "<td align = center colspan = '4'>$key2</td>";
        }
    }
    echo "</tr>";

    echo "<tr>";
    foreach ($services as $key1 => $val1) {
        foreach ($val1 as $key2 => $val2) {
            foreach ($val2 as $key3 => $val3) {
                echo "<td>$key3 = $val3</td>";
            }
        }
    }
    echo "</tr>";

    echo "</table>";
    ?>
</table>

</body>
</html>