<?php

function getSumCountFiles($dir)
{
    $sum = 0;

    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            $sum += getSumCountFiles($path);
        } else if (strtolower($file) == 'count') {  // смотрел в count без расширения, так как не было указано
            $countFile = file($path);
            if (!empty($countFile)) {
                $sum += array_sum(explode(' ', $countFile[0])); // считал числа через пробел друг от друга
            }
        }
    }

    return $sum;
}


if (!dir($dir = $argv[1])) exit("Ошибка в пути к файлу \n");

echo "Посчитаем сумму чисел только в файлах count: \n";

echo getSumCountFiles($dir) . "\n";