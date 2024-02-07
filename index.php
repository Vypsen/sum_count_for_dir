<?php

function getSumCount($dir)
{
    $sum = 0;

    $files = array_diff(scandir($dir), ['.', '..']);
    foreach ($files as $file) {
        $path = $dir . '/' . $file;

        if (is_dir($path)) {
            $sum += getSumCount($path);
        } else if (is_file($path) && (pathinfo($path)['filename'] === 'count')) {
            $countFile = file($path);
            if (!empty($countFile)) {
                $sum += array_sum(explode(' ', $countFile[0]));
            }
        }
    }

    return $sum;
}


if (!dir($dir = $argv[1])) exit("Ошибка в пути к файлу \n");

echo "Посчитаем сумму чисел только в файлах count: \n";

echo getSumCount($dir) . "\n";