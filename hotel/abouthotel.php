<?php

$location_str = "Отель находится в 5 мин ходьбы от станции метро «Адмиралтейская», 7 минутах ходьбы от станции метро «Невский проспект» и станции метро «Маяковская» и 10 мин езды от Московского вокзала и ТЦ \"Галерея\".";
$first_p = "Посмотрите на город глазами местных жителей, остановившись в самом центре Санкт-Петербурга. Отель «У Анны» удобно расположен на Невском проспекте - главной улице Санкт-Петербурга. В этом отеле, находящемся недалеко от всемирно известных культурных и исторических достопримечательностей Петербурга, включая музей Фаберже, гостей ждут роскошные номера для приятного отдыха. Отель находится рядом с торговыми и деловыми центрами, а также всего в 5 минутах ходьбы от нескольких станций метро.";
$second_p = "Здание, в котором расположен отель, построено в XVIII веке и имеет богатую историю. Его интерьер был полностью реконструирован в 2001 году. Также был восстановлен оригинальный фасад, свидетельствующий о величии этого здания. При этом были сохранены оригинальные элементы, возраст которых насчитывает почти 300 лет. Наш первоклассный отель в Санкт-Петербурге сочетает в себе роскошь и комфорт. Мы предлагаем гостям 164 элегантных и современных номера. Наши прекрасно оборудованные конференц-залы и светлый атриум готовы принять специальные мероприятия любого уровня: корпоративные семинары, приемы и свадьбы.";
?>
<!DOCTYPE html>
<HTML>
<head>
    <link href="style_room.css" type="text/css" rel="stylesheet"/>
    <link href="services.css" type="text/css" rel="stylesheet"/>
    <link href="userInfo.css" type="text/css" rel="stylesheet"/>
    <style>
        .main-page-text-container {
            width: 70%;
            margin-right: auto;
            margin-left: auto;
        }

        .title-section {
            line-height: 2.6rem;
            margin-bottom: 2.2rem;
            font-weight: bold;
            color: #000000;
            font-family: Arial;
        }

        .paragraph {
            line-height: 1.5;
            font-size: large;
            border-spacing: 15px;
            text-align: justify;
            font-family: Arial;
        }

        .bottom-info {
            margin-right: auto;
            margin-left: auto;
            text-align: center;
            font-size: large;
            width: 500px;
            font-family: Arial;
        }

        .container-polaroid {
            text-align: center;
            display: block;
            margin-left: auto;
            margin-right: auto;
            background-color: white;
            width: 640px;
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
            margin-bottom: 25px;
        }

        .polaroid-text {
            text-align: center;
            padding: 10px 20px;
        }
        }
    </style>
</head>


<body>
<div class="main-page-text-container">
    <h2 class="title-section" style="font-size: xx-large;">Классические архитектурные формы и современные удобства в
        отеле на легендарном Невском проспекте в Санкт-Петербурге</h2>
    <p class="paragraph">
        <?php echo (string)$first_p; ?>
    </p>
    <div class="container-polaroid">
        <img src="images/hotel_640_400.jpeg" alt="thehotel" style="width: 640px; height: 400px;">
        <div class="polaroid-text">
            <p class="paragraph" style="text-align: center"><b>Историческое здание отеля «У Анны»</b></p>
        </div>
    </div>

    <h3 class="title-section" style="font-size: x-large">Исторический отель в центре Санкт-Петербурга</h3>
    <p class="paragraph">
        <?php echo (string)$second_p; ?>
    </p>

    <div class="bottom-info">
        <br>
        ООО «Отель У Анны» <br>
        ИНН/КПП: 123456789101/3781620900 <br>
        Юридический адрес/Фактический адрес: <br>
        190000, г. Санкт-Петербург, ул. Большая Питерская, д.7 <br>
        Единый телефон: + 7 (812) 050-00-00 <br> <br> <br>
        <?php echo (string)$location_str; ?> <br> <br>
    </div>
</div>
</body>
</HTML>
