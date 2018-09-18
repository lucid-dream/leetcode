<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/9/18
 * Time: 下午9:48
 */

include_once "Node.php";

class BinarySearchTree
{

    private $root; //Node 根节点
    private $size;

    public function __construct()
    {
        $this->root = null;
        $this->size = 0;
    }

    public function getSize()
    {
        return $this->size;
    }

    public function isEmpty()
    {
        return $this->size == 0;
    }

    // 添加元素
    public function add($e)
    {
        $this->root = $this->addNode($this->root, $e);
    }

    // 递归添加
    private function addNode($node, $e) : Node
    {
        if ($node == null) {
            $this->size++;
            return new Node($e);
        }

//        if (bccomp($e, $node->e) == -1) {
//
//            $node->left = $this->addNode($node->left, $e);
//
//        } elseif (bccomp($e, $node->e) == 1) {
//
//            $node->right = $this->addNode($node->right, $e);
//
//        }

        if (strcmp($e, $node->e) < 0) {

            $node->left = $this->addNode($node->left, $e);

        } elseif (strcmp($e, $node->e) > 0) {

            $node->right = $this->addNode($node->right, $e);

        }


        return $node;
    }

}