<?php

class MyStack{
    private $top = -1;//默认-1，表示该栈为空
    private $maxSize = 5;//表示栈的最大容量
    private $stack = array();

    //入栈操作
    public function push($val){
        //判断栈是否已满
        if($this->top == $this->maxSize - 1){
            echo '栈满！';
            return;
        }
        $this->top ++;
        $this->stack[$this->top] = $val;
    }

    //出栈操作
    public function pop(){
        //判断是否栈空
        if($this->top == -1){
            echo '栈空';
            return;
        }
        //取出栈顶的值
        $topVal = $this->stack[$this->top];
        $this->top --;
        return $topVal;
    }
}