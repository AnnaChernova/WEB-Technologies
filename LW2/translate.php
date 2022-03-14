<?php
function translate($user_input)
{
    $translation_array = array(
        "кошка" => "cat",
        "собака" => "dog",
        "" => ""
    );

    if(!array_key_exists($user_input, $translation_array)) {
        echo "Перевод не найден!";
        return;
    }

    echo "Ваш перевод: " . $translation_array[$user_input];
}
