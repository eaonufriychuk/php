<?php
header("Content-type:text/html; charset=utf-8");
/*
 * 4. Объявить массив, индексами которого являются буквы русского языка,
 * а значениями – соответствующие латинские буквосочетания
 * (‘а’=> ’a’, ‘б’ => ‘b’, ‘в’ => ‘v’, ‘г’ => ‘g’, …, ‘э’ => ‘e’, ‘ю’ => ‘yu’, ‘я’ => ‘ya’).
 * Написать функцию транслитерации строк.
 *
 * Функцию strtr() использовать запрещено!
 */
$string = "<p>1. Чтобы показать заказчику эскизы, нужно где-то найти тексты и картинки. Как правило, ни того, ни другого в момент показа эскизов у дизайнера нету.</p><p>2. Что же делает дизайнер? Рыбу. Рыбу можно вставлять, использовать, вешать, заливать, показывать, запихивать... Словом, с ней делают что угодно, лишь бы эскиз был максимально похож на готовую работу.</p><p>3. Если в качестве рыбных картинок использовать цветные прямоугольники, а вместо текста — несколько повторяющихся слов, эскиз будет выглядеть неестественно.</p>";
function translit($string)
{
    $dictionary = [
        "а" => "a",
        "б" => "b",
        "в" => "v",
        "г" => "g",
        "д" => "d",
        "е" => "e",
        "ё" => "e",
        "ж" => "zh",
        "з" => "z",
        "и" => "i",
        "й" => "y",
        "к" => "k",
        "л" => "l",
        "м" => "m",
        "н" => "n",
        "о" => "o",
        "п" => "p",
        "р" => "r",
        "с" => "s",
        "т" => "t",
        "у" => "u",
        "ф" => "f",
        "х" => "h",
        "ц" => "c",
        "ч" => "ch",
        "ш" => "sh",
        "щ" => "sch",
        "ь" => "'",
        "ы" => "y",
        "ъ" => "''",
        "э" => "e",
        "ю" => "yu",
        "я" => "ya"
    ];
    // Преобразование строки в массив. Решение проблемы с UTF-8
    // https://stackoverflow.com/questions/21653033/php-how-to-split-a-utf-8-string
    $stringToArray = preg_split('//u', $string, -1, PREG_SPLIT_NO_EMPTY);
    foreach ($stringToArray as $key => $character) {
        foreach ($dictionary as $rus => $trans) {
            if ($character == $rus) {
                $stringToArray[$key] = $trans;
                break;
            } elseif ($character == mb_strtoupper($rus)) {
                // mb_strtoupper — Приведение строки к верхнему регистру (Функции для работы с Многобайтными строками)
                $stringToArray[$key] = mb_strtoupper($trans);
                break;
            }
        }
    }
    // implode — Объединяет элементы массива в строку
    return implode($stringToArray);
}
echo "<b>Исходная строка:</b> $string <hr>";
echo "<b>Транслитерация:</b>" . translit($string);