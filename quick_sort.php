<?php

//快速排序
function quick_sort($arr){
    $len = count($arr);
    if($len <= 1) return $arr;
    $base_num = $arr[0];
    $left_arr = array();
    $right_arr = array();
    for($i = 1;$i < $len;$i++){
        if($arr[$i] < $base_num){
            //比第一个数小的放到左边
            $left_arr[] = $arr[$i];
        }else{
            $right_arr[] = $arr[$i];
        }
    }
    //递归调用
    $left_arr = quick_sort($left_arr);
    $right_arr = quick_sort($right_arr);
    //合并
    return array_merge($left_arr,array($base_num),$right_arr);
}

$arr = array(46,32,1,46,35,90,75,462,7,731);
print_r(quick_sort($arr));