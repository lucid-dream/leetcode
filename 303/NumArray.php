<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/17
 * Time: 7:44 AM
 */

/**
 * 使用预热方式，预先算好各区间总和的方式； 也可以用 线段树数据结构的方式来解题
 *
 * Class NumArray
 */
class NumArray
{

    private $sum = [];
    public function __construct($nums = [])
    {
        $this->sum = new SplFixedArray(count($nums)+1);

        $this->sum[0] = 0;

        // sum[i]存储前i个元素和, sum[0] = 0
        // 即sum[i]存储nums[0...i-1]的和
        for ($i = 1; $i < $this->sum->count(); $i++) {


            $this->sum[$i] = $this->sum[$i - 1] + $nums[$i - 1];


        }

    }

    // sum(i, j) = sum[j + 1] - sum[i]
    public function sumRange(int $i, int $j): int
    {
        return $this->sum[$j + 1] - $this->sum[$i];
    }


}

$arr = new NumArray([-2, 0, 3, -5, 2, -1]);
var_dump($arr->sumRange(0, 5));

