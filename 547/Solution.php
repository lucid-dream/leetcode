<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/30
 * Time: 4:41 PM
 */

/*
 *
班上有 N 名学生。其中有些人是朋友，有些则不是。他们的友谊具有是传递性。
如果已知 A 是 B 的朋友，B 是 C 的朋友，那么我们可以认为 A 也是 C 的朋友。所谓的朋友圈，是指所有朋友的集合。

给定一个 N * N (3x3,4x4 ...) 的矩阵 M，表示班级中学生之间的朋友关系。
如果M[i][j] = 1，表示已知第 i 个和 j 个学生互为朋友关系，否则为不知道。你必须输出所有学生中的已知的朋友圈总数。

*/
class Solution
{
    public function findCircleNum(array $M) : int
    {
        $n = count($M); //3
        $uf = new UnionFind($n);

        // 0 < 3
        for ($i = 0; $i < $n; $i++) {

            for ($j = 0; $j < $i; $j++) { // [1][0]  // [2][0] , [2][1]
                if ($M[$i][$j] == 1) {
                    $uf->unionElements($i, $j);
                }
            }
        }

        $set = new \Ds\Set();

        for($i = 0 ; $i < $n ; $i++) {
            $set->add($uf->find($i));
        }

        return $set->count();

    }
};



class UnionFind
{

    // parent[i]表示第一个元素所指向的父节点
    private $parent = []; // int[]
    private $rank = []; // rank[i]表示以i为根的集合中元素个数

    public function __construct(int $size)
    {
        $this->parent = new SplFixedArray($size);
        $this->rank = new SplFixedArray($size);

        // 初始化, 每一个parent[i]指向自己, 表示每一个元素自己自成一个集合
        for ($i = 0; $i < $size; $i++) {
            $this->parent[$i] = $i; // 元素 => 集合编号
            $this->rank[$i] = 1; // $this->rank[$i] = count($this->parent[$i]);
        }

    }

    // 查找过程, 查找元素p所对应的集合编号，O(h)复杂度, h为树的高度
    public function find(int $p) : int
    {

        if (isset($this->parent[$p]) === false) {
            exit("p is out of bound.");
        }

        // path compression 2, 递归算法
        if ($p != $this->parent[$p]) {

            $this->parent[$p] = $this->find($this->parent[$p]);

        }

        return $this->parent[$p];

    }

    public function isConnected(int $p, int $q) : bool
    {
        return $this->find($p) == $this->find($q);
    }

    public function unionElements(int $p, int $q) : void
    {

        $pRoot = $this->find($p); //获取p元素的 根节点
        $qRoot = $this->find($q); //获取q元素的 根节点

        //属于同一个集合
        if($pRoot == $qRoot) {
            return;
        }


        //比对2个元素所在树的高度，将rank低的集合合并到rank高的集合上
        if($this->rank[$pRoot] < $this->rank[$qRoot]) {

            $this->parent[$pRoot] = $qRoot;

        } elseif($this->rank[$qRoot] < $this->rank[$pRoot]) {

            $this->parent[$qRoot] = $pRoot;

        } else {  // $this->rank[$pRoot] == $this->rank[$qRoot]

            $this->parent[$pRoot] = $qRoot; // 任意合并也可以 $this->parent[$qRoot] = $pRoot;
            $this->rank[$qRoot] += 1;

        }

    }

    public function getSize(): int
    {
        return $this->parent->count();
    }


}

try {

    $solution = new Solution();

    //3x3矩阵 只有 0，1，2 三个学生，M[i][i] = 1是自己 (第0个学生[0][0] = 1, 第1个学生[1][1] = 1, 第二个学生[2][2] = 1)

    //说明：已知学生0和学生1互为朋友，他们在一个朋友圈。第2个学生自己在一个朋友圈。所以返回2。
    echo $solution->findCircleNum([
        [1, 1, 0], // [0][0] = 1
        [1, 1, 0], // [1][1] = 1
        [0, 0, 1]  // [2][2] = 1
    ]);

    echo "<br>";

    //说明：已知学生0和学生1互为朋友，学生1和学生2互为朋友，所以学生0和学生2也是朋友，所以他们三个在一个朋友圈，返回1。
    echo $solution->findCircleNum([
        [1, 1, 0],
        [1, 1, 1],
        [0, 1, 1]
    ]);

    /*
        注意：

        N 在[1,200]的范围内。
        对于所有学生，有M[i][i] = 1。
        如果有M[i][j] = 1，则有M[j][i] = 1。

    */

} catch (Error $error) {

    echo $error->getMessage();

}



