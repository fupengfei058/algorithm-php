<?php

function exchange(&$a,&$b){
        $temp = $b;
        $b = $a;
        $a = $temp;
}

function left($i){ return $i*2+1;}

function right($i){ return $i*2+2;}

function buildHeap(&$array,$i,$heapsize){

        $left = left($i);
        $right = right($i);
        $max = $i;
        if($i < $heapsize && $left<$heapsize  && $array[$left] > $array[$i] ){
                $max = $left;
        }

        if($i < $heapsize && $right<$heapsize && $array[$right] > $array[$max]){
                $max = $right;
        }
        if($i != $max && $i < $heapsize && $max < $heapsize){
                exchange($array[$i],$array[$max]);
                buildHeap($array,$max,$heapsize);
        }
}

function sortHeap(&$array,$heapsize){
        while($heapsize){
                exchange($array[0],$array[$heapsize-1]);
                $heapsize = $heapsize -1;
                buildHeap($array,0,$heapsize);
        }
}

function createHeap(&$array,$heapsize){
        $i = ceil($heapsize/2)-1;
        for(;$i>=0;$i--){
                buildHeap($array,$i,$heapsize);
        }
}

function main(){
        $array = array(88,99,22,11,22,13,9,2,1,100,12);
        $heapsize = count($array);
        createHeap($array,$heapsize);

        print_r($array);
        sortHeap($array,$heapsize);
        print_r($array);
}

main();
