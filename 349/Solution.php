<?php
/**
 * Created by PhpStorm.
 * User: wuyihao
 * Date: 2018/10/9
 * Time: 下午10:30
 */


class Solution
{

    public function intersection($nums1, $nums2) : array
    {

        $set = new \Ds\Set();
        foreach ($nums1 as $num) {
            $set->add($num);
        }

        $list = [];

        foreach ($nums2 as $num) {

            // 是否包含元素
            if ($set->contains($num)) {
                $list[] = $num;
                $set->remove($num);
            }
        }

        return $list;

    }

}

$solution = new Solution();

$nums1 = [4,9,5];
$nums2 = [9,4,9,8,4];

$data = $solution->intersection($nums1, $nums2);

var_dump($data);