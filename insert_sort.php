<?php
//插入排序
function insert_sort($arr){
    $len = count($arr);
    for($i = 1;$i < $len;$i++){
        $tmp = $arr[$i];
        for($j = $i - 1;$j >= 0;$j--){
            //插入的元素较小，交换位置
            if($tmp < $arr[$j]){
                $arr[$j+1] = $arr[$j];
                $arr[$j] = $tmp;
            }else{
                //前面的数字已经有序，不需要再次比较
                break;
            }
        }
    }
    return $arr;
}

$arr = array(46,32,1,46,35,90,75,462,7,731);
print_r(insert_sort($arr));