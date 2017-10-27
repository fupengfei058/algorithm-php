<?php

class Node{
    public $value,$left,$right,$parent;
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
                $newNode->parent = $node;
            }else{
                $this->insertNode($node->right,$newNode);
            }
        }elseif ($node->value > $newNode->value){
            // 如果父节点大于子节点,插到左边
            if (empty($node->left)){
                $node->left = $newNode;
                $newNode->parent = $node;
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
    // 查找极值
    public function findMin(){
        //不断的找它的左子树,直到这个左子树的节点为叶子节点
        if (!empty($this->root)){
            return $this->findMinNode($this->root);
        }
    }
    public function findMinNode(Node $node){
        if (!empty($node->left)){
            return $this->findMinNode($node->left);
        }else{
            return $node;
        }
    }
    public function findMax(){
        if (!empty($this->root)){
            return $this->findMaxNode($this->root);
        }
    }
    public function findMaxNode(Node $node){
        if (!empty($node->right)){
            return $this->findMaxNode($node->right);
        }else{
            return $node;
        }
    }
    // 查找特定的值
    public function find($val = ''){
        if (!empty($val)){
            return $this->findNode($this->root,$val);
        }
    }
    public function findNode(Node $node,$val){
        if ($node->value == $val){
            return $node;
        }else if ($node->value > $val){
            // 如果父节点的值大于要查找的值,那么查找它的左子树
            if (!empty($node->left)){
                return $this->findNode($node->left,$val);
            }else{
                return false;
            }
        }else if ($node->value < $val){
            if (!empty($node->right)){
                return $this->findNode($node->right,$val);
            }else{
                return false;
            }
        }
    }

    //删除最小节点
    public function deleteMin(){
        $this->findMinNode($this->root);
    }
    public function deleteMinNode(Node $node){
        $minNode = $this->findMinNode($node);
        if(empty($minNode->right)){
            $minNode->parent->left = null;
        }else{
            $minNode->parent->left = $minNode->right;
        }
    }
    //删除最大节点
    public function deleteMax(){
        $this->findMaxNode($this->root);
    }
    public function deleteMaxNode(Node $node){
        $maxNode = $this->findMaxNode($node);
        if(empty($maxNode->left)){
            $maxNode->parent->right = null;
        }else{
            $maxNode->parent->right = $maxNode->left;
        }
    }

    // 删除指定节点
    public function delete($val = ''){
        if(!empty($val) && $node = $this->find($val)){
            $this->deleteNode($node);
        }
    }
    public function deleteNode(Node $node){
        //没有左右子节点
        if(empty($node->left) && empty($node->right)){
            if($this->isLeft($node)){
                $node->parent->left = null;
            }else{
                $node->parent->right = null;
            }
        }
        //只有右子节点
        if(empty($node->left) && !empty($node->right)){
            if($this->isLeft($node)){
                $node->parent->left = $node->right;
            }else{
                $node->parent->right = $node->right;
            }
        }
        //只有左子节点
        if(!empty($node->left) && empty($node->right)){
            if($this->isLeft($node)){
                $node->parent->left = $node->left;
            }else{
                $node->parent->right = $node->left;
            }
        }
        //左右节点都存在
        if(!empty($node->left) && !empty($node->right)){
            if($this->isLeft($node)){
                if(empty($node->left->left) && empty($node->left->right)){
                    //该节点的子节点为叶子结点
                    $node->parent->left = $node->left;
                }else{
                    $rightMinNode = $this->findMinNode($node->right);
                    $this->deleteMinNode($node->right);
                    $node->parent->left = $rightMinNode;
//                    $rightMinNode->left = $node->left;
                    $rightMinNode->right = $node->right;
                }
            }else{
                if(empty($node->right->left) && empty($node->right->right)){
                    $node->parent->right = $node->right;
                }else{
                    $leftMaxNode = $this->findMaxNode($node->left);
                    $this->deleteMaxNode($node->left);
                    $node->parent->right = $leftMaxNode;
                    $leftMaxNode->left = $node->left;
//                    $leftMaxNode->right = $node->right;
                }
            }
        }
    }

    //判断某节点是否父节点的左子节点
    public function isLeft(Node $node){
        if($node->parent->left->value == $node->value){
            return true;
        }else{
            return false;
        }
    }

}

$tree = new BinaryTree();
// 节点插入
$nodes = array(8,3,10,1,6,14,4,7,13);
foreach ($nodes as $value){
    $tree->insert($value);
}
echo '<pre>';
// 寻找极值
//$tree->findMin();
//$tree->findMax();

// 删除极值
//$tree->deleteMin();
//$tree->deleteMax();

// 查找特定的值
//var_dump($tree->find(7));
//$tree->find(11);

// 删除特定的值
//$tree->delete(13);

// 中序遍历
$tree->midSort();
print_r($tree->sortArr);