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


//以上实现方式由于会开辟临时数组，内存的开销会比较多，更理想的方式是用数组元素的替换：
function swap(array &$arr,$a,$b){
    $temp = $arr[$a];
    $arr[$a] = $arr[$b];
    $arr[$b] = $temp;
}

function Partition(array &$arr,$low,$high){
    $pivot = $arr[$low];   //选取子数组第一个元素作为枢轴
    while($low < $high){  //从数组的两端交替向中间扫描
        while($low < $high && $arr[$high] >= $pivot){
            $high --;
        }
        swap($arr,$low,$high);	//终于遇到一个比$pivot小的数，将其放到数组低端
        while($low < $high && $arr[$low] <= $pivot){
            $low ++;
        }
        swap($arr,$low,$high);	//终于遇到一个比$pivot大的数，将其放到数组高端
    }
    return $low;   //返回high也行，毕竟最后low和high都是停留在pivot下标处
}

function QSort(array &$arr,$low,$high){
    if($low < $high){
        $pivot = Partition($arr,$low,$high);  //将$arr[$low...$high]一分为二，算出枢轴值
        QSort($arr,$low,$pivot - 1);   //对低子表进行递归排序
        QSort($arr,$pivot + 1,$high);  //对高子表进行递归排序
    }
}

function QuickSort(array &$arr){
    $low = 0;
    $high = count($arr) - 1;
    QSort($arr,$low,$high);
}
