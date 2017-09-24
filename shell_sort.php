<?php

/**
 * 希尔排序
 */
function shell_sort(array $arr){
    // 将$arr按升序排列
    $len = count($arr);
    $f = 3;// 定义因子
    $h = 1;// 最小为1
    while ($h < $len/$f){
        $h = $f*$h + 1; // 1, 4, 13, 40, 121, 364, 1093, ...
    }
    while ($h >= 1){  // 将数组变为h有序
        for ($i = $h; $i < $len; $i++){  // 将a[i]插入到a[i-h], a[i-2*h], a[i-3*h]... 之中
            for ($j = $i; $j >= $h;  $j -= $h){
                if ($arr[$j] < $arr[$j-$h]){
                    $temp = $arr[$j];
                    $arr[$j] = $arr[$j-$h];
                    $arr[$j-$h] = $temp;
                }
                //print_r($arr);echo '<br/>'; // 打开这行注释，可以看到每一步被替换的情形
            }
        }
        $h = intval($h/$f);
    }
    return $arr;
}


$arr = array(14, 9, 1, 4, 6, -3, 2, 99, 13, 20, 17, 15, 3);

$shell = shell_sort($arr);


echo '<pre>';
print_r($shell);

/**
 *
Array
(
[0] => -3
[1] => 1
[2] => 2
[3] => 3
[4] => 4
[5] => 6
[6] => 9
[7] => 13
[8] => 14
[9] => 15
[10] => 17
[11] => 20
[12] => 99
)
 *
 */