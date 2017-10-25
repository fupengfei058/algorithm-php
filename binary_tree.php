<?php

class Node{
    public $value,$left,$right;
    public function __construct($value)
    {
        $this->value = $value;
    }
}

class BinaryTree{
    public $root;
    public $sortArr = [];
    // 插入节点
    public function insertNode($node,$newNode){
        if ($node->value < $newNode->value){
            // 如果父节点小于子节点,插到右边
            if (empty($node->right)){
                $node->right = $newNode;
            }else{
                $this->insertNode($node->right,$newNode);
            }
        }elseif ($node->value > $newNode->value){
            // 如果父节点大于子节点,插到左边
            if (empty($node->left)){
                $node->left = $newNode;
            }else{
                $this->insertNode($node->left,$newNode);
            }
        }
    }
    public function insert($key){
        $newNode = new Node($key);
        if (empty($this->root)){
            $this->root = $newNode;
        }else{
            $this->insertNode($this->root,$newNode);
        }
    }
    // 中序遍历
    public function midSort(){
        $this->midSortNode($this->root);
    }
    public function midSortNode($node){
        if (!empty($node)){
            $this->midSortNode($node->left);
            array_push($this->sortArr,$node->value);
            $this->midSortNode($node->right);
        }
    }
    // 寻找极值
    public function findMin(){
        //不断的找它的左子树,直到这个左子树的节点为叶子节点.
        if (!empty($this->root)){
            $this->findMinNode($this->root);
        }
    }
    public function findMinNode(Node $node){
        if (!empty($node->left)){
            $this->findMinNode($node->left);
        }else{
            echo '这个二叉树的最小值为:'.$node->value;
        }
    }
    public function findMax(){
        if (!empty($this->root)){
            $this->findMaxNode($this->root);
        }
    }
    public function findMaxNode(Node $node){
        if (!empty($node->right)){
            $this->findMaxNode($node->right);
        }else{
            echo '这个二叉树的最大值为:'.$node->value;
        }
    }
    // 查找特定的值
    public function find($val = ''){
        if (!empty($val)){
            $this->findNode($this->root,$val);
        }
    }
    public function findNode(Node $node,$val){
        if ($node->value == $val){
            echo '找到'.$val;
        }else if ($node->value > $val){
            // 如果 父节点的值 大于要查找的值,那么查找它的左子树
            if (!empty($node->left)){
                $this->findNode($node->left,$val);
            }else{
                echo '查无此数!';
            }
        }else if ($node->value < $val){
            if (!empty($node->right)){
                $this->findNode($node->right,$val);
            }else{
                echo '查无此数!';
            }
        }
    }
}

$tree = new BinaryTree();
// 节点插入
$nodes = array(8,3,10,1,6,14,4,7,13);
foreach ($nodes as $value){
    $tree->insert($value);
}
// 中序遍历
//$tree->midSort();
//print_r($tree->sortArr);
// 寻找极值
//$tree->findMin();
//$tree->findMax();
// 查找特定的值
$tree->find(7);
$tree->find(11);