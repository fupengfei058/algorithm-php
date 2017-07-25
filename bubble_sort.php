<?php
//冒泡排序
function bubble_sort($arr){
    $len = count($arr);
    for($i = 0;$i < $len;$i ++){
        for($j = 0;$j < $len - $i - 1;$j ++){
            if($arr[$j] > $arr[$j+1]){  //交换顺序
                $temp = $arr[$j];
                $arr[$j] = $arr[$j+1];
                $arr[$j+1] = $temp;
            }
        }
    }
    return $arr;
}

$arr = array(46,32,1,46,35,90,75,462,7,731);
print_r(bubble_sort($arr));