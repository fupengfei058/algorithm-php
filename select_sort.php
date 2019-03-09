<?php
//选择排序
function select_sort($arr){
    $len = count($arr);
    for($i = 0;$i < $len - 1;$i++){
        //最小值的下标
        $min_index = $i;
        for($j = $i + 1;$j < $len;$j++){
            //不是最小值
            if($arr[$min_val] > $arr[$j]){
                $min_index = $j;
            }
        }
        if($min_index != $i){
            $temp = $arr[$i];
            $arr[$i] = $arr[$min_index];
            $arr[$min_index] = $temp;
        }
    }
    return $arr;
}
//最坏时间复杂度 O（n^2）
//最好时间复杂度 O（n^2）
//空间复杂度 O（1）

$arr = array(46,32,1,46,35,90,75,462,7,731);
print_r(select_sort($arr));
