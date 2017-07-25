<?php

//递归方式
function binary_recur_search($arr,$val){
    global $time;
    if(count($arr) >= 1){
        $mid = intval(count($arr) / 2);
        $time++;
        if($arr[$mid] == $val){
            return '值为:'.$arr[$mid].'<br>查找次数：'.$time.'<br>';
        }elseif($arr[$mid] > $val){
            $arr = array_splice($arr,0,$mid);
            return binary_recur_search($arr, $val);
        }else{
            $arr = array_slice($arr,$mid + 1);
            return binary_recur_search($arr, $val);
        }
    }
    return '未找到'.$val;
}

//非递归方式
function binary_search($arr,$val){
    if(count($arr) >= 1){
        $low = 0;
        $high = count($arr);
        $time = 0;
        while($low <= $high){
            $time++;
            $mid = intval(($low + $high)/2);
            if($val == $arr[$mid]){
                return '索引：'.$mid.'<br>值为：'.$arr[$mid].'<br>查找次数：'.$time;
            }elseif($val > $arr[$mid]){
                $low = $mid + 1;
            }else{
                $high = $mid - 1;
            }
        }
    }
    return '未找到'.$val;
}

$arr = array(1,3,5,7,7,9,25,68,98,145,673,8542);
echo binary_recur_search($arr, 673);
echo binary_search($arr, 673);