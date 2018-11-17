<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/17
 * Time: 1:14 PM
 */

class NumArrayComplete
{

    private $segTree; // SegmentTree

    public function __construct(array $nums = [])
    {
        $this->segTree = new SegmentTree($nums, new SumMerger());
    }

    public function update(int $i, int $val): void
    {
        $this->segTree->set($i, $val);
    }

    public function sumRange(int $i, int $j): int
    {
        return $this->segTree->query($i, $j);
    }

}

// 线段树类
class SegmentTree
{

    private $tree = [];
    private $data = [];
    private $merger; //Merger

    public function __construct(array $arr = [], SumMerger $merger)
    {
        $this->merger = $merger;

        $this->data = $arr;

        $this->tree = new SplFixedArray(count($arr) * 4); //4N空间

        $this->buildSegmentTree(0, 0, count($arr) - 1);
    }

    // 在treeIndex的位置创建表示区间[l...r]的线段树
    private function buildSegmentTree(int $treeIndex, int $l, int $r) : void
    {
        if ($l == $r) {
            $this->tree[$treeIndex] = $this->data[$l];
            return;
        }

        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        // 左子树的 数组末尾下标
        $mid = ($l + $r) / 2;  // $mid = $l + ($r - $l) / 2;
        $mid = (int) $mid;

        $this->buildSegmentTree($leftTreeIndex, $l, $mid);
        $this->buildSegmentTree($rightTreeIndex, $mid + 1, $r);

        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex], $this->tree[$rightTreeIndex]);

    }

    public function getSize(): int
    {
        return count($this->data);
    }

    public function get(int $index)
    {
        if (isset($this->data[$index]) === false) {
            exit("Index is illegal.");
        }
        return $this->data[$index];
    }

    // 返回完全二叉树的数组表示中，一个索引所表示的元素的左孩子节点的索引
    private function leftChild(int $index): int
    {
        return 2 * $index + 1;
    }

    // 返回完全二叉树的数组表示中，一个索引所表示的元素的右孩子节点的索引
    private function rightChild(int $index): int
    {
        return 2 * $index + 2;
    }

    // 返回区间[queryL, queryR]的值
    public function query(int $queryL, int $queryR)
    {

        if (isset($this->data[$queryL]) === false ||
            isset($this->data[$queryR]) === false ||
            $queryL > $queryR
        ) {
            exit('Index is illegal.');
        }

        return $this->queryValue(0, 0, count($this->data) - 1, $queryL, $queryR);
    }


    // 在以treeIndex为根的线段树中[l...r]的范围里，搜索区间[queryL...queryR]的值
    private function queryValue(int $treeIndex, int $l, int $r, int $queryL, int $queryR)
    {

        if($l == $queryL && $r == $queryR) {
            return $this->tree[$treeIndex];
        }


        $mid = ($l + $r) / 2;  // $mid = $l + ($r - $l) / 2;
        $mid = (int) $mid;
        // treeIndex的节点分为[l...mid]和[mid+1...r]两部分

        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        if($queryL >= $mid + 1) {
            // 如果查找的范围全部在右子树
            return $this->queryValue($rightTreeIndex, $mid + 1, $r, $queryL, $queryR);

        } elseif($queryR <= $mid) {

            // 如果查找的范围全部在左子树
            return $this->queryValue($leftTreeIndex, $l, $mid, $queryL, $queryR);

        }

        // 如果查找的范围一部分落在左子树，一部分落在右子树 情况
        $leftResult = $this->queryValue($leftTreeIndex, $l, $mid, $queryL, $mid);
        $rightResult = $this->queryValue($rightTreeIndex, $mid + 1, $r, $mid + 1, $queryR);
        return $this->merger->merge($leftResult, $rightResult);
    }


    // 将index位置的值，更新为e O(logn)
    public function set(int $index, $e): void
    {

        if (isset($this->data[$index]) === false) {
            exit("Index is illegal");
        }

        $this->data[$index] = $e;

        $this->setNode(0, 0, count($this->data) - 1, $index, $e);

    }

    // 在以treeIndex为根的线段树中更新index的值为e
    private function setNode(int $treeIndex, int $l, int $r, int $index, $e): void
    {

        if ($l == $r) {
            $this->tree[$treeIndex] = $e;
            return;
        }

        $mid = ($l + $r) / 2;  // $mid = $l + ($r - $l) / 2;
        $mid = (int) $mid;

        $leftTreeIndex = $this->leftChild($treeIndex);
        $rightTreeIndex = $this->rightChild($treeIndex);

        if ($index >= $mid + 1) {

            $this->setNode($rightTreeIndex, $mid + 1, $r, $index, $e);

        } else {

            $this->setNode($leftTreeIndex, $l, $mid, $index, $e);

        }

        $this->tree[$treeIndex] = $this->merger->merge($this->tree[$leftTreeIndex], $this->tree[$rightTreeIndex]);
    }


}


class SumMerger
{
    public function merge(int $a, int $b) : int
    {
        return $a + $b;
    }
}


$class = new NumArrayComplete([1, 3, 5]);
$class->sumRange(0, 2); // 9
