<?php

class Node
{
    public $key, $val;
    public $left, $right;
    public $color;
    public $N;
    public function __construct($key, $val, $color)
    {
        $this->key = $key;
        $this->val = $val;
        $this->color = $color;
    }
}
class RedBlackTree
{
    const RED = true;
    const BLACK = false;

    public $root;

    public function isRed(Node $node){
        if ($node == null) return false;
        return $node->color == self::RED;
    }

    // 左旋转$node的右链接
    public function rotateLeft(Node $node){
        $nodeX = $node->right;
        $node->right = $nodeX->left;
        $nodeX->left = $node;
        $nodeX->color = $node->color;
        $node->color = self::RED;
        $nodeX->N = $node->N;
        $node->N = 1 + $this->getSize($node->left) + $this->getSize($node->right);
        return $nodeX;
    }

    // 右旋转$node的左链接
    public function rotateRight(Node $node){
        $nodeX = $node->left;
        $node->left = $nodeX->right;
        $nodeX->right = $node;
        $nodeX->color = $node->color;
        $node->color = self::RED;
        $nodeX->N = $node->N;
        $node->N = 1 + $this->getSize($node->left) + $this->getSize($node->right);
        return $nodeX;
    }

    // 颜色转换
    public function flipColors(Node $node){
        $node->color = self::RED;
        $node->left->color = self::BLACK;
        $node->right->color = self::BLACK;
    }

    public function size(){
        return $this->getSize($this->root);
    }

    public function getSize(Node $node){
        if ($node == null) return 0;
        else return $node->N;
    }

    // 插入节点
    public function put($key, $value){
        $this->root = $this->putNode($this->root, $key, $value);
        $this->root->color = self::BLACK;
    }

    public function putNode(Node $node, $key, $val){
        // 查找$key,找到则更新其值,否则为它新建一个节点
        if ($node == null) return new Node($key, $val, 1, self::RED);
        if ($key < $node->key){
            $node->left = $this->putNode($node->left, $key, $val);
        }elseif ($key > $node->key){
            $node->right = $this->putNode($node->right, $key, $val);
        }else{
            $node->val = $val;
        }

        if($this->isRed($node->right) && !$this->isRed($node->left)){
            $node = $this->rotateLeft($node);
        }
        if($this->isRed($node->left) && $this->isRed($node->left->left)){
            $node = $this->rotateRight($node);
        }
        if($this->isRed($node->left) && $this->isRed($node->right)){
            $this->flipColors($node);
        }

        $node->N = $this->getSize($node->left) + $this->getSize($node->right) + 1;

        return $node;
    }
}