<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/11/17
 * Time: 8:08 AM
 */

/// 使用sum数组预热的思路, 更新操作是O(n) 级别，不推荐
class NumArray
{

    private $data = [];
    private $sum = [];

    public function __construct(array $nums = [])
    {
        $this->data = $nums;

        $this->sum = new SplFixedArray(count($nums)+1);

        $this->sum[0] = 0;

        for ($i = 1; $i < $this->sum->count(); $i++) {


            $this->sum[$i] = $this->sum[$i - 1] + $this->data[$i - 1];


        }

    }

    public function sumRange(int $i, int $j): int
    {
        return $this->sum[$j + 1] - $this->sum[$i];
    }

    // O(n)
    public function update(int $index, int $val): void
    {
        $this->data[$index] = $val;

        for ($i = $index + 1; $i < $this->sum->count(); $i++) {

            $this->sum[$i] = $this->sum[$i - 1] + $this->data[$i - 1];

        }
    }

}

$arr = new NumArray([1, 3, 5]);

var_dump($arr);
var_dump($arr->sumRange(0, 2)); //9

$arr->update(1, 2);

var_dump($arr->sumRange(0, 2)); //8

